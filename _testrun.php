<?php 

	require("dbase/config.inc.php");
	require("dbase/Database.class.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();


//$sqlAnswer = "truncate tbltemporarygenexam";

$sqlAnswer = "truncate tblcompletedeexam";

$rowAnswer = $db->query($sqlAnswer);

echo $rowAnswer;
	echo "Success";
	//echo json_encode($json);
	mysql_close();
	
		
 ?>
 