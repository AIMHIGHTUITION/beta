<?php 
	session_start();

	if($_SESSION['id'] == "" || $_SESSION['type'] == ""){
		header("Location: login.php");
		exit();
	}

	require("dbase/config.inc.php");
	require("dbase/Database.class.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();

	$id = $_SESSION['id']; //login user ID
	$sessionType = $_SESSION['type']; 
	$yrlvl = "";

	$yrlvlquery = "SELECT year_level FROM tblstudents where id='$id'";
	$row = $db->query($yrlvlquery);

	while ($record = $db->fetch_array($row)){		
		$yearLvl = $record['year_level'];
	}
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
	<title>Student Diagnostic | Assessment Setup</title>
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<!-- Data-Table style -->
	<link href="css/jquery.dataTables.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="css/style.css" rel="stylesheet">
	<script src="js/custom.modernizr.js" type="text/javascript" ></script>
</head>
<body>
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
								echo "<li class=\"active\"><a href=\"assessmentsetup.php\">Assessments</a></li>";
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

		<!-- Page Header starts here -->
		<div class="row pgtle-margin">
			<div class="col-md-8" >
				<div class="page-title"><h1>Assessments</h1></div> 
			</div>
		</div>
		<!-- Page Header ends here -->

		<div class="row">
			<div class="col-sm-12 col-md-12"><!-- Activity in progress container starts here -->
				<div class="widget-box">
					<div class="widget-title">
						<h2><strong>Exams in Progress</strong></h2>
					</div>
					<hr class="customHr">
					<div id="examProgressPanel" class="widget-container table-responsive">
						<table id="recent-exams" class="table table-hover">
							<thead>
								<tr>
									<td></td>
									<td>Student</td>
									<td>Exam</td>
									<td>Date</td>
									<td>Status</td>
									<td>Time</td>
									<td class="cell-sm">Action</td>
								</tr>
							</thead>
							<tbody id="recentAssessPanel">								
							</tbody>
						</table>
					</div>	
				</div>
			</div><!-- Activity in progress container End here -->
		</div>

		<div class="row">
			<div class="col-sm-12 col-md-12"><!-- Assessment starts here -->
				<div class="widget-box">
					<div class="widget-title">
						<h2><strong>General Assessment</strong></h2>
					</div>
					<hr class="customHr">
					<div id="customeWCont" class="widget-container">
						<p class="text-center">Welcome
							<?php 

							if ($sessionType == 'p') {

								$parentUsername = "SELECT fname FROM tblparents where id='$id'";
								$record = $db->query_first($parentUsername);
								echo $record['fname'].",";	

							}else{ 

								$studentUsername = "SELECT fname FROM tblstudents where id='$id'";
								$record = $db->query_first($studentUsername);
								echo $record['fname'].",";		
							}
							?>
							just click the assessment title to learn more.
						</p>
						<hr id="marTop">
						<div class="panel-group panel-heading accordion-toggle" id="accordion" data-toggle="collapse" data-parent="#accordion" href="#genassmntopetions">
							<div class="panel panel-default">
								<div class="panel-heading accordion-toggle assmntTitle" data-toggle="collapse" data-parent="#accordion" href="#genassmnt1">
									<h5 class="panel-title">
										<a>Learning Style</a>
									</h5>
								</div>
								<div id="genassmnt1" class="panel-collapse in">
									<div class="panel-body">
										<p>
											Learning style inventories are designed to help respondents determine which learning style they have. These inventories typically take the form of a questionnaire that focuses on how people prefer to learn. Respondents choose the answers that most closely resemble their own preferences.
										</p>
										<div class="widget-title">
											<h2 class="pull-right">Visualise Describe and Classify 3D Shapes</h2>
										</div>
										<div class="widget-container">
											<ul id="gen1dtl" class="nav nav-tabs">
												<li class="active"><a href="#gendetails1" data-toggle="tab">Details</a></li>
											</ul>
											<div id="gen1dtlContent" class="tab-content todetails">
												<div class="tab-pane fade active in" id="gendetails1">
													<div class="row">
														<div class="col-md-9">
															<h3>Reminders:</h3>
															<section>
																<p><i class="glyphicon glyphicon-info-sign"></i> You can take this Exam <span id="num-of-retries">7</span> times</p><hr>
																<p><i class="glyphicon glyphicon-time"></i> This is a timed exam. Once you start, you have <span id="exam-time">11</span> minutes to finish it. Questions not answered are marked wrong.</p><hr>
																<p><i class="glyphicon glyphicon-ok-circle"></i> The passing score for this exam is <span id="passing-score">70</span>%</p><hr>																
																<?php 		
																if ($sessionType == 'p') {
																	?>															
																	<form class="form-horizontal" role="form">
																		<div class="form-group">
																			<label class="col-md-2 control-label">Choose student:</label>
																			<div class="col-md-3">
																				<select class="form-control StdExaminer">																																															
																					<?php  				
																					$studentUsername = "SELECT * FROM tblstudents where parent_id='$id'";
																					$row = $db->query($studentUsername);

																					while ($record = $db->fetch_array($row)) {																						
																						echo "<option value='$record[id]&yrlvl=$record[year_level]'>$record[fname]</option>";
																					}
																					?>																
																				</select>
																			</div>																																									
																		</div>
																	</form>
																	<?php 
																}
																?>
																<button data-asstype="5" class="genAssmntCat start-btn btn btn-primary pull-right"><i class="glyphicon glyphicon-check"></i>Start</button><br><br>
															</section>
														</div>
														<div class="col-md-3">
															<aside>
																<div class="well">
																	<strong>Details:</strong>
																	<hr>
																	<p><i class="glyphicon glyphicon-book"></i> In our decimal number system, the value of a digit depends on its place, or position, in the number. Each place has a value of 10 times the place to its right. A number in standard form is separated into groups of three digits using commas. Each of these groups is called a period.</p>
																</div>
															</aside>
														</div>
													</div>
												</div>
											</div>										
										</div>
									</div>
								</div>
							</div>
							<!-- Second Accordion -->
							<div class="panel panel-default">
								<div class="panel-heading accordion-toggle" data-toggle="collapse" data-parent="#accordion">
									<!-- href="#genassmnt2" -->
									<h5 class="panel-title">
										<a>Burt Reading...<span class="comesoon">Coming Soon!</span></a>
									</h5>
								</div>
								<div id="genassmnt2" class="panel-collapse collapse">
									<div class="panel-body">
										<p>
											All standardized reading tests it is essential that there is no teaching to the test. None of the words should be taught in preparation for the test. Each child is tested individually on the Burt Reading Test.
										</p>
										<div class="widget-title">
											<h2 class="pull-right">Visualize Describe and Classify 3D Shapes</h2>
										</div>
										<div class="widget-container">
											<ul id="gen2dtl" class="nav nav-tabs">
												<li class="active"><a href="#gendetails2" data-toggle="tab">Details</a></li>
											</ul>
											<div id="gen2dtlContent" class="tab-content todetails">
												<div class="tab-pane fade active in" id="gendetails2">
													<div class="row">
														<div class="col-md-9">
															<h3>Reminders:</h3>
															<section>
																<p><i class="glyphicon glyphicon-info-sign"></i> You can take this Exam <span id="num-of-retries">7</span> times</p><hr>
																<p><i class="glyphicon glyphicon-time"></i> This is a timed exam. Once you start, you have <span id="exam-time">11</span> minutes to finish it. Questions not answered are marked wrong.</p><hr>
																<p><i class="glyphicon glyphicon-ok-circle"></i> The passing score for this exam is <span id="passing-score">70</span>%</p><hr>																
																<?php 		
																if ($sessionType == 'p') {
																	?>															
																	<form class="form-horizontal" role="form">
																		<div class="form-group">
																			<label class="col-md-2 control-label">Choose student:</label>
																			<div class="col-md-3">
																				<select class="form-control StdExaminer">																																															
																					<?php  				
																					$studentUsername = "SELECT * FROM tblstudents where parent_id='$id'";
																					$row = $db->query($studentUsername);

																					while ($record = $db->fetch_array($row)) {																						
																						echo "<option value='$record[id]&yrlvl=$record[year_level]'>$record[fname]</option>";
																					}
																					?>																
																				</select>
																			</div>																																									
																		</div>
																	</form>
																	<?php 
																}
																?>
																<button data-asstype="6" class="genAssmntCat start-btn btn btn-primary pull-right"><i class="glyphicon glyphicon-check"></i>Start</button><br><br>
															</section>
														</div>
														<div class="col-md-3">
															<aside>
																<div class="well">
																	<strong>Details:</strong>
																	<hr>
																	<p><i class="glyphicon glyphicon-book"></i> In our decimal number system, the value of a digit depends on its place, or position, in the number. Each place has a value of 10 times the place to its right. A number in standard form is separated into groups of three digits using commas. Each of these groups is called a period.</p>
																</div>
															</aside>
														</div>
													</div>
												</div>
											</div>										
										</div>
									</div>
								</div>
							</div>
							<!-- Third accordion -->
							<div class="panel panel-default">
								<div class="panel-heading accordion-toggle assmntTitle" data-toggle="collapse" data-parent="#accordion">
									<!-- href="#genassmnt3" -->
									<h5 class="panel-title">
										<a>Learning IQ...<span class="comesoon">Coming Soon!</span></a>
									</h5>
								</div>
								<div id="genassmnt3" class="panel-collapse collapse">
									<div class="panel-body">
										<p>
											Your IQ, which stands for Intelligence Quotient, is a scientific assessment of your intelligence derived from standardized tests that measure problem solving abilities, spatial imagery, memory, general knowledge, and other factors. While there are limits based on native intelligence levels, recent studies have shown that it's possible to increase your intelligence!
										</p>
										<div class="widget-title">
											<h2 class="pull-right">Visualize Describe and Classify 3D Shapes</h2>
										</div>
										<div class="widget-container">
											<ul id="gen3dtl" class="nav nav-tabs">
												<li class="active"><a href="#gendetails3" data-toggle="tab">Details</a></li>
											</ul>
											<div id="gen3dtlContent" class="tab-content todetails">
												<div class="tab-pane fade active in" id="gendetails3">
													<div class="row">
														<div class="col-md-9">
															<h3>Reminders:</h3>
															<section>
																<p><i class="glyphicon glyphicon-info-sign"></i> You can take this Exam <span id="num-of-retries">7</span> times</p><hr>
																<p><i class="glyphicon glyphicon-time"></i> This is a timed exam. Once you start, you have <span id="exam-time">11</span> minutes to finish it. Questions not answered are marked wrong.</p><hr>
																<p><i class="glyphicon glyphicon-ok-circle"></i> The passing score for this exam is <span id="passing-score">70</span>%</p><hr>																
																<?php 		
																if ($sessionType == 'p') {
																	?>															
																	<form class="form-horizontal" role="form">
																		<div class="form-group">
																			<label class="col-md-2 control-label">Choose student:</label>
																			<div class="col-md-3">
																				<select class="form-control StdExaminer">																																															
																					<?php  				
																					$studentUsername = "SELECT * FROM tblstudents where parent_id='$id'";
																					$row = $db->query($studentUsername);

																					while ($record = $db->fetch_array($row)) {																						
																						echo "<option value='$record[id]&yrlvl=$record[year_level]'>$record[fname]</option>";
																					}
																					?>																
																				</select>
																			</div>																																									
																		</div>
																	</form>
																	<?php 
																}
																?>
																<button data-asstype="7" class="genAssmntCat start-btn btn btn-primary pull-right"><i class="glyphicon glyphicon-check"></i>Start</button><br><br>
															</section>
														</div>
														<div class="col-md-3">
															<aside>
																<div class="well">
																	<strong>Details:</strong>
																	<hr>
																	<p><i class="glyphicon glyphicon-book"></i> In our decimal number system, the value of a digit depends on its place, or position, in the number. Each place has a value of 10 times the place to its right. A number in standard form is separated into groups of three digits using commas. Each of these groups is called a period.</p>
																</div>
															</aside>
														</div>
													</div>
												</div>
											</div>										
										</div>
									</div>
								</div>
							</div>
						</div>					
					</div>							
					<div class="widget-title">
						<hr class="customHr">
						<h2 id="customH2"><strong>Subject Specific Assessment</strong></h2>
					</div>
					<hr class="customHr">
					<div class="widget-container">
						<div class="panel-group panel-heading accordion-toggle" id="accordion2" data-toggle="collapse" data-parent="#accordion" href="#ssassmntoptions">
							<div class="panel panel-default">
								<div class="panel-heading accordion-toggle assmntTitle" data-toggle="collapse" data-parent="#accordion2" href="#ssassmnt1">
									<h5 class="panel-title">
										<a>Maths Diagnostics</a>
									</h5>
								</div>
								<div id="ssassmnt1" class="panel-collapse collapse">
									<div class="panel-body">
										<p> 
											Learning style inventories are designed to help respondents determine which learning style they have. These inventories typically take the form of a questionnaire that focuses on how people prefer to learn. Respondents choose the answers that most closely resemble their own preferences.
										</p>
										<div class="widget-title">
											<h2 class="pull-right">Visualise Describe and Classify 3D Shapes</h2>
										</div>
										<div class="widget-container">
											<ul id="subspecdtl1" class="nav nav-tabs">
												<li class="active"><a href="#subspecdetails1" data-toggle="tab">Details</a></li>
											</ul>
											<div id="subspecdtl1Content" class="tab-content todetails">
												<div class="tab-pane fade active in" id="subspecdetails1">
													<div class="row">
														<div class="col-md-9">
															<h3>Reminders:</h3>
															<section>
																<p><i class="glyphicon glyphicon-info-sign"></i> You can take this Exam <span id="num-of-retries">7</span> times</p><hr>
																<p><i class="glyphicon glyphicon-time"></i> This is a timed exam. Once you start, you have <span id="exam-time">11</span> minutes to finish it. Questions not answered are marked wrong.</p><hr>
																<p><i class="glyphicon glyphicon-ok-circle"></i> The passing score for this exam is <span id="passing-score">70</span>%</p><hr>																
																<?php 		
																if ($sessionType == 'p') {
																	?>															
																	<form class="form-horizontal" role="form">
																		<div class="form-group">
																			<label class="col-md-2 control-label">Choose student:</label>
																			<div class="col-md-3">
																				<select class="form-control StdExaminer">																																															
																					<?php  				
																					$studentUsername = "SELECT * FROM tblstudents where parent_id='$id'";
																					$row = $db->query($studentUsername);

																					while ($record = $db->fetch_array($row)) {																						
																						echo "<option value='$record[id]&yrlvl=$record[year_level]'>$record[fname]</option>";
																					}
																					?>																
																				</select>
																			</div>																																									
																		</div>
																	</form>
																	<?php 
																}
																?>
																<button data-asstype="1" class="start-btn btn btn-primary pull-right"><i class="glyphicon glyphicon-check"></i>Start</button><br><br>
															</section>
														</div>
														<div class="col-md-3">
															<aside>
																<div class="well">
																	<strong>Details:</strong>
																	<hr>
																	<p><i class="glyphicon glyphicon-book"></i> In our decimal number system, the value of a digit depends on its place, or position, in the number. Each place has a value of 10 times the place to its right. A number in standard form is separated into groups of three digits using commas. Each of these groups is called a period.</p>
																</div>
															</aside>
														</div>
													</div>
												</div>
											</div>										
										</div> 
									</div>
								</div>
							</div>
							<!-- Second Accordion -->
							<div class="panel panel-default">
								<div class="panel-heading accordion-toggle assmntTitle" data-toggle="collapse" data-parent="#accordion2" href="#ssassmnt2">
									<h5 class="panel-title">
										<a>Maths Extension</a>
									</h5>
								</div>
								<div id="ssassmnt2" class="panel-collapse collapse">
									<div class="panel-body">
										<p> 
											All standardised reading tests it is essential that there is no teaching to the test. None of the words should be taught in preparation for the test. Each child is tested individually on the Burt Reading Test.
										</p>
										<div class="widget-title">
											<h2 class="pull-right">Visualise Describe and Classify 3D Shapes</h2>
										</div>
										<div class="widget-container">
											<ul id="subspecdtl2" class="nav nav-tabs">
												<li class="active"><a href="#subspecdetails2" data-toggle="tab">Details</a></li>
											</ul>
											<div id="subspecdtl2Content" class="tab-content todetails">
												<div class="tab-pane fade active in" id="subspecdetails2">
													<div class="row">
														<div class="col-md-9">
															<h3>Reminders:</h3>
															<section>
																<p><i class="glyphicon glyphicon-info-sign"></i> You can take this Exam <span id="num-of-retries">7</span> times</p><hr>
																<p><i class="glyphicon glyphicon-time"></i> This is a timed exam. Once you start, you have <span id="exam-time">11</span> minutes to finish it. Questions not answered are marked wrong.</p><hr>
																<p><i class="glyphicon glyphicon-ok-circle"></i> The passing score for this exam is <span id="passing-score">70</span>%</p><hr>																
																<?php 		
																if ($sessionType == 'p') {
																	?>															
																	<form class="form-horizontal" role="form">
																		<div class="form-group">
																			<label class="col-md-2 control-label">Choose student:</label>
																			<div class="col-md-3">
																				<select class="form-control StdExaminer">																																															
																					<?php  				
																					$studentUsername = "SELECT * FROM tblstudents where parent_id='$id'";
																					$row = $db->query($studentUsername);

																					while ($record = $db->fetch_array($row)) {																						
																						echo "<option value='$record[id]&yrlvl=$record[year_level]'>$record[fname]</option>";
																					}
																					?>																
																				</select>
																			</div>																																									
																		</div>
																	</form>
																	<?php 
																}
																?>
																<button data-asstype="2"  class="start-btn btn btn-primary pull-right"><i class="glyphicon glyphicon-check"></i>Start</button><br><br>
															</section>
														</div>
														<div class="col-md-3">
															<aside>
																<div class="well">
																	<strong>Details:</strong>
																	<hr>
																	<p><i class="glyphicon glyphicon-book"></i> In our decimal number system, the value of a digit depends on its place, or position, in the number. Each place has a value of 10 times the place to its right. A number in standard form is separated into groups of three digits using commas. Each of these groups is called a period.</p>
																</div>
															</aside>
														</div>
													</div>
												</div>
											</div>										
										</div>
									</div>
								</div>
							</div>
							<!-- Third accordion -->
							<div class="panel panel-default">
								<div class="panel-heading accordion-toggle assmntTitle" data-toggle="collapse" data-parent="#accordion2" href="#ssassmnt3">
									<h5 class="panel-title">
										<a>English Diagnostic Test...<span class="comesoon">Coming Soon!</span></a>
									</h5>
								</div>
								<div id="ssassmnt3" class="panel-collapse collapse">
									<div class="panel-body">
										<p>
											Your IQ, which stands for Intelligence Quotient, is a scientific assessment of your intelligence derived from standardized tests that measure problem solving abilities, spatial imagery, memory, general knowledge, and other factors. While there are limits based on native intelligence levels, recent studies have shown that it's possible to increase your intelligence!
										</p>
										<div class="widget-title">
											<h2 class="pull-right">Visualise Describe and Classify 3D Shapes</h2>
										</div>
										<div class="widget-container">
											<ul id="subspecdtl3" class="nav nav-tabs">
												<li class="active"><a href="#subspecdetails3" data-toggle="tab">Details</a></li>
											</ul>
											<div id="subspecdtl3Content" class="tab-content todetails">
												<div class="tab-pane fade active in" id="subspecdetails3">
													<div class="row">
														<div class="col-md-9">
															<h3>Reminders:</h3>
															<section>
																<p><i class="glyphicon glyphicon-info-sign"></i> You can take this Exam <span id="num-of-retries">7</span> times</p><hr>
																<p><i class="glyphicon glyphicon-time"></i> This is a timed exam. Once you start, you have <span id="exam-time">11</span> minutes to finish it. Questions not answered are marked wrong.</p><hr>
																<p><i class="glyphicon glyphicon-ok-circle"></i> The passing score for this exam is <span id="passing-score">70</span>%</p><hr>																
																<?php 		
																if ($sessionType == 'p') {
																	?>															
																	<form class="form-horizontal" role="form">
																		<div class="form-group">
																			<label class="col-md-2 control-label">Choose student:</label>
																			<div class="col-md-3">
																				<select class="form-control StdExaminer">																																															
																					<?php  				
																					$studentUsername = "SELECT * FROM tblstudents where parent_id='$id'";
																					$row = $db->query($studentUsername);

																					while ($record = $db->fetch_array($row)) {																						
																						echo "<option value='$record[id]&yrlvl=$record[year_level]'>$record[fname]</option>";
																					}
																					?>																
																				</select>
																			</div>																																									
																		</div>
																	</form>
																	<?php 
																}
																?>
																<button data-asstype="3"  class="start-btn btn btn-primary pull-right"><i class="glyphicon glyphicon-check"></i>Start</button><br><br>
															</section>
														</div>
														<div class="col-md-3">
															<aside>
																<div class="well">
																	<strong>Details:</strong>
																	<hr>
																	<p><i class="glyphicon glyphicon-book"></i> In our decimal number system, the value of a digit depends on its place, or position, in the number. Each place has a value of 10 times the place to its right. A number in standard form is separated into groups of three digits using commas. Each of these groups is called a period.</p>
																</div>
															</aside>
														</div>
													</div>
												</div>
											</div>										
										</div> 
									</div>
								</div>
							</div>
							<!-- Forth Accordion -->
							<div class="panel panel-default">
								<div class="panel-heading accordion-toggle assmntTitle" data-toggle="collapse" data-parent="#accordion2">
									 <!-- href="#ssassmnt4" -->
									<h5 class="panel-title">
										<a>English Extension...<span class="comesoon">Coming Soon!</span></a>
									</h5>
								</div>
								<div id="ssassmnt4" class="panel-collapse collapse">
									<div class="panel-body">
										<p>
											Fusce imperdiet, risus eget viverra faucibus, diam mi vestibulum libero, ut vestibulum tellus magna nec enim. Nunc dapibus varius interdum. Phasellus at lorem ut lectus fermentum convallis. Sed diam nisi, pulvinar vitae molestie hendrerit, venenatis eget mauris. Integer porta erat ac eros porta ultrices. Proin porttitor eros a ante molestie gravida commodo dui adipiscing. <a href="#">Morbi dictum nibh gravida</a> mi pretium dapibus. Nullam in est urna. In vitae adipiscing enim. 
										</p>
										<div class="widget-title">
											<h2 class="pull-right">Visualise Describe and Classify 3D Shapes</h2>
										</div>
										<div class="widget-container">
											<ul id="subspecdtl4" class="nav nav-tabs">
												<li class="active"><a href="#subspecdetails4" data-toggle="tab">Details</a></li>
											</ul>
											<div id="subspecdtl4Content" class="tab-content todetails">
												<div class="tab-pane fade active in" id="subspecdetails4">
													<div class="row">
														<div class="col-md-9">
															<h3>Reminders:</h3>
															<section>
																<p><i class="glyphicon glyphicon-info-sign"></i> You can take this Exam <span id="num-of-retries">7</span> times</p><hr>
																<p><i class="glyphicon glyphicon-time"></i> This is a timed exam. Once you start, you have <span id="exam-time">11</span> minutes to finish it. Questions not answered are marked wrong.</p><hr>
																<p><i class="glyphicon glyphicon-ok-circle"></i> The passing score for this exam is <span id="passing-score">70</span>%</p><hr>																
																<?php 		
																if ($sessionType == 'p') {
																	?>															
																	<form class="form-horizontal" role="form">
																		<div class="form-group">
																			<label class="col-md-2 control-label">Choose student:</label>
																			<div class="col-md-3">
																				<select class="form-control StdExaminer">																																															
																					<?php  				
																					$studentUsername = "SELECT * FROM tblstudents where parent_id='$id'";
																					$row = $db->query($studentUsername);

																					while ($record = $db->fetch_array($row)) {																						
																						echo "<option value='$record[id]&yrlvl=$record[year_level]'>$record[fname]</option>";
																					}
																					?>																
																				</select>
																			</div>																																									
																		</div>
																	</form>
																	<?php 
																}
																?>
																<button data-asstype="4"  class="start-btn btn btn-primary pull-right"><i class="glyphicon glyphicon-check"></i>Start</button><br><br>
															</section>
														</div>
														<div class="col-md-3">
															<aside>
																<div class="well">
																	<strong>Details:</strong>
																	<hr>
																	<p><i class="glyphicon glyphicon-book"></i> In our decimal number system, the value of a digit depends on its place, or position, in the number. Each place has a value of 10 times the place to its right. A number in standard form is separated into groups of three digits using commas. Each of these groups is called a period.</p>
																</div>
															</aside>
														</div>
													</div>
												</div>
											</div>										
										</div>
									</div>
								</div>
							</div>
							<!-- Fith Accordion -->
							<div class="panel panel-default">
								<div class="panel-heading accordion-toggle assmntTitle" data-toggle="collapse" data-parent="#accordion2">
									 <!-- href="#ssassmnt5" -->
									<h5 class="panel-title">
										<a>Science...<span class="comesoon">Coming Soon!</span></a>
									</h5>
								</div>
								<div id="ssassmnt5" class="panel-collapse collapse">
									<div class="panel-body">
										<p>
											Fusce imperdiet, risus eget viverra faucibus, diam mi vestibulum libero, ut vestibulum tellus magna nec enim. Nunc dapibus varius interdum. Phasellus at lorem ut lectus fermentum convallis. Sed diam nisi, pulvinar vitae molestie hendrerit, venenatis eget mauris. Integer porta erat ac eros porta ultrices. Proin porttitor eros a ante molestie gravida commodo dui adipiscing. <a href="#">Morbi dictum nibh gravida</a> mi pretium dapibus. Nullam in est urna. In vitae adipiscing enim. 
										</p>
										<div class="widget-title">
											<h2 class="pull-right">Visualise Describe and Classify 3D Shapes</h2>
										</div>
										<div class="widget-container">
											<ul id="subspecdtl5" class="nav nav-tabs">
												<li class="active"><a href="#subspecdetails5" data-toggle="tab">Details</a></li>
											</ul>
											<div id="subspecdtl5Content" class="tab-content todetails">
												<div class="tab-pane fade active in" id="subspecdetails5">
													<div class="row">
														<div class="col-md-9">
															<h3>Reminders:</h3>
															<section>
																<p><i class="glyphicon glyphicon-info-sign"></i> You can take this Exam <span id="num-of-retries">7</span> times</p><hr>
																<p><i class="glyphicon glyphicon-time"></i> This is a timed exam. Once you start, you have <span id="exam-time">11</span> minutes to finish it. Questions not answered are marked wrong.</p><hr>
																<p><i class="glyphicon glyphicon-ok-circle"></i> The passing score for this exam is <span id="passing-score">70</span>%</p><hr>																
																<?php 		
																if ($sessionType == 'p') {
																	?>															
																	<form class="form-horizontal" role="form">
																		<div class="form-group">
																			<label class="col-md-2 control-label">Choose student:</label>
																			<div class="col-md-3">
																				<select class="form-control StdExaminer">																																															
																					<?php  				
																					$studentUsername = "SELECT * FROM tblstudents where parent_id='$id'";
																					$row = $db->query($studentUsername);

																					while ($record = $db->fetch_array($row)) {																						
																						echo "<option value='$record[id]&yrlvl=$record[year_level]'>$record[fname]</option>";
																					}
																					?>																
																				</select>
																			</div>																																									
																		</div>
																	</form>
																	<?php 
																}
																?>
																<button data-asstype="5"  class="start-btn btn btn-primary pull-right"><i class="glyphicon glyphicon-check"></i>Start</button><br><br>
															</section>
														</div>
														<div class="col-md-3">
															<aside>
																<div class="well">
																	<strong>Details:</strong>
																	<hr>
																	<p><i class="glyphicon glyphicon-book"></i> In our decimal number system, the value of a digit depends on its place, or position, in the number. Each place has a value of 10 times the place to its right. A number in standard form is separated into groups of three digits using commas. Each of these groups is called a period.</p>
																</div>
															</aside>
														</div>
													</div>
												</div>
											</div>										
										</div> 
									</div>
								</div>
							</div>
						</div>							
					</div>
				</div>
			</div>
		</div> <!-- assessments ends here -->
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
	<!-- Data table plugins -->
	<script src="js/jquery.dataTables.min.js"></script>
	<!-- Init plugins and custom <javascript-->
	<script src="js/custom.js"></script>
	<script type="text/javascript">
	$( document ).ready(function() { 
		
		var myid = "<?PHP echo $id; ?>";
		
		//Button when user click the Start Assessment
		$(".start-btn").click(function () {

			var assessment_typeid = $(this).attr("data-asstype");
			if (<?php echo "$loggedUser"; ?> == "1") {//for parent
				
				var assmentTitle = $(this).parent().closest(".panel").find(".panel-title a").text(), //assessment title
					examiner = $(this).closest(".panel").find(".StdExaminer option:selected").val(), //student id
					examCat = "";		

				if ($(this).hasClass("genAssmntCat")) {//determine which category 
						examCat = "General Assessment";
				}else{
						examCat = "Subject Specific Assessment";
				};

				console.log(assmentTitle+" , "+examiner+" , "+examCat);
	
					$.post( "_hasExam.php", { assessment_typeid: assessment_typeid, examiner: examiner })
					.done(function( data ) {
						if(data == "notexist")
							window.location = "testpage.php?type="+assessment_typeid+"&id="+examiner+"&exmtle="+assmentTitle;
						else{
							var txt;
							var r = confirm("Please complete your current exam in progress before starting a new one");
						}
					});

			}else{

				var assmentTitleStd = $(this).parent().closest(".panel").find(".panel-title a").text();	

				window.location = "testpage.php?type='"+assessment_typeid+"'&id=<?php echo"$id"; ?>&yrlvl=<?php echo"$yearLvl"; ?>&exmtle="+assmentTitleStd;

			}

		})
		//Function to show Recent Assessment
		showRecentResult = function(element){
//			$("#recentAssessPanel").html();
				var assmentTitleStd = element.subject+' '+element.type;
				var studentName = element.firstname;
			
					$("#recentAssessPanel").append('<tr>'+
									'		<td><i class="glyphicon glyphicon-refresh"></i></td>'+
									'		<td>'+studentName+'</td>'+
									'		<td>'+assmentTitleStd+'</td>'+
									'		<td>'+element.start_date+'</td>'+
									'		<td>In Progress('+element.Unaswered+'%)</td>'+
									'		<td>'+element.time_to_answer+'</td>'+
									'		<td>'+
									'			<a href="testpage.php?type='+element.assessment_type_id+'&id='+element.student_id+'&yrlvl=<?php echo"$yearLvl"; ?>&exmtle='+assmentTitleStd+'" ><button class="btn btn-sm btn-default"><i class="glyphicon glyphicon-arrow-right"></i>Continue</button></a>'+
									'		</td>'+
									'	</tr>')
							
		}
		//Fetch Recent Assessment
		fetchRecentAssesment = function(){
				$("#recentAssessPanel").html("");
			$.ajax({ 
			    type: 'POST', 
			    url: '_fetchRecentAssessment.php', 
			    data: { action: "getNewAssessement", parentId: <?php echo"$id"; ?>}, 
			    dataType: 'json',
			    success: function (data) { 
			        $.each(data, function(index, element) {
				        showRecentResult(element);
			        });
			       
				    if(data == ""){
					  //   alert("no current exams in progress");
					    $("#examProgressPanel").html("<h2>No current exams in progress</h2>")
				    }

			    }
			});
		}
		
		fetchRecentAssesment();
		
		
		fetchScore = function(assTypeId){
			
			alert($(this).attr("href"))
		}
		

	});
	</script>
</body>
</html>