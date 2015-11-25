<?php 

	require("dbase/config.inc.php");
	require("dbase/Database.class.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();

$studenId = $_POST["parentId"];

$sql = "select DISTINCT A.assessment_type_id, A.student_id as student_id, A.start_date, sum(A.time_to_answer) as time_to_answer, concat(round(sum(if(A.status IS NOT NULL,1,0))/count(A.question_id)*100,2)) as 'Unaswered', B.type, B.subject, C.fname as firstname from tbltemporarygenexam as A left outer join tblassestmenttype as B on A.assessment_type_id=B.id left outer join tblstudents as C on A.student_id=C.id left outer join tblparents as D on C.parent_id=D.id where D.id='".$studenId."' group by A.student_id, A.assessment_type_id";
//echo $sql;
$rowUnanswered = $db->query($sql);
$json = array();
while($recordSupp = $db->fetch_array($rowUnanswered))
{
if($recordSupp["Unaswered"] == "0.00" || $recordSupp["Unaswered"] == "100%"){
	$sql = "Delete FROM tbltemporarygenexam where student_id='".$studenId."' and assessment_type_id='".$recordSupp["assessment_type_id"]."'";
	$row = $db->query($sql);
}else{
	
	$details = array
	(
		'assessment_type_id' => $recordSupp["assessment_type_id"],
		'Unaswered' => $recordSupp["Unaswered"],
		'time_to_answer' => gmdate("H:i:s",$recordSupp["time_to_answer"]),
		'start_date' => gmdate("d/m/y",strtotime($recordSupp["start_date"])),
		'type' => $recordSupp["type"],
		'student_id' => $recordSupp["student_id"],
		'firstname' => $recordSupp["firstname"],
		'subject' => $recordSupp["subject"]
	);
	array_push($json, $details);	

}
			
}
	echo json_encode($json);
	mysql_close();
	
		
 ?>