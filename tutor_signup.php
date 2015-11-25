<?php 	

	session_start();

	require("dbase/config.inc.php");
	require("dbase/Database.class.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();

	$tbltutor["city"] 			 = 		$_POST["tutor-city"];
	$tbltutor["email"] 			 = 		$_POST["tutor-email"];
	$tbltutor["fname"] 			 = 		$_POST["tutor-fname"];
	$tbltutor["lname"] 			 = 		$_POST["tutor-lname"];
	// $tbltutor["username"] 		 = 		$_POST["tutor-username"];
	$tbltutor["password"] 		 = 		$_POST["tutor-password"];
	$tbltutor["phone"] 			 = 		$_POST["tutor-phone"];
	$tbltutor["postcode"] 		 = 		$_POST["tutor-postcode"];
	$tbltutor["state"] 			 = 		$_POST["tutor-state"];
	$tbltutor["date_registered"] = 		"NOW()";

	$emailsession			=		 	$_POST["tutor-email"];	

	// $username = $_POST["tutor-username"];
	$email = $_POST["tutor-email"];
	
	// $check_username = "SELECT username FROM tbltutor where username='$username'";
	$check_email = "SELECT email FROM tbltutor where email='$email'";

	// $result = $db->query($check_username);
	$result = $db->query($check_email);

	if ($record = $db->fetch_array($result)==null) {
		
		$primary_id = $db->query_insert("tbltutor", $tbltutor);
		if (isset($_SESSION['views'])) { //this is for the email verification page
			$_SESSION['views']=$_SESSION['views']+1;
			$_SESSION['email_add']=$emailsession;
		}else{
			$_SESSION['views']=1;
		}
		header("Location:email_verification.php");
		exit();

	}else{
		echo "<script>
		alert('Email already exist!'); 
		window.history.go(-1);
		</script>";
	}
?>