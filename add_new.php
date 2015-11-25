<?php 

	require("dbase/config.inc.php");
	require("dbase/Database.class.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();

	$parentId				=	 $_GET["id"];

	$std["fname"]			=	 $_POST["new-fname"];
	$std["lname"] 			=	 $_POST["new-lname"];
	$std["year_level"] 		=	 $_POST["new-yrlvl"];
	$std["date_registered"] =	 "NOW()";
	$std["parent_id"] 		=	 $parentId;

	// $username 				=	 $_POST["new-username"];
	// $usernameChecked 		=	 "SELECT username FROM tblstudents where username='$username'";
	// $stdUsername 			=	 $db->query($usernameChecked);

	// if ($record = $db->fetch_array($stdUsername)==null) {//check if username is available

		$checkSlot = "SELECT student_id, student_id2, student_id3 FROM tblparents where id='$parentId'"; //check slot available
		$queryCheck = $db->query($checkSlot);

		while ($record = $db->fetch_array($queryCheck)) {
			
			if ($record['student_id']=="") {

				$primary_id = $db->query_insert("tblstudents", $std);//insert new student record in the tblstudents
				$newStdID["student_id"] = $primary_id; 
				$db->query_update("tblparents", $newStdID, "id='$parentId'");
				echo "<script>window.history.go(-1);</script>";

			}else if ($record['student_id2']==""){

				$primary_id = $db->query_insert("tblstudents", $std);//insert new student record in the tblstudents
				$newStdID["student_id2"] = $primary_id; 
				$db->query_update("tblparents", $newStdID, "id='$parentId'");
				echo "<script>window.history.go(-1);</script>";

			}else if($record['student_id3']==""){

				$primary_id = $db->query_insert("tblstudents", $std);//insert new student record in the tblstudents
				$newStdID["student_id3"] = $primary_id; 
				$db->query_update("tblparents", $newStdID, "id='$parentId'");
				echo "<script>window.history.go(-1);</script>";

			}else{
				echo "No more slots available!";
			}
			
		}

	// }else{
	// 	echo "<script>
	// 				alert('Username already taken, please try another'); 
	// 				window.history.go(-1);
	// 		  </script>";
	// }

 ?>