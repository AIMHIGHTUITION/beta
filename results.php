<?php 
	session_start();

	if ($_SESSION['log']!=true) {
		header("Location:login.php");
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
	<title>Student Diagnostic | Results</title>
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="css/style.css" rel="stylesheet">
	<script src="js/custom.modernizr.js" type="text/javascript" ></script>
</head>
<body>
	<div class="container"><!-- Main Container starts here -->
		<div class="row navbar-fixed-top" id="top-navigation">
			<header class=" col-sm-12 col-md-8"><!-- Navigation header starts here -->
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
								if ($sessionType == 't') {
									echo "<li><a href=\"student_pl.php\">Student Program</a></li>";		
									echo "<li><a href=\"tutor_resources.php\">Resources</a></li>";						
								}else{
									echo "<li><a href=\"assessmentsetup.php\">Assessments</a></li>";
									echo "<li class=\"active\"><a href=\"results.php\">Results</a></li>";
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

		<div id="resheader-size" class="row"><!-- Page Header starts here -->
			<div class="col-md-9" >
				<div class="page-title"><h1>Results</h1></div> 
			</div>
		</div><!-- Page Header ends here -->		

		<section class="row"><!-- Results table ends here -->
			<div class="col-sm-12 col-md-12">
				<div class="widget-box">
					<div class="widget-title">
						<h2><i class="glyphicon glyphicon-tasks"></i>Assessment Results</h2>
					</div>
					<div class="widget-container table-responsive">
						<table class="table table-hover table-striped order-table table-blue">
							<thead>
								<tr>
									<th>Tests</th>
									<th>Date</th>
									<th>Time</th>
									<th>Total</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="tblResult">
								
							</tbody>
						</table>	
					</div>
				</div>
			</div>
		</section><!-- Results table ends here -->
		
		<section id="result-detail" class="panel-collapse collapse row"><!-- Result Detail -->
			<div class="col-sm-12 col-md-12">
				<div class="widget-box">
					<div class="widget-title">
						<h2><i class="glyphicon glyphicon-list-alt"></i>Result Details</h2>
					</div>
					<div class="widget-container table-responsive">
						<table class="table table-hover table-striped order-table table-green">
							<thead>
								<tr>
									<th>Major Outcome #</th>
									<th>Result</th>
									<th>Comments</th>
								</tr>
							</thead>
							<tbody id="majorOutcomeTable">
								<tr>
									<td>1</td>
									<td>50%</td>
									<td>Work a little harder</td>
								</tr>
								<tr>
									<td>2</td>
									<td>70%</td>
									<td>Great Job!</td>
								</tr>
								<tr>
									<td>3</td>
									<td>100%</td>
									<td>Perfecct!</td>
								</tr>
								<tr>
									<td>Supplementary Questions</td>
									<td colspan="2"></td>
								</tr>
								<tr>
									<td>Recommendations</td>
									<td colspan="2"></td>
								</tr>
							</tbody>
						</table>	
					</div>
				</div>
			</div>
		</section><!-- Result Detail -->
		<section id="result-detail2" class="panel-collapse collapse row"><!-- Result Detail -->
			<div class="col-sm-12 col-md-12">
				<div class="widget-box">
					<div class="widget-title">
						<h2><i class="glyphicon glyphicon-list-alt"></i>Result Details</h2>
					</div>
					<div class="widget-container table-responsive">
						<table class="table table-hover table-striped order-table table-green">
							<thead>
								<tr>
									<th>Major Outcome #</th>
									<th>Result</th>
									<th>Comments</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>50%</td>
									<td>Work a little harder</td>
								</tr>
								<tr>
									<td>2</td>
									<td>70%</td>
									<td>Great Job!</td>
								</tr>
								<tr>
									<td>3</td>
									<td>100%</td>
									<td>Perfecct!</td>
								</tr>
								<tr>
									<td>Supplementary Questions</td>
									<td colspan="2"></td>
								</tr>
								<tr>
									<td>Recommendations</td>
									<td colspan="2"></td>
								</tr>
							</tbody>
						</table>	
					</div>
				</div>
			</div>
		</section><!-- Result Detail -->
		<section id="result-detail3" class="panel-collapse collapse row"><!-- Result Detail -->
			<div class="col-sm-12 col-md-12">
				<div class="widget-box">
					<div class="widget-title">
						<h2><i class="glyphicon glyphicon-list-alt"></i>Result Details</h2>
					</div>
					<div class="widget-container table-responsive">
						<table class="table table-hover table-striped order-table table-green">
							<thead>
								<tr>
									<th>Major Outcome #</th>
									<th>Result</th>
									<th>Comments</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>50%</td>
									<td>Work a little harder</td>
								</tr>
								<tr>
									<td>2</td>
									<td>70%</td>
									<td>Great Job!</td>
								</tr>
								<tr>
									<td>3</td>
									<td>100%</td>
									<td>Perfecct!</td>
								</tr>
								<tr>
									<td>Supplementary Questions</td>
									<td colspan="2"></td>
								</tr>
								<tr>
									<td>Recommendations</td>
									<td colspan="2"></td>
								</tr>
							</tbody>
						</table>	
					</div>
				</div>
			</div>
		</section><!-- Result Detail -->
		<footer class="footer">
			<p>Copyright © 2015<a href="#">• Student Diagnostics | Aim High Tuition</a> • All Rights Reserved</p>
		</footer>
	</div><!-- Main Container ends here -->
	
	<!-- Important js put in all pages -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>
	window.jQuery || document.write('<script src="js/jquery.js"><\/script>')
	</script>
	<script src="js/bootstrap.min.js"></script>
	<!-- Important js for all pages end  -->

	<!-- Fix plugins -->
	<script type="text/javascript" src="js/ios-orientationchange-fix.js"></script>

	<!-- knob plugins -->
	<script src="js/jquery.knob.js"></script>

	<!-- Charts plugins -->
	<script type="text/javascript" src="js/chart/jquery.flot.min.js"></script>
	<script type="text/javascript" src="js/chart/jquery.flot.stack.min.js"></script>
	<script type="text/javascript" src="js/chart/jquery.flot.pie.min.js"></script>
	<script type="text/javascript" src="js/chart/jquery.flot.resize.min.js"></script>

	<!-- Init plugins and custom javascript-->
	<script src="js/custom.js"></script>
	   <script type="text/javascript">
			  	var arrListId = [];
			  	 var counterMin = 0;
			  	  var statFname = "";
			  	  var hideMe = "";
		        $(document).ready(function(){
			        
			        
			        showOthers = function(me){
				        var nextLoad = me*2;
				        $("#load"+me).hide();
				        $("#load"+nextLoad).show();

						var i = 0;
						var tmpCounter = me;
						while(i < 5){
							$("#"+tmpCounter).show();
							tmpCounter++;
							i++;
						}
					}
			        displayCompletedExam = function(element,index){
				        console.log(element);
				        
				        var arrDataTime = element.finished_date.split(" ");
				        var major_outcomes = element.major_outcome_results;
	
				        if(element.correct_answer != "")
				        	var correctNum =  String(element.correct_answer).split(",").length;
				        else
					        var correctNum = 0;
				        
				        var totalQuestion =  String(element.question_id).split(",").length;
				        var date  = arrDataTime[0];
				        var time  = hours_am_pm(arrDataTime[1]);				     
				        var subjectype  = element.subjectype;
				        var supplementary_question_id  = element.supplementary_question_id;
				        var supplementary_correct  = element.supplementary_correct;
				        var supplementary_subjectype  = element.supplementary_subjectype;
				        var fname  = element.fname;
				        var id  = element.id;
				       
				       
				        
				        
				     

				        
				function hours_am_pm(time) {
				    var hours = Number(time.match(/^(\d+)/)[1]);
				    var min =  Number(time.match(/:(\d+)/)[1]);
				    if (min < 10) min = "0" + min;
				    if (hours < 12) {
				        return hours + ':' + min + ' AM';
				    } else {
				        hours=hours - 12;
				        hours=(hours < 10) ? '0'+hours:hours;
				        return hours+ ':' + min + ' PM';
				    }
				}

				showMajorResults = function(me){

					var content = $(me).attr("data-content");
					var arrContent = content.split(",");
					$("#majorOutcomeTable").html("");
					for(var i = 0; i < arrContent.length; i++){
						console.log(arrContent[i]);
						var splitContent = arrContent[i].split(" - ");
						$("#majorOutcomeTable").append('<tr>'+
							'		<td>'+splitContent[2]+'</td>'+
							'		<td>'+splitContent[1]+'</td>'+
							'		<td></td>'+
							'	</tr>')
							
							
					}
					
					$("#majorOutcomeTable").append('<tr>'+
							'		<td>Supplementary Questions</td>'+
							'		<td colspan="2"></td>'+
							'	</tr>'+
							'	<tr>'+
							'		<td>Recommendations</td>'+
							'		<td colspan="2"></td>'+
							'	</tr>')
				
				}
				
				var myname = "";
				var loadMore = "";
				//console.log("RESULT arrListId.indexOf(id) - "+arrListId.indexOf(fname));
				if(arrListId.indexOf(fname) < 0  )
				{
					myname = '<tr><td><h3>'+fname+'</h3></td></tr>';
					
				}
					
					console.log("Counter MIN " + counterMin);
					
					console.log("statFname " + statFname);
					console.log("fname " + fname);
				
					
					if(counterMin%5 == 0 && statFname == fname){

						
						loadMore = '<tr id="load'+index+'" style="'+hideMe+'"><td colspan="0" style=="text-align:center;cursor:pointer;"><div style="text-align:center;cursor:pointer" onclick=showOthers("'+index+'")>Click to see more results!</div></td></tr>'	

						console.log("LOAD MORE------------------------");
						hideMe = "display:none;"; 
					}
					
						if(statFname != fname){
						hideMe = "";
						counterMin = 1;
					}else{
						counterMin++;
					}
					
					
				        $("#tblResult").append(myname+'<tr id="'+index+'" style="'+hideMe+'">'+
							'		<td>'+subjectype+'<br />'+supplementary_subjectype+'</td>'+
							'		<td>'+date+'</td>'+
							'		<td>'+time+'</td>'+
							'		<td>'+correctNum+" / "+ totalQuestion +'<br />'+supplementary_correct+" / "+ supplementary_question_id +'</td>'+
							'		<td>'+
							'		<button onclick="showMajorResults(this)" type="button" class="btn btn-xs btn-primary accordion-toggle" data-content="'+major_outcomes+'" data-toggle="collapse" data-parent="#accordion" href="#result-detail">'+
							'				<i class="glyphicon glyphicon-eye-open"></i>Results'+
							'			</button>'+
							'			<a href="createpdf.php?id='+element.id+'&action=pdf" target="_blank"><button id="btnPDF'+element.id+'" type="button" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-file"></i>PDF</button></a>'+
							'   <a href="createpdf.php?id='+element.id+'&action=print" target="_blank"><button type="button" class="btn btn-xs btn-darkgreen"><i class="glyphicon glyphicon-print"></i>Print</button></a>'+			
							'		</td>'+
							'	</tr>'+loadMore);
					
				}
			        $.ajax({ 
			            type: 'POST', 
			            url: '_fetchCompleteExam.php', 
			            data: { action: "getCompletedExam", parent_id: "<?PHP echo $id; ?>"}, 
			            dataType: 'json',
			            success: function (data) { 
			                $.each(data, function(index, element) {
				                	
			        	        displayCompletedExam(element,index);
			        	        statFname = element.fname;
			        	        arrListId.push(element.fname);
			                });
			            }
			        });
		        });
		        </script>
</body>
</html>