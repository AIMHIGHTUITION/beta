<?php 

	require("dbase/config.inc.php");
	require("dbase/Database.class.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();

	$question_id = $_POST["question_id"];
	$student_id = $_POST["student_id"];
	$DATA["time_to_answer"] = $_POST["time_to_answer"];

	 $row = $db->query_update("tbltemporarygenexam",$DATA,"question_id='".$question_id."' and student_id='".$student_id."'");
	 echo $row;



	
	//echo json_encode($json);
	mysql_close();
	
		
 ?>