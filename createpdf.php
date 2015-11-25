<?php
 
 
	

 require("dbase/config.inc.php");
require("dbase/Database.class.php");
include('mpdf60/mpdf.php');
include('mpdf.php');
$mpdf=new mPDF();
$mpdf->Bookmark('Start of the document');

$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

  $id = $_GET["id"]; 
$action = $_GET["action"];
 // $id = "1";

	$sqlCompletedExam = "Select * from tblcompletedeexam as A left outer join tblassestmenttype as B on A.assessment_type_id=B.id left outer join tblstudents as C on A.student_id=C.id where A.id='".$id."'";
	
	$rowCompletedExam = $db->query($sqlCompletedExam);	
	$json = [];
	while($recCompletedExam = $db->fetch_array($rowCompletedExam))
	{
		$json = $recCompletedExam;
/*
		$details = array
			(
				'id' => $recCompletedExam["id"],
				'question_id' => $recCompletedExam["question_id"],
				'finished_date' => $recCompletedExam["finished_date"],
				'correct_answer' => $recCompletedExam["correct_answer"],
				'inccorrect_answer' => $recCompletedExam["inccorrect_answer"],
				'learning_category_results' => $recCompletedExam["learning_category_results"],
				'major_outcome_results' => $recCompletedExam["major_outcome_results"],
				'time_taken' => $recCompletedExam["time_taken"]
			);
*/
			//array_push($json, $details);	
	}

function secondsToTime($seconds)
{
    // extract hours
    $hours = floor($seconds / (60 * 60));
 
    // extract minutes
    $divisor_for_minutes = $seconds % (60 * 60);
    $minutes = floor($divisor_for_minutes / 60);
 
    // extract the remaining seconds
    $divisor_for_seconds = $divisor_for_minutes % 60;
    $seconds = ceil($divisor_for_seconds);
 
    // return the final array
    $obj = array(
        "h" => (int) $hours,
        "m" => (int) $minutes,
        "s" => (int) $seconds,
    );
    return $obj;
}

//echo "1111;".$json["time_taken"];
//date('F d, Y').

$time_taken = gmdate ('H:i:s', $json['time_taken']);;
$completion_date = $json["finished_date"];
$subject = $json["subject"];
$type = $json["type"];
$first_name = $json["fname"];

//Get Correct Answer
$cntCorrectAnswer = strlen($json["correct_answer"]) ? count(explode(',', $json["correct_answer"])) : 0;
$cntsupplementary_correct = strlen($json["supplementary_correct"]) ? count(explode(',', $json["supplementary_correct"])) : 0;
$totalCorrect = $cntsupplementary_correct + $cntsupplementary_correct;

//$cntInCorrectAnswer = count(explode(",", $json["incorrect_answer"]));
$cntQuestion_id = strlen($json["question_id"]) ? count(explode(',', $json["question_id"])) : 0;
$cntSupplementary_question_id = strlen($json["supplementary_question_id"]) ? count(explode(',', $json["supplementary_question_id"])) : 0;
$totalQuestions = $cntQuestion_id;

$primaryScore = $cntCorrectAnswer." / ".$totalQuestions;
$supplementaryScore = $cntsupplementary_correct." / ".$cntSupplementary_question_id;

$arrLearningCategory = explode(",", $json["learning_category_results"]);

$learningCat = "";
for($i = 0; $i < count($arrLearningCategory); $i++)
{
	$arrLearnResult = explode(" - ", $arrLearningCategory[$i]);	
	$sql = "Select * from tbllearningcategories as A left outer join tbllearningtopics as B on A.learning_topic_id=B.id  where A.id='".$arrLearnResult[0]."'";
	$rows = $db->query_first($sql);
	$learningCat .= "<h3> ".$rows["name"]." - ".$arrLearnResult[1]."</h3>";
}


$arrMajorOutcome = explode(",", $json["major_outcome_results"]);
$arrmajor_outcome_supplementary = explode(",", $json["major_outcome_supplementary"]);

