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

	<script src="js/custom.modernizr.js" type="text/javascript" ></script>
</head>
<body>
	<div class="container"><!-- Main Container starts here -->
		<div class="row navbar-fixed-top" id="top-navigation">
			<header class=" col-sm-12 col-md-12"><!-- Navigation header starts here -->
				<div class="navbar navbar-default">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="index.php"><i class="glyphicon glyphicon-signal"></i>Student Diagnostics</a>
					</div>
					<div id="assmntmenunav" class="navbar-collapse collapse">
						<ul class="nav navbar-nav navbar-right">
							<li><a href="assessmentlock.php"><i class="glyphicon glyphicon-log-out"></i> Log-out</a></li>
						</ul>						
					</div><!--/.nav-collapse -->
				</div>
			</header><!-- Navigation header ends here -->
		</div>
		<br />
		<br />
		<br />
		<div class="row">
			<div class="col-sm-12 col-md-9 col-md-offset-9 sign-in animated flipInY">
				<div id="signup" class="lock-screen" >
					<div id="assmnttitle" class="title icon-space"><i class="glyphicon glyphicon-folder-open"></i> Aim High Tuition</div>
					<form action="/signin" method="post" class="form-stacked">
						<fieldset id="customfset">
							<div id="assmntcontent">
								<div class="col-sm-12 col-md-12">
									<div class="widget-box">
										<div class="widget-title">
											<h2 class="pull-right">Test Choice Name</h2>
										</div>
										<div class="widget-container">
											<ul id="myTab" class="nav nav-tabs">
												<li class="active"><a href="#details" data-toggle="tab">Details</a></li>
												<li><a href="#score" data-toggle="tab">Score</a></li>
											</ul>
											<div id="myTabContent" class="tab-content todetails">
												<div class="tab-pane fade active in" id="details">
													<div class="row">
														<div class="col-md-9">
															<div>
																<h3>Reminders:</h3>
																<section>
																	<p><i class="glyphicon glyphicon-info-sign"></i> You can take this Exam <span id="num-of-retries">7</span> times</p><hr>
																	<p><i class="glyphicon glyphicon-time"></i> This is a timed exam. Once you start, you have <span id="exam-time">11</span> minutes to finish it. Questions not answered are marked wrong.</p><hr>
																	<p><i class="glyphicon glyphicon-ok-circle"></i> The passing score for this exam is <span id="passing-score">70</span>%</p><hr>
																	<p>
																		<button class="btn btn-primary"><a href="assessmentmenu.php"><i class="glyphicon glyphicon-home"></i>Cancel</a></button>				
																		<button class="btn btn-success pull-right"><a href="testpage.php"><i class="glyphicon glyphicon-play"></i>Start</a></button>
																	</p>			
																</section>
															</div>
														</div>
														<div class="col-md-3">
															<aside>
																<div class="well">
																	<strong>Number and Place Value</strong>
																	<hr>
																	<p><i class="glyphicon glyphicon-book"></i> In our decimal number system, the value of a digit depends on its place, or position, in the number. Each place has a value of 10 times the place to its right. A number in standard form is separated into groups of three digits using commas. Each of these groups is called a period.</p>
																</div>
															</aside>
														</div>
													</div>
												</div>
												<div class="tab-pane fade" id="score">
													<div class="table-responsive">
														<table id="score-overview" class="table table-hover">
															<thead>
																<tr>
																	<td>Take</td>
																	<td>Score</td>
																	<td>Date Finished</td>
																	<td>Time</td>
																	<td>Time Spent</td>
																	<td class="cell-sm">Action</td>
																</tr>
															</thead>

															<tbody>
																<tr>
																	<td>1</td>
																	<td>70</td>
																	<td>08/09/15</td>
																	<td>1:00 pm</td>
																	<td>40 min</td>
																	<td>
																		<button class="btn btn-sm btn-default"><i class="glyphicon glyphicon-eye-open"></i>Review</button>
																	</td>
																</tr>
																<tr>
																	<td>2</td>
																	<td>89</td>
																	<td>07/09/15</td>
																	<td>11:00 am</td>
																	<td>30 min</td>
																	<td>
																		<button class="btn btn-sm btn-default"><i class="glyphicon glyphicon-eye-open"></i>Review</button>
																	</td>
																</tr>

																<tr>
																	<td>3</td>
																	<td>90</td>
																	<td>06/09/15</td>
																	<td>10:00 am</td>
																	<td>50 min</td>
																	<td>
																		<button class="btn btn-sm btn-default"><i class="glyphicon glyphicon-eye-open"></i>Review</button>
																	</td>
																</tr>

																<tr>
																	<td>4</td>
																	<td>100</td>
																	<td>05/09/15</td>
																	<td>11:30 am</td>
																	<td>1:00 hr</td>
																	<td>
																		<button class="btn btn-sm btn-default"><i class="glyphicon glyphicon-eye-open"></i>Review</button>
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
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
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>
	window.jQuery || document.write('<script src="js/jquery.js"><\/script>')
	</script>
	<script src="js/bootstrap.min.js"></script>
	<!-- Important js for all pages end  -->

	<!-- Fix plugins -->
	<script type="text/javascript" src="js/ios-orientationchange-fix.js"></script>
	
	<!-- Init plugins and custom javascript-->
	<script src="js/custom.js"></script>
</body>
</html>