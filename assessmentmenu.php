<!DOCTYPE html>
<?php 
	session_start();

	if ($_SESSION['log']!=true) {
		header("Location:login.html");
		exit();
	}
?>
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
							<li><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> Log-out</a></li>
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
											<h2>Assessment Choices</h2>
										</div>
										<div class="widget-container table-responsive">
											<table id="list-of-exams" class="table table-hover">
												<thead>
													<tr>
														<td></td>
														<td>Exam</td>
														<td>Date</td>
														<td>Status</td>
														<td>Time</td>
														<td class="cell-sm">Action</td>
													</tr>
												</thead>

												<tbody>
													<tr>
														<td><i class="glyphicon glyphicon-certificate"></i></td>
														<td><a href="#">Number and Place Value</a></td>
														<td>08/09/15</td>
														<td>0%</td>
														<td>---</td>
														<td>
															<button class="btn btn-sm btn-default"><i class="glyphicon glyphicon-play"></i>Start</button>
														</td>
													</tr>
													<tr>
														<td><i class="glyphicon glyphicon-ok"></i></td>
														<td><a href="#">Fraction and Decimals</a></td>
														<td>07/09/15</td>
														<td>Finished</td>
														<td>1:30</td>
														<td>
															<button class="btn btn-sm btn-default"><i class="glyphicon glyphicon-eye-open"></i>Review</button>
														</td>
													</tr>

													<tr>
														<td><i class="glyphicon glyphicon-refresh"></i></td>
														<td><a href="#">Data representation and interpretation</a></td>
														<td>06/09/15</td>
														<td>Pending 40%</td>
														<td>0:27</td>
														<td>
															<button class="btn btn-sm btn-default"><i class="glyphicon glyphicon-arrow-right"></i>Continue</button>
														</td>
													</tr>

													<tr>
														<td><i class="glyphicon glyphicon-ok"></i></td>
														<td><a href="#">Chance</a></td>
														<td>05/09/15</td>
														<td>Finished</td>
														<td>1:00</td>
														<td>
															<button class="btn btn-sm btn-default"><i class="glyphicon glyphicon-eye-open"></i>Review</button>
														</td>
													</tr>
												</tbody>
											</table>						
										</div>
									</div>
								</div><!-- Simple Table ends here -->								
							</div>			
						</fieldset>
					</form>
				</div>																									
			</div><!-- lock screen container End here -->	
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