function findMatchSupplementary($MajorResult)
{
	$suppResult = "0%";
	for($i = 0; $i < count($arrmajor_outcome_supplementary); $i++)
	{
		$arrmajor_outcome_supplementaryResult = explode(" - ", $arrmajor_outcome_supplementary[$i]);
		if($MajorResult == $arrmajor_outcome_supplementaryResult[0]){
			$suppResult =  $$arrmajor_outcome_supplementaryResult[1];
		}
	}
	return $suppResult;

}
$majorOut = "";
for($i = 0; $i < count($arrMajorOutcome); $i++)
{
	$arrMajorResult = explode(" - ", $arrMajorOutcome[$i]);
	$supplementarResult = findMatchSupplementary($arrMajorResult[0]);
	$majorOut .= "<tr><td>".$arrMajorResult[2]."</td><td>".$arrMajorResult[1]."</td><td>".$supplementarResult."</td></tr>";
	//$majorOut .= "<h3> Learning Category Id ".$arrMajorOutcome[$i]."</h3>";
}



$pdfContent = "
<!DOCTYPE html>
<html lang='en'>
  <head>
	<!--<base href='responsive/demo/responsive-tables/'>--><!--[if lte IE 6]></base><![endif]-->
    <meta charset='utf-8'>
    <title>Online Result</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content='A demo of some techniques for developing responsive tables.'>
    <link href='responsive/assets/css/bootstrap.min.css' rel='stylesheet'>
	<style>body { padding-top: 60px; }
	  table { width: 100%; }
	  td, th {text-align: left; white-space: nowrap;}
	  td.numeric, th.numeric { text-align: right; }
	  h2, h3 {margin-top: 1em;}
	  section {padding-top: 40px;}
    </style>
    <link href='responsive/assets/css/bootstrap-responsive.min.css' rel='stylesheet'>
	<link href='responsive/assets/css/unseen.css' rel='stylesheet'>
	<link href='responsive/assets/css/flip-scroll.css' rel='stylesheet'>
	<link href='responsive/assets/css/no-more-tables.css' rel='stylesheet'>
	<link href='responsive/assets/css/prettify.css' rel='stylesheet'>
	
    <!--[if lt IE 9]>
      <script src='//html5shim.googlecode.com/svn/trunk/html5.js'></script>
    <![endif]-->
  </head>
  <body style='margin-left:50px;margin-right:50px;margin-top:-30px;'>
   	   <section id='no-more-tables'>
   	   	
   	  	<h2><strong>Completion Date: </strong>". $completion_date ."</h2>
   	  	<h2><strong>Student Name: </strong>". $first_name ."</h2>
   	  	<h2><strong>Assessment Type: </strong> ".$subject." ".$type." </h2>
   	  	<h2><strong>Overall Score: </strong> ".$primaryScore." </h2>
   	  	<h2><strong>Supplementary Questions: </strong> ".$supplementaryScore." </h2>
   	  	<h2><strong>Time Taken: </strong> ".$time_taken." </h2>
   	  	<h2><strong>Overview</strong> </h2>
   	  		".$learningCat."
   	  	<h2><strong>Recommendations</strong> </h2>

   	  	<table class='table table-hover table-striped order-table table-blue'>
							<thead>
								<tr>
									<th>Major Outcome</th>
									<th>Results</th>
									<th>Supplementary</th>
								</tr>
							</thead>
							<tbody>
								".$majorOut."
							</tbody>
			</table>
  	 </section>
    </div> <!-- /container -->

    <script src='responsive/assets/js/jquery-1.7.1.min.js'></script>
    <script src='responsive/assets/js/bootstrap.min.js'></script>
	<script src='responsive/assets/js/prettify.js'></script>
	<script>
		$(function(){
			prettyPrint();
		});
	</script>
	<script type='text/javascript'>
	<!--//--><![CDATA[//><!--
	try {var pageTracker = _gat._getTracker('UA-55411-1');pageTracker._trackPageview();} catch(e) {}
	//--><!]]>
	</script>
	
  </body>
</html>  
";
 
// 


$mpdf->WriteHTML($pdfContent);

if($action == "pdf"){
	$mpdf->Output('MyPDF.pdf', 'D');
}
if($action == "print"){
		$mpdf->Output('MyPDF.pdf', 'I');

}


 
 
?>