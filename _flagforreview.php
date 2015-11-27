<?php 

	require("dbase/config.inc.php");
	require("dbase/Database.class.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();
	$questionID = $_POST["questionId"];
	$data["flagged_message"] = $_POST["flagged_message"];
	$data["flagged_for_review"] = 1;
	$where = "id=".$questionID;
	$row = $db->query_update("tblquestions",$data,$where);
	mysql_close();
	
 ?>