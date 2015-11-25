<?php 
	require("dbase/config.inc.php");
	require("dbase/Database.class.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();

	$id								=			$_GET["id"]; //to be deleted student id 
	$parentId						=			$_GET["prntId"]; //parent id 
	$prntCol						=			$_GET["prntCol"]; //which parent student_id column
	$parentData["$prntCol"] 		=			"NULL";

	$deletestd = "DELETE FROM `tblstudents` WHERE id=$id";

	$db->query($deletestd);//delete student

	$db->query_update("tblparents", $parentData, "id='$parentId'");//update parents column

	echo "<script>window.history.go(-1);</script>";

 ?>