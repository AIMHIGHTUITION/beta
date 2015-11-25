<?php 

	require("dbase/config.inc.php");
	require("dbase/Database.class.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();

	$parentId = $_POST["parent_id"];

	
	$sqlCompletedExam = "Select A.id as id,A.question_id as question_id, A.finished_date as finished_date,A.correct_answer as correct_answer, A.incorrect_answer as inccorrect_answer,A.learning_category_results as learning_category_results,A.major_outcome_results as major_outcome_results, A.supplementary_incorrect as supplementary_incorrect,B.subject as subject, B.type as type, A.supplementary_question_id as supplementary_question_id, A.supplementary_correct as supplementary_correct, C.fname as fname from tblcompletedeexam as A left outer join tblassestmenttype as B on B.id=A.assessment_type_id left outer join tblstudents as C on A.student_id=C.id  where C.parent_id='".$parentId."' ORDER BY A.student_id";
	//echo $sqlCompletedExam;
	$rowCompletedExam = $db->query($sqlCompletedExam);	
	$json = array();
	while($recCompletedExam = $db->fetch_array($rowCompletedExam))
	{
		
		$cntSupplementary_question_id = strlen($recCompletedExam["supplementary_question_id"]) ? count(explode(',', $recCompletedExam["supplementary_question_id"])) : 0;
		$cntsupplementary_correct = strlen($recCompletedExam["supplementary_correct"]) ? count(explode(',', $recCompletedExam["supplementary_correct"])) : 0;
		
		$details = array
			(
				'id' => $recCompletedExam["id"],
				'question_id' => $recCompletedExam["question_id"],
				'fname' => $recCompletedExam["fname"],
				'finished_date' => $recCompletedExam["finished_date"],
				'correct_answer' => $recCompletedExam["correct_answer"],
				'inccorrect_answer' => $recCompletedExam["inccorrect_answer"],
				'learning_category_results' => $recCompletedExam["learning_category_results"],
				'major_outcome_results' => $recCompletedExam["major_outcome_results"],
				'subjectype' => $recCompletedExam["subject"]." ".$recCompletedExam["type"],
				'supplementary_question_id' => $cntSupplementary_question_id,
				'supplementary_correct' => $cntsupplementary_correct,
				'supplementary_incorrect' => $recCompletedExam["supplementary_incorrect"],
				'supplementary_subjectype' => $recCompletedExam["subject"]." ".$recCompletedExam["type"]." Supplementary"

			);
			array_push($json, $details);	
	}
	
	echo json_encode($json);
	mysql_close();
	
		
 ?>