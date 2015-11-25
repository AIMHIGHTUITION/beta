<?php 

	require("dbase/config.inc.php");
	require("dbase/Database.class.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();

//$studenId = "3";
$year = $_POST["yearLevel"];
$assType = $_POST["assType"];
$studenId = $_POST["student_id"];

if($year <= 0){
	$year = "F";
}
$sql = "select * from (select A.`student_id`,current_timestamp() as finished_date, GROUP_CONCAT(A.question_id SEPARATOR ',') as question_id,GROUP_CONCAT(if(A.status='correct',A.question_id,null) SEPARATOR ', ') as correct_answer,GROUP_CONCAT(if(A.status='incorrect',A.question_id,null) SEPARATOR ', ') as incorrect_answer, sum(A.time_to_answer) as time_taken
 from tbltemporarygenexam as A where A.student_id='$studenId' and question_type='primary') as A";

$row = $db->query($sql);

while($record = $db->fetch_array($row))
{
	$data = $record;
}
	

	
$sqlMajorOutcomeResult = "select GROUP_CONCAT(A.major SEPARATOR ',') as major_outcome_result from (
Select concat(C.major_outcome_id,' - ',round(sum(if(A.status='correct',1,0))/count(A.question_id)*100,2),'%',' - ',D.name) as 'major', GROUP_CONCAT(B.minor_outcome_id SEPARATOR ',') as minor_outcome_list  from tbltemporarygenexam as A left outer join tblquestions as B on A.`question_id`=B.id left outer join tblminoroutcome as C on B.minor_outcome_id=C.id left outer join tblmajoroutcome as D on D.id=C.major_outcome_id where A.student_id='$studenId' and A.assessment_type_id='$assType' and question_type='primary' group by C.major_outcome_id ) as A";
$row = $db->query($sqlMajorOutcomeResult);
$result = $db->fetch_array($row);


$data["major_outcome_results"] =$result['major_outcome_result'];


$sqlSupplementary = "select GROUP_CONCAT(A.major SEPARATOR ',') as supplementary_major_result from (
Select concat(C.major_outcome_id,' - ',round(sum(if(A.status='correct',1,0))/count(A.question_id)*100,2),'%',' - ',D.name) as 'major', GROUP_CONCAT(B.minor_outcome_id SEPARATOR ',') as minor_outcome_list  from tbltemporarygenexam as A left outer join tblquestions as B on A.`question_id`=B.id left outer join tblminoroutcome as C on B.minor_outcome_id=C.id left outer join tblmajoroutcome as D on D.id=C.major_outcome_id where A.student_id='$studenId' and A.assessment_type_id='$assType' and question_type='supplementary' group by C.major_outcome_id ) as A";
$row = $db->query($sqlSupplementary);
$result = $db->fetch_array($row);


$data["major_outcome_supplementary"] =$result['supplementary_major_result'];



$sqlLearningCategoryResult = "select GROUP_CONCAT(A.learning SEPARATOR ',') as 'learning_category_results' from (
Select concat(D.learning_categories_id,' - ',round(sum(if(A.status='correct',1,0))/count(A.question_id)*100,2),'%') as 'learning' from tbltemporarygenexam as A left outer join tblquestions as B on A.`question_id`=B.id left outer join tblminoroutcome as C on B.minor_outcome_id=C.id left outer join tblmajoroutcome as D on C.major_outcome_id=D.id where A.student_id='$studenId' and A.assessment_type_id='$assType' and question_type='primary' group by D.`learning_categories_id`) as A";
	
	
	
	$row = $db->query($sqlLearningCategoryResult);
	$result = $db->fetch_array($row);
	$data["learning_category_results"] =$result['learning_category_results'];
	$majorResult = explode(",", $data["major_outcome_results"]);
	
	//Check if the student has supplementary already
	
	$sqlLookSupp = "Select * from tbltemporarygenexam where student_id='$studenId' and question_type='supplementary' and assessment_type_id='$assType' limit 1";
	
	$rowHasSupp = $db->query_first($sqlLookSupp);
	//echo "-----".$rowHasSupp["question_type"];
	
	$json = array();	
	$isCalculateSupp = true;
	if($rowHasSupp["question_type"] == "")
	{
		
	
		for($i = 0; $i < count($majorResult); $i++)
		{
			$arrExpMajorResult = explode(" - ", $majorResult[$i]);
			
			//echo "Major Result Cat".$arrExpMajorResult[0];
	
			if($arrExpMajorResult[1] < 50){
	
				$sqlSupplementaryQuestions = "select D.id, D.question, D.choices from tbllearningcategories as A 
			left outer join tblmajoroutcome as B on A.id=B.learning_categories_id
			left outer join tblminoroutcome as C on B.id=C.major_outcome_id
			right outer join tblquestions as D on C.id=D.minor_outcome_id
			Where A.year='".$year."' and B.name='".$arrExpMajorResult[2]."' and FIND_IN_SET(D.id,'".$data["question_id"]."') = 0 ORDER BY RAND() LIMIT 2";
			
			$row = $db->query($sqlSupplementaryQuestions);
			
			//echo $sqlSupplementaryQuestions;
			while ($record = $db->fetch_array($row)) 
			{
				$details = array
				(
					'id' => $record["id"],
					'question' => utf8_encode($record["question"]),
					'choices' => $record["choices"]
				);
				array_push($json, $details);	
	
				$dataSupplementary["student_id"] = $studenId;
				$dataSupplementary["question_id"] = $record["id"];
				$dataSupplementary["assessment_type_id"] = $assType;
				$dataSupplementary["question_type"] = "supplementary";
				
				$primary_id =  $db->query_insert("tbltemporarygenexam", $dataSupplementary);
			}
			
			$isCalculateSupp = false;
			}
		}
		
	if(count($json) > 0)
	{
		echo json_encode($json);
	}
}
	
	
	//If Supplement is calcaluated and answered
if($data["student_id"] != "" and $isCalculateSupp == true)
{	
	//Insert Data after completion

$sqlSupplmentaryResult = "select GROUP_CONCAT(A.question_id SEPARATOR ', ') as supplementary_question_id, GROUP_CONCAT(if(A.status='correct',A.question_id,null) SEPARATOR ', ') as supplementary_correct,GROUP_CONCAT(if(A.status='incorrect',A.question_id,null) SEPARATOR ', ') as supplementary_incorrect from tbltemporarygenexam as A where A.student_id='$studenId' and A.assessment_type_id='$assType' and A.question_type='supplementary'";
	
$rowSupplementary = $db->query($sqlSupplmentaryResult);

	while($recordSupp = $db->fetch_array($rowSupplementary))
	{
		$data["supplementary_question_id"] = $recordSupp["supplementary_question_id"];
		$data["supplementary_correct"] = $recordSupp["supplementary_correct"];
		$data["supplementary_incorrect"] = $recordSupp["supplementary_incorrect"];
	}
	$data["assessment_type_id"] = $assType;
	$row = $db->query_insert('tblcompletedeexam',$data);
	
	function getCountString($strText){
		$numResult = 0;
		if($strText != ""){
			
		$numResult = count(explode(",",$strText));
		}
		return $numResult;
	}

	$countCorrect =  getCountString($data["correct_answer"]) + getCountString($data["supplementary_correct"]);
	$allQuestions =  getCountString($data["question_id"]) + getCountString($data["supplementary_question_id"]);
	//Delete Temp Tables
	$sql = "DELETE FROM tbltemporarygenexam WHERE student_id=$studenId";
	$db->query($sql);
	
	$resultDisplay = $countCorrect;
	//$resultScore = 
	echo '[{"message":"success","result":"'.$resultDisplay.'","rowId":"'.$row.'"}]';
}
	mysql_close();
	
		
 ?>