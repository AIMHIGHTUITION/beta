<?php 

	require("dbase/config.inc.php");
	require("dbase/Database.class.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();
	$json = array();
	$studenId = $_POST["id"];
	$year = $_POST["year"];
	$asstype = $_POST["asstype"];
	
	$sqlHasExam = "Select B.id as QUESTION_ID, B.question as question, B.choices as choices, A.answer as answer,A.time_to_answer as time_to_answer,B.flagged_for_review as flagged_for_review  from tbltemporarygenexam as A left outer join tblquestions as B on A.question_id=B.id where A.student_id='".$studenId."' and assessment_type_id='".$asstype."' and A.status IS NULL ";
	
	
	//Done Question in Primary
	$sqlDone = "Select count(A.question_id) as donePrimary  from tbltemporarygenexam as A left outer
 join tblquestions as B on A.question_id=B.id where A.student_id='".$studenId."' and assessment_type_id='".$asstype."' 
 and A.status IS NOT NULL and question_type='primary'";
// echo $sqlDone;
 	$rowsDone = $db->query($sqlDone);
 	$resultDone = $db->fetch_array($rowsDone);
 	
 	//Done Question in Supplementary
	$sqlDoneSupplementary = "Select count(A.question_id) as doneSupplementary  from tbltemporarygenexam as A left outer
 join tblquestions as B on A.question_id=B.id where A.student_id='".$studenId."' and assessment_type_id='".$asstype."' 
 and A.status IS NOT NULL and question_type='supplementary'";
// echo $sqlDone;
 	$rowsDoneSupplementary = $db->query($sqlDoneSupplementary);
 	$resultDoneSupplementary = $db->fetch_array($rowsDoneSupplementary);
 	
 	
 	//Total Questions in Primary	
	$sqlallQuestion = "Select count(A.question_id) as totalPrimary  from tbltemporarygenexam as A left outer
 join tblquestions as B on A.question_id=B.id where A.student_id='".$studenId."' and assessment_type_id='".$asstype."' and question_type='primary'";
 
 	 	$rowsAllQuestion = $db->query($sqlallQuestion);
 	$resultAllQuestion = $db->fetch_array($rowsAllQuestion);
 	
 	//Total Question in Supplementary
 		$sqlallSupplementary = "Select count(A.question_id) as totalSupplementary  from tbltemporarygenexam as A left outer
 join tblquestions as B on A.question_id=B.id where A.student_id='".$studenId."' and assessment_type_id='".$asstype."' and question_type='supplementary'";
// echo $sqlallSupplementary;
 	 	$rowsAllSupplementary = $db->query($sqlallSupplementary);
 	$resultAllSupplementary = $db->fetch_array($rowsAllSupplementary);
 	
 	
 	
 	
	//echo  $sqlHasExam;
	$rowHasExam = $db->query($sqlHasExam);
	$hasExam = "0";

	if($resultDone["donePrimary"] == ""){
		$resultDone["donePrimary"] = 0;
	}
	
	
	while($recordGenExam = $db->fetch_array($rowHasExam))
	{
		$details = array
			(
				'id' => $recordGenExam["QUESTION_ID"],
				'question' => utf8_encode($recordGenExam["question"]),
				'answer' => $recordGenExam["answer"],
				'choices' => $recordGenExam["choices"],
				'time_to_answer' => $recordGenExam["time_to_answer"],
				'flagged_for_review' => $recordGenExam["flagged_for_review"],
				'donePrimary' => $resultDone["donePrimary"],
				'totalPrimary' => $resultAllQuestion["totalPrimary"],
				'doneSupplementary' => $resultDoneSupplementary["doneSupplementary"],
				'totalSupplementary' => $resultAllSupplementary["totalSupplementary"]
				
			);
			array_push($json, $details);	
			$hasExam = "1";
	}
	
	if($hasExam == "0")
	{
		//TODO: Add Where if diagnostic then get question from diagnostic
		
		$sql = "select D.id, D.question, D.choices, D.flagged_for_review from tbllearningcategories as A 
		left outer join tblmajoroutcome as B on A.id=B.learning_categories_id
		left outer join tblminoroutcome as C on B.id=C.major_outcome_id
		right outer join tblquestions as D on C.id=D.minor_outcome_id
		Where A.year='".$year."' ORDER BY RAND()";

		$row = $db->query($sql);
		
		while ($record = $db->fetch_array($row)) 
		{
			
		
			$data["student_id"] = $studenId;
			$data["question_id"] = $record["id"];
			$data["assessment_type_id"] = $asstype;
			$data["question_type"] = "primary";
			
			$primary_id =  $db->query_insert("tbltemporarygenexam", $data);
 	
				$details = array
				(
					'id' => $record["id"],
					'question' => utf8_encode($record["question"]),
					'choices' => $record["choices"],
					'flagged_for_review' => $record["flagged_for_review"],
					'donePrimary' => $resultDone["donePrimary"],
					'totalPrimary' => $resultAllQuestion["totalPrimary"],
					'doneSupplementary' => "0",
					'totalSupplementary' => "0"
					
				);
				array_push($json, $details);		
		}
	}	
	echo json_encode($json);
	mysql_close();
 ?>