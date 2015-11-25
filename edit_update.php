<?php 

	require("dbase/config.inc.php");
	require("dbase/Database.class.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();

	//parent and tutor
	$user["fname"] 			=		 $_POST["user-fname"];
	$user["lname"] 			=		 $_POST["user-lname"];
	$user["email"] 			=		 $_POST["user-email"];
	$user["city"] 			=		 $_POST["user-city"];
	$user["postcode"] 		=		 $_POST["user-postcode"];
	$user["state"] 			=		 $_POST["user-state"];
	$user["phone"] 			=		 $_POST["user-phone"];

	$id						= 		 substr($_GET["user"], 1); 
	$user_type 				= 		 substr($_GET["user"], 0,1); //p or t
	
	if ($user_type=="p") {
		$db->query_update("tblparents", $user, "id='$id'");
		echo "<script>
	             window.history.go(-1);
	     	</script>";
	}else if($user_type=="t"){
		$db->query_update("tbltutor", $user, "id='$id'");
		echo "<script>
	             window.history.go(-1);
	     	</script>";
	}else{
		$db->query_update("tblstudents", $std, "parent_id='$id'");
		echo "<script>
	             window.history.go(-1);
	     	</script>";
	}

 ?>