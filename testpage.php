<?php 
	session_start();

	if ($_SESSION['log']!=true) {
		header("Location:login.html");
		exit();
	}

	require("dbase/config.inc.php");
	require("dbase/Database.class.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();

	$id = $_SESSION['id']; //login user ID
	$sessionType = $_SESSION['type']; 
	
	
	
	
	
	
	
	
?>
<!DOCTYPE html>
<html class="no-js" lang="en" >
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="description" content="Student Diagnostic"/>
	<meta name="keywords" content="Online Assessment, Test Prep, Tutors, Review Center" />
	<meta name="author" content="Aim High Tuition"/>
	<link rel="shortcut icon" href="favicon.png">

	<title>Student Diagnostic | Assessment</title>
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.css" rel="stylesheet">

	<!-- Daneden animate CSS -->
	<link href="css/animate.css" rel="stylesheet">
	<link href="css/animate.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="css/style.css" rel="stylesheet">

	<!-- Data-Table style -->
	<link href="css/jquery.dataTables.css" rel="stylesheet">
	 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

	
	<style>
		.choices input{
		cursor: pointer;
font-size: 19px;
height: 18px;
margin-left: 15px;
width: 20px;
		}
		
		
		    label, input { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    div#users-contain { width: 350px; margin: 20px 0; }
    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
    
    
		</style>

  
	<script src="js/custom.modernizr.js" type="text/javascript" ></script>
	
		<link rel="stylesheet" href="progressbar/libs/jquery-ui-1.8.22.custom.css" />
		<link rel="stylesheet" href="progressbar/src/jquery.ui.multiprogressbar.css" />
		<style type="text/css">
		.container {
			width: 50%;
			margin-top: 1em;
		}
		
		.blue {
			background: blue;
		}
		
		.red {
			background: red;
		}
		
		.redText {
			color: red;
		}
		
		.gradient {
			background: #4096ee;
			background: -moz-linear-gradient(top,  #4096ee 0%, #44d6ff 76%, #4096ee 99%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#4096ee), color-stop(76%,#44d6ff), color-stop(99%,#4096ee));
			background: -webkit-linear-gradient(top,  #4096ee 0%,#44d6ff 76%,#4096ee 99%);
			background: -o-linear-gradient(top,  #4096ee 0%,#44d6ff 76%,#4096ee 99%);
			background: -ms-linear-gradient(top,  #4096ee 0%,#44d6ff 76%,#4096ee 99%);
			background: linear-gradient(to bottom,  #4096ee 0%,#44d6ff 76%,#4096ee 99%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4096ee', endColorstr='#4096ee',GradientType=0 );
		}
		
		.footnote {
			color: black;
			font-style: italic;
			font-size: small;
		}
		</style>
		
</head>
<body>
	
	<div id="dialogAlert" title="Alert">
		<label for="name">Please put your answer or skip the question.</label>
	</div>
		<div id="dialogPause" title="Pause My Exam">
		
		
		<label for="name">Are you sure you want to pause this exam and return later?</label>
	</div>
	<div id="dialog-form" title="Submit Report on this question">
		
	
		
  <p class="validateTips">All form fields are required.</p>
 
  <form>
    <fieldset>
      <label for="name">Please tell us what's wrong with this question</label>
      <input type="textarea" name="flagged_message" id="flagged_message" value="" class="text ui-widget-content ui-corner-all">
    </fieldset>
  </form>
</div>


	<div class="container"><!-- Main Container starts here -->
		<div class="row navbar-fixed-top" id="top-navigation">
			<header class="col-sm-12 col-md-8"><!-- Navigation header starts here -->
				<div class="navbar navbar-default">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="index.php"><i class="glyphicon glyphicon-signal"></i>Student Diagnostics</a>
					</div>
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav navbar-right">
							<li><a href="index.php">Dashboard</a></li>
							<?php  
							$loggedUser = 2;
							if ($sessionType == 't') {
								echo "<li><a href=\"student_pl.php\">Student Program</a></li>";		
								echo "<li><a href=\"tutor_resources.php\">Resources</a></li>";						
							}else{
								if ($sessionType == 'p') {
									$loggedUser = 1;								
								}else if($sessionType == 's'){
									$loggedUser = 3;									
								}
								echo "<li><a href=\"assessmentsetup.php\">Assessments</a></li>";
								echo "<li><a href=\"results.php\">Results</a></li>";
								echo "<li><a href=\"resources.php\">Resources</a></li>";									
							}
							?>							
						</ul>						
					</div><!--/.nav-collapse -->
				</div>			
			</header><!-- Navigation header ends here -->

			<div class="input-group col-md-3" id="custom-search">
				<input type="text" class="form-control" placeholder="Search...">
				<span class="input-group-btn"><button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button></span>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-1 nav-user">
				<ul class="nav navbar-nav pull-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> User<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="profile.php"><i class="glyphicon glyphicon-cog"></i> My Profile</a></li> 
							<?php 
							if ($sessionType == 't') {
								echo "<li><a href=\"student_lookup.php\"><i class=\"glyphicon glyphicon-search\"></i>Student Lookup</a></li>";
							}elseif ($sessionType == 'p') {
								echo "<li><a href=\"tutor_lookup.php\"><i class=\"glyphicon glyphicon-search\"></i>Tutor Lookup</a></li>";
							}
							?>
							<li><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i>Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<br />
	<br />
	<br />
	<div class="row">
		<div class="col-sm-12 col-md-10 sign-in animated flipInY">
			<div id="signup" class="lock-screen" >
				<div id="assmnttitle" class="title icon-space"><i class="glyphicon glyphicon-bookmark"></i> <?php echo $_GET['exmtle']; ?></div>
				<form action="/signin" method="post" class="form-stacked">
					<fieldset>
						<div class="col-sm-12 col-md-12">
							<div class="widget-box" >
								<div class="widget-container">									
									<p class="pull-right"><i class="glyphicon glyphicon-bell"></i> Time remaining <span id="timer"></span>									
									</p>																
									<div>
										<div id="contentQuestion" style="min-height: 300px;">
											<div id=""><h3 id="titleQuestion"></h3></div>
											<img id="imgSource" src="" />
											<div id=""><h4 id="instructionTitle">Choose your Answer</h4></div>
											<div id="choices" class="choices"></div>
										
										</div>
											<div>
												<div id="btnNext" style="background-color: blue; font-size: 17px; color: white; text-align: center; padding: 7px; width: 60px; margin: 9px; cursor: pointer;">NEXT</div>
												<div id="btnSkip" style="background-color: blue; font-size: 17px; color: white; text-align: center; padding: 7px; width: 60px; margin: 9px; cursor: pointer;">SKIP</div>
											
												<div class="container" style="margin-left: 170px;">
														<div id="txtProgress">Your Progress</div>
														<div id="styled"></div>
													</div>
													
												<div class="container" style="width: 300px; margin-top: -49px; margin-left: 659px;">
														<div id="txtProgress2"></div>
														<div id="supplementaryBar"></div>
													</div>
													
									
													
											</div>		
									</div>
							</div>
									<p style="margin-top: 57px"><a id="btnFlag" style="cursor: pointer;"><i class="glyphicon glyphicon-flag"></i> See a problem with this question? Click here to report</a><span class="pull-right">Question <span id="counterAnswerTxt">0</span></span></p>			

											
										
										<div id="pause" style="display: block; background-color: orange; width: 12%; text-align: center; color: black; padding: 10px; font-size: 23px; cursor: pointer;">Pause and Return later</div>	
							</div>
								
						</div>								
					</fieldset>
				</form>
			</div>																									
		</div>
		<footer class="footer">
			<p>Copyright © 2015<a href="#">• Student Diagnostics | Aim High Tuition</a> • All Rights Reserved</p>
		</footer>
	</div>
</div><!-- Main Container ends here -->	

<!-- Important js put in all pages -->
<script src="js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="progressbar/libs/jquery.outerhtml.js"></script>
<script type="text/javascript" src="progressbar/src/jquery.ui.multiprogressbar.js"></script>

  
<script>
window.jQuery || document.write('<script src="js/jquery.js"><\/script>')
</script>

<!-- Important js for all pages end  -->

<!-- Fix plugins -->
<script type="text/javascript" src="js/ios-orientationchange-fix.js"></script>

<!-- Data table plugins -->
<script src="js/jquery.dataTables.min.js"></script>

<!-- Init plugins and custom javascript-->
<script src="js/custom.js"></script>
<script type="text/javascript">
	var arrQuestions = [];
	$( document ).ready(function() { 
		
		var count = 14400; //seconds
		var counter 
		var questionCounter = 0;
		var Studentid = "<?PHP echo $_GET["id"]; ?>";
		var asstype = "<?PHP echo $_GET["type"]; ?>";
		var yrlvl = "<?PHP echo $_GET["yrlvl"]; ?>";
		var exmtle = "<?PHP echo $_GET["exmtle"]; ?>";
		var counterAnswer = 0;
		var tmpID = 1;
		var defaultTime = 0;
		var tmpCurrentTime = 0;
		var subtotalTime = 0;
		var myVar
		var totalPrimary = -1;
		var questionType = "";
		var yearLevel
		
		var currentQuestion = 0;
		var currentAnswerValue = "";
		var currentQuestionID = "";
		var totalSupplementary = 0;
		var counterSupplementary = 0;
		var isSupplementary = false;
		
		
		 
		function timer() 
		{
		    count = count - 1;
		    if (count == -1) {
		        clearInterval(counter);
		        return;
		    }
		    var seconds = count % 60;
		    var minutes = Math.floor(count / 60);
		    var hours = Math.floor(minutes / 60);
		    minutes %= 60;
		    hours %= 60;
		    document.getElementById("timer").innerHTML = hours + " hours " + minutes + " minutes and " + seconds + " seconds left"; // watch for spelling
		}
	
		//Function to show Questions
		showQuestion = function(num)
		{	
			console.log("Question Number "+num)
			var element = arrQuestions[num];
			currentQuestionID = element.id;
			$("#titleQuestion").html(element.question);
			var choices = element.choices;
			console.log(num+"Choices - "+choices);
			var arrChoices = choices.split(",");
			$("#choices").html("");
			var imgsrc = "math assessment img/img_"+element.id+".JPG";
			var imgcheck = imgsrc.width;
			
		
			$("#imgSource").hide();
			//$("#contentQuestion").css("height",500)
			$("<img src='math assessment img/img_"+element.id+".JPG'>").load(function(){ 
				$("#imgSource").show();
				$("#imgSource").attr("src","math assessment img/img_"+element.id+".JPG");
			
			
			});
	
			
			var data = element.answer;
			if(data == undefined){
				data = "";
			}
			
			console.log("Choices: "+choices);
			if(choices == "t" || choices == "")
			{

$("#instructionTitle").html("Type Your Answer");
				$("#choices").append("<input data='"+num+"' style='width: 200px; height: 29px;' onkeyup=saveAnswer(this) type='text' name='"+num+"' value='"+data+"' >");

			} 
			else if(choices == "i")
			{
				$("#instructionTitle").html("Type Your Answer");
				$("#choices").append("<input data='"+num+"' style='width: 200px; height: 29px;' onkeyup=saveAnswer(this) type='text' name='"+num+"' value='"+data+"' >");
			} 
			else if(arrChoices.length >= 1)
			{	
				$("#instructionTitle").html("Choose your Answer");
				for(var i = 0; i < arrChoices.length; i++)
				{
					if(data == arrChoices[i]){
					$("#choices").append("<input data='"+num+"' checked='checked' onclick=saveAnswer(this) type='radio' name='"+num+"' value='"+arrChoices[i]+"' >"+arrChoices[i]);
					}else{
						var choice = arrChoices[i].trim();
					$("#choices").append("<input data='"+num+"' onclick=saveAnswer(this) type='radio' name='"+num+"' value='"+choice+"' >"+choice);
					}
				}
			}
			
			if(element.flagged_for_review == "1"){
				$("#btnFlag").hide();
			}else{
				$("#btnFlag").show();
			}
			//Show Progress bar
			//(5/50) × 100
			if(isSupplementary){
				counterSupplementary++;
				console.log(counterSupplementary+" - "+totalSupplementary)
				var progressSupp = ((counterSupplementary-1)/totalSupplementary)*100;
				$("#txtProgress2").html("Your Progress in Supplementary Question");
				$('#supplementaryBar').multiprogressbar({
					parts:[{value: progressSupp, text: true, barClass: "gradient", textClass: "redText"}]
				});
				
			}
			
			
				
			var progressValue = ((counterAnswer-1)/totalPrimary)*100;
			$('#styled').multiprogressbar({
				parts:[{value: progressValue, text: true, barClass: "blue", textClass: "redText"}]
			});
			
			
			
		}
		//Check if its diagnostic or not
		if(exmtle.indexOf("Diagnostic") !== -1){
			console.log("Found")
			yearLevel = yrlvl - 1;
		}else{
			yearLevel = yrlvl;
		}
		var tmpdonePrimary = 0;
		var tmpTotal = 0;
		$.ajax({ 
		    type: 'POST', 
		    url: '_fetchquestions.php', 
		    data: { action: "getQuestions", id: Studentid,year:yearLevel,asstype:asstype	}, 
		    dataType: 'json',
		    success: function (data) { 
		        $.each(data, function(index, element){
					arrQuestions.push(element);
			        if(element.donePrimary != "")
			        {
				        tmpdonePrimary = element.donePrimary;
			        }
			        totalPrimary = element.totalPrimary;
					totalSupplementary = element.totalSupplementary;
					counterSupplementary = element.doneSupplementary;
					if(totalSupplementary != "0"){
						isSupplementary = true;
						
					}
			        
			        if(totalPrimary == "0"){
					tmpTotal = index;
				        }
		        });
		        
		        if(tmpTotal != 0)
		        {
		        	totalPrimary = parseInt(tmpTotal)+1;
		        }

			    currentQuestionID = arrQuestions[0].id;
				counterAnswer = parseInt(tmpdonePrimary)+1;
				myVar = setInterval(myTimer, 1000);
				
		        count = count - subtotalTime;
		        counter = setInterval(timer, 1000); //1000 will  run it every 1 second
		        
		        submitAnswer = function(answer){
			        if(answer != "")
			   	   {
						saveMyAnswer();
						$("#btnFlag").html('<i class="glyphicon glyphicon-flag"></i>See a problem with this question? Click here to report');
						
						currentAnswerValue = "";
						var isSubmitAnswer = false;
						
						if(isSupplementary){
							if(counterSupplementary == totalSupplementary ){
									isSubmitAnswer = true;
							}
							
							
						}else{
							if(counterAnswer == totalPrimary ){
								
								isSubmitAnswer = true;
							}
								
						}
						
						if(isSubmitAnswer )
						{			
							if(exmtle.indexOf("Diagnostic") !== -1){
								yearLevel = yrlvl - 2;
							}else{
								yearLevel = yrlvl - 1;
							}
						var tmpCounterAnswer = counterAnswer;
						$.ajax({ 
						    type: 'POST', 
						    url: '_submitanswers.php', 
						    data: { student_id: Studentid, yearLevel:yearLevel, assType:asstype}, 
						    dataType: 'json',
						    success: function (data) { 
							    if(data == ""){
								     currentQuestion--;
								        $(".widget-container").html("<h1>Congratulation. Your Exam result is "+element.result+" / "+tmpCounterAnswer+"</h1>");
								        $(".widget-container").append("<br/><h2><a href='results.php?id="+element.rowId+"'>Click Here to View Detailed Results and Download your personalized Report</a></h2>");
								        clearTimeout(myVar);
								        $("#pause").hide();
								        counterAnswer--;
							    }else{
								    
							   
						        $.each(data, function(index, element) {
							        if(element.message == "success")
							        {
								        currentQuestion--;
								        $(".widget-container").html("<h1>Congratulation. Your Exam result is "+element.result+" / "+tmpCounterAnswer+"</h1>");
								        $(".widget-container").append("<br/><h2><a href='results.php?id="+element.rowId+"'>Click Here to View Detailed Results and Download your personalized Report</a></h2>");
								        clearTimeout(myVar);
								        $("#pause").hide();
								        counterAnswer--;
								        
							        }else{
								       
								        isSupplementary = true;
								        arrQuestions.push(element);
										totalSupplementary++;
								        //totalPrimary++;
								        $("#txtProgress2").html("Your Progress in Supplementary Question");
							        }
							        
						        });
						       }  
						        counterSupplementary++;
						        			var progressSupp = ((counterSupplementary-1)/totalSupplementary)*100;
											$('#supplementaryBar').multiprogressbar({
												parts:[{value: progressSupp, text: true, barClass: "gradient", textClass: "redText"}]
											});
										
										
			
/*
						        	$('#styleSupplementary').multiprogressbar({
										parts:[{value: 0, text: true, barClass: "blue", textClass: "redText"}]
									});
*/
			
							 		counterAnswer++;
							 		currentQuestion++;
								$("#counterAnswerTxt").html(counterAnswer);
								showQuestion(currentQuestion);
							}
							});
						}
						else
						{
							currentQuestion++;
							counterAnswer++;
							showQuestion(currentQuestion)
							$("#counterAnswerTxt").html(counterAnswer);
						}
					}
					else
					{
						 dialog3.dialog( "open" );
	        		}
		        }
				$("#btnSkip").click(function()
				{
					currentAnswerValue = "skip"
					 submitAnswer(currentAnswerValue)					 
		   		});
		   		
		   		$("#btnNext").click(function()
		   		{	
			   	  submitAnswer(currentAnswerValue)
				});
			
				$("#counterAnswerTxt").html(counterAnswer);
				showQuestion(currentQuestion);
								    
			}
		});

	
		//Save Answer temporarily
		saveAnswer = function(me){
				var id = arrQuestions[currentQuestion].id;
				 currentAnswerValue = $(me).val();
		}
		
		//Send answer to the database
		saveMyAnswer = function(){
		     $.ajax({ 
	            type: 'POST', 
	            url: '_updatedata.php', 
	            data: { question_id: currentQuestionID, student_id:Studentid, answer: currentAnswerValue}, 
	            dataType: 'json',
	            success: function (data) { 
	                $.each(data, function(index, element) {
	        	       
	                });
	            }
	           
	        });
		}
		
		function myTimer() 
		{
			var currentTimer = arrQuestions[currentQuestion].time_to_answer;
			if(currentTimer == undefined || currentTimer == NaN || currentTimer == ""){
				currentTimer = 1;
			}else{
				currentTimer++;
			}
			arrQuestions[currentQuestion].time_to_answer = currentTimer;
			console.log("Timer "+arrQuestions[currentQuestion].time_to_answer);
			//RETURN THE POST HERE
			$.ajax({ 
	            type: 'POST', 
	            url: '_updatetimer.php', 
	            data: { question_id: currentQuestionID, student_id:Studentid, time_to_answer:arrQuestions[currentQuestion].time_to_answer}, 
	            dataType: 'json',
	            success: function (data) { 
	                $.each(data, function(index, element) {
	        	       
	                });
	            }
	           
	        });
		}
		
		

/*
		$("#btnFlag").click(function(){
			
			var mymessage = prompt("Please tell us what's wrong with this question.", "");
if (mymessage != null) {
	var id = arrQuestions[currentQuestion].id;
			$.post( "_flagforreview.php", { questionId: id, flagged_message:mymessage})
			.done(function( data ) {	
				$("#btnFlag").html('<i class="glyphicon glyphicon-flag"></i> Flagged')
			});
}


		
		});
*/


///Dialog
var dialog,dialog2, form, flagged_message = $( "#flagged_message" )
      
    function addUser() {
     
       var id = arrQuestions[currentQuestion].id;
			$.post( "_flagforreview.php", { questionId: id, flagged_message:flagged_message.val()})
			.done(function( data ) {	
				$("#btnFlag").html('<i class="glyphicon glyphicon-flag"></i> Flagged')
				  dialog.dialog( "close" );
			});
      
     return true;
    }
 pauseAssessment = function(){
	 dialog2.dialog( "close" );
	 window.location.href = "assessmentsetup.php";
    clearTimeout(myVar);
	$(".widget-container").hide();
	$("#pause").html("Resume");
 }
    dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 300,
      width: 350,
      modal: true,
      buttons: {
        "Report": addUser,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {
        form[ 0 ].reset();
      }
    });
 
    form = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      addUser();
    });
    
    dialog2 = $( "#dialogPause" ).dialog({
      autoOpen: false,
      height: 200,
      width: 350,
      modal: true,
      buttons: {
        "Yes": pauseAssessment,
        "No": function() {
          dialog2.dialog( "close" );
        }
      },
      close: function() {
        form[ 0 ].reset();
      }
    });
    
     dialog3 = $( "#dialogAlert" ).dialog({
      autoOpen: false,
      height: 150,
      width: 350,
      modal: true,
      buttons: {
        "Ok": function() {
          dialog3.dialog( "close" );
        }
      },
      close: function() {
        form[ 0 ].reset();
      }
    });
 
    form = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      addUser();
    });


 
 
 $("#btnFlag").click(function(){
	 dialog.dialog( "open" );
 })
 
 $("#pause").click(function(){
			if($("#pause").html() == "Resume"){
				$("#pause").html("Pause and Return later");
				$(".widget-container").show();
				myVar = setInterval(myTimer, 1000);
				
			}else{
				dialog2.dialog( "open" );
			}
		});
		
		
    



});
</script>
</body>
</html>