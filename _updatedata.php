<?php 

	require("dbase/config.inc.php");
	require("dbase/Database.class.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();

	$question_id = $_POST["question_id"];
	$student_id = $_POST["student_id"];

$sqlAnswer = "Select correct_answer from tblquestions where id='".$question_id."'";

$rowAnswer = $db->query($sqlAnswer);
$result2 = $db->fetch_array($rowAnswer);


$answerResult = "incorrect";
if(isset($_POST["answer"]))
{
	
	if($result2["correct_answer"] == $_POST["answer"]){
		$answerResult = "correct";
	}
		$_POST["status"] = $answerResult;
		$DATA = $_POST;
}else{
	unset($_POST["answer"]);
	$DATA["time_to_answer"] = $_POST["time_to_answer"];
}
	 $row = $db->query_update("tbltemporarygenexam",$DATA,"question_id='".$question_id."' and student_id='".$student_id."'");
	 echo $row;



	
	//echo json_encode($json);
	mysql_close();
	
		
 ?>