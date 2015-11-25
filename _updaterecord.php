<?php 
	require("dbase/config.inc.php");
	require("dbase/Database.class.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();

	$studenId = $_POST["id"];
	$parentData = $_POST;
	$row = $db->query_update("tblstudents", $_POST, "id='$studenId'");//update parents column
	echo "success";
 ?>