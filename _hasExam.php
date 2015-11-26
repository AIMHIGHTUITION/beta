<?php 

	require("dbase/config.inc.php");
	require("dbase/Database.class.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();
	$assessment_typeid = $_POST["assessment_typeid"];
	$examiner = $_POST["examiner"];
	$resultExaminer = explode("&", $examiner);
	$sql = "Select * from tbltemporarygenexam where student_id='".$resultExaminer[0]."' and assessment_type_id='".$assessment_typeid."' limit 1";
	$row = $db->query($sql);
	$result =  $db->fetch_array($row);
	//echo $result["id"];
	if($result["id"] == ""){
		echo "notexist";
	}else{
		echo "exist";
	}
	//echo json_encode($json);
	mysql_close();
		
 ?>