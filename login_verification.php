<?php 
	session_start();
	$_SESSION['views'] = 1;
	require("dbase/config.inc.php");
	require("dbase/Database.class.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();
	
	$email			= 		$_POST["email"];
	$password 		= 		$_POST["password"];

	//If a parent login
	$parent = "SELECT * FROM tblparents WHERE email = '$email' AND password = '$password'";
	//If a tutor login
	$tutor = "SELECT * FROM tbltutor WHERE email = '$email' AND password = '$password'";

	$parent_query = $db->query($parent); 
	$tutor_query = $db->query($tutor); 
	
	if ($record = $db->fetch_array($parent_query)) {
		
		$user_id = "SELECT id FROM tblparents WHERE email = '$email' AND password = '$password'";
		$record = $db->query_first($user_id);
		$id = $record['id'];

		if (isset($_SESSION['views'])) {
			$_SESSION['views']=$_SESSION['views']+1;
			$_SESSION['type']="p";
			$_SESSION['id']=$id;
			$_SESSION['log']=true;
		}else{
			$_SESSION['views']=1;
		}
		header("Location:index.php");
  		
	}elseif($record = $db->fetch_array($tutor_query)) {
		
		$user_id = "SELECT id FROM tbltutor WHERE email = '$email' AND password = '$password'";
		$record = $db->query_first($user_id);
		$id = $record['id'];

		if (isset($_SESSION['views'])) {
			$_SESSION['views']=$_SESSION['views']+1;
			$_SESSION['type']="t";
			$_SESSION['id']=$id;
			$_SESSION['log']=true;
		}else{
			$_SESSION['views']=1;
		}
		header("Location:index.php");

	}else{
		echo "<script>
	             alert('Invalid login credentials!'); 
	             window.history.go(-1);
	     	</script>";
	}

?>