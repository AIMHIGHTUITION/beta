<?php 
	
	session_destroy();
	session_start();
	$_SESSION['id']="";
	$_SESSION['type'] = "";
	header("Location: login.php");
	exit();
?>