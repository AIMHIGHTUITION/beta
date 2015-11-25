<?php 
	
	session_start();

	require("dbase/config.inc.php");
	require("dbase/Database.class.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();

	$parent_id = $_GET['id'];
	// $prntfname = $_GET['name'];

	//student
	$student0["fname"] 				=		 $_POST["student-fname"][0];
	$student0["lname"] 				=		 $_POST["student-lname"][0];
	$student0["year_level"] 		=		 $_POST["yearlvl"][0];
	$student0["date_registered"]	= 		 "NOW()";
	$student0["parent_id"]			=		 $parent_id;
	$student1["fname"] 				=		 $_POST["student-fname"][1];
	$student1["lname"] 				=		 $_POST["student-lname"][1];
	$student1["year_level"] 		=		 $_POST["yearlvl"][1];
	$student1["date_registered"]	= 		 "NOW()";
	$student1["parent_id"]			=		 $parent_id;
	$student2["fname"] 				=		 $_POST["student-fname"][2];
	$student2["lname"] 				=		 $_POST["student-lname"][2];
	$student2["year_level"] 		=		 $_POST["yearlvl"][2];
	$student2["date_registered"]	= 		 "NOW()";
	$student2["parent_id"]			=		 $parent_id;

	$parent_rec = "SELECT * FROM tblparents where id='$parent_id'";
	$parent_check = $db->query($parent_rec); 
	//check if parend data exist

	if ($record = $db->fetch_array($parent_check)!=null) {

		// $prnt_code['email_code'] = md5($record['email'] + microtime());//for email ver.
		// $db->query_update("tblparents", $prnt_code, "id='$parent_id'");
		//check slot available
		$checkSlot = "SELECT student_id, student_id2, student_id3 FROM tblparents where id='$parent_id'"; 
		$queryCheck = $db->query($checkSlot);

		while ($record = $db->fetch_array($queryCheck)) {

			if ($record['student_id']=="" && $student0['fname'] != NULL && $student0['lname'] != NULL && $student0['year_level'] != NULL ) {

				$primary_id = $db->query_insert("tblstudents", $student0);//insert new student record in the tblstudents
				$newStdID["student_id"] = $primary_id; 
				$db->query_update("tblparents", $newStdID, "id='$parent_id'");

				if ($record['student_id2']=="" && $student1['fname'] != NULL && $student1['lname'] != NULL && $student1['year_level'] != NULL ){

				$primary_id = $db->query_insert("tblstudents", $student1);//insert new student record in the tblstudents
				$newStdID["student_id2"] = $primary_id; 
				$db->query_update("tblparents", $newStdID, "id='$parent_id'");
				}

				if($record['student_id3']=="" && $student2['fname'] != NULL && $student2['lname'] != NULL && $student2['year_level'] != NULL ){

				$primary_id = $db->query_insert("tblstudents", $student2);//insert new student record in the tblstudents
				$newStdID["student_id3"] = $primary_id; 
				$db->query_update("tblparents", $newStdID, "id='$parent_id'");
				}

				if (isset($_SESSION['views'])) {
					$_SESSION['views']=$_SESSION['views']+1;
					$_SESSION['type']="p";
					$_SESSION['id']=$parent_id;
					$_SESSION['log']=true;
					header("Location:index.php");
				}else{
					$_SESSION['views']=1;
				}

			}
			
			else{
				echo "<script>
						alert('Sorry something went wrong, please contact admin.')
						window.history.go(-1)
					 </script>";
			}
			
		}

	}else{
		echo "<script>
					alert('Please register your account first.'); 
					window.location = 'registration.php';
			  </script>";
	}

 ?>