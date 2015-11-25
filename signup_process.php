<?php 	
	
	session_start();

	require("dbase/config.inc.php");
	require("dbase/Database.class.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();

	//parents
	$parent["city"] 			=		 $_POST["city"];
	$confirmPass  				=		 $_POST["confirm_pass"];
	$parent["email"] 			=		 $_POST["email"];
	$parent["fname"] 			=		 $_POST["fname"];
	$parent["lname"] 			=		 $_POST["lname"];
	$parent["password"] 		=		 $_POST["password"];
	$parent["phone"] 			=		 $_POST["phone_number"];
	$parent["postcode"] 		=		 $_POST["postcode"];
	$parent["state"] 			=		 $_POST["state"];
	$parent["date_registered"]  =		 "NOW()";

	$emailsession				=		 $_POST["email"];

	$prnt_email = $_POST["email"];
	$prt_email = "SELECT email FROM tblparents where email='$prnt_email'";
	$check_email = $db->query($prt_email);

	//check email if it already exist
	if ($record = $db->fetch_array($check_email)==null) {

		$primary_id = $db->query_insert("tblparents", $parent);
		if (isset($_SESSION['views'])) { //this is for the email verification page
			$_SESSION['views']=$_SESSION['views']+1;
			$_SESSION['parent_id']=$primary_id;
		}else{
			$_SESSION['views']=1;
		}
		header("Location:student_registration.php");
		exit();

	}else{
		echo "<script>
		alert('Email account already exist!'); 
		window.history.go(-1);
		</script>";
	}

?>