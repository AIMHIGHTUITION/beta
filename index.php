<?php 

	session_start();

	if($_SESSION['id'] == "" || $_SESSION['type'] == ""){
		header("Location: login.php");
	}
	$id = $_SESSION['id']; //login user ID
	$sessionType = $_SESSION['type']; 

?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="description" content="Student Diagnostic"/>
	<meta name="keywords" content="Online Assessment, Test Prep, Tutors, Review Center" />
	<meta name="author" content="Aim High Tuition"/>
	<link rel="shortcut icon" href="favicon.png">
	<title>Student Diagnostic | Dashboard</title>
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.css" rel="stylesheet">
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
							<li class="active"><a href="index.php">Dashboard</a></li>
							<?php  
								if ($sessionType == 't') {
									echo "<li><a href=\"student_pl.php\">Student Program</a></li>";		
									echo "<li><a href=\"tutor_resources.php\">Resources</a></li>";						
								}else{
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

		<!-- Page Header starts here -->
		<div class="row pgtle-margin">
			<div class="col-md-8" >
				<div class="page-title"><h1>Dashboard</h1></div> 
			</div>
		</div>
		<!-- Page Header ends here -->
		
		<!-- user alert -->
		<div id="alert-dist" class="alert alert-info alert-dismissable">
			<a href="#" class="alert-link">Info! Welcome to Student Diagnostic.</a>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		</div>
		<!-- user alert -->

		<div class="row"> <!-- row starts here -->
			<div class="col-sm-12 col-md-8"><!-- main container starts here -->
				<div class="widget-box">
					<div class="widget-title">
						<h2><i class="glyphicon glyphicon-stats"></i>Recent Activity Progress</h2>
					</div>
					<div class="widget-container">
						<div class="chart-container">
							<div class="stack-chart chart-placeholder"></div>
						</div>
						<div class="alert alert-info">
							<a href="#" class="alert-link">Some Reminder goes here.................</a>
						</div>
						<h4><i class="glyphicon glyphicon-bell"></i>Recent Activities</h4>
						<ul class="feeds">
							<li>
								<i class="glyphicon glyphicon-check"></i>
								You have 4 pending tasks.
								<span class="label label-warning">
									Take action<i class="glyphicon glyphicon-share-alt"></i>
								</span>
								<div class="pull-right">
									Just now
								</div>
							</li>
							<li>
								<i class="glyphicon glyphicon-list-alt"></i>
								Finance Report for year 2013 has been released.
								<div class="pull-right">
									20 mins
								</div>
							</li>
							<li>
								<i class="glyphicon glyphicon-user"></i>
								You have 5 pending membership that requires a quick review.
								<div class="pull-right">
									24 mins
								</div>
							</li>
							<li>
								<i class="glyphicon glyphicon-check"></i>
								New order received with
								<span class="label label-success">Reference Number: DR23923</span>
								<div class="pull-right">
									30 mins
								</div>
							</li>
							<li>
								<i class="glyphicon glyphicon-user"></i>
								You have 5 pending membership that requires a quick review.
								<div class="pull-right">
									24 mins
								</div>
							</li>
							<li>
								<i class="glyphicon glyphicon-check"></i>
								Web server hardware needs to be upgraded.
								<span class="label label-default">Overdue</span>
								<div class="pull-right">
									2 hours
								</div>
							</li>
							<li>
								<i class="glyphicon glyphicon-user"></i>
								IPO Report for year 2013 has been released.
								<div class="pull-right">
									20 mins
								</div>
							</li>						
						</ul>
						<hr>
					</div>
				</div>
			</div><!-- main container End here -->
			
			<div class="col-sm-12 col-md-4 pull-right" id="sidebar"><!-- sidebar container starts here -->
				<div class="widget-box">
					<div class="widget-title">
						<h2><i class="glyphicon glyphicon-align-left"></i>Quick Links</h2>
					</div>
					<div class="widget-container">
						<ul class="feeds">
							<a href="#"><li><i class="glyphicon glyphicon-question-sign"></i>Tutoring enquiry</li></a>
							<a href="#"><li><i class="glyphicon glyphicon-bold"></i>Blog</li></a>
							<a href="#"><li><i class="glyphicon glyphicon-home"></i>Aim High Tuition</li></a>
							<a href="#"><li><i class="glyphicon glyphicon-user"></i>Students</li></a>
							<a href="#"><li><i class="glyphicon glyphicon-envelope"></i>Contact Us</li></a>
						</ul>
					</div>
				</div>
				<div class="widget-box">
					<div class="widget-title">
						<h2><i class="glyphicon glyphicon-star"></i>Featured Learning Contents</h2>
					</div>
					<div class="widget-container">
						<ul class="feeds">
							<li class="text-center"><i id="featured-size" class="glyphicon glyphicon-film"></i></li>
						</ul>
						<hr>
						<p class="text-center"><strong>The Power Of Reading</strong></p>
					</div>
				</div>

				<div class="widget-box">
					<div class="widget-title">
						<h2><i class="glyphicon glyphicon-pushpin"></i>Recent Post</h2>
					</div>
					<div class="widget-container">
						<ul class="feeds">
							<li>
								<a href="#">Controlling School Clutter</a> <i>-- 04 Sept 2015</i>
							</li>
							<li>
								<a href="#">5 Steps to Easier Afternoons</a> <i>-- 03 Sept 2015</i>
							</li>
							<li>
								<a href="#">Handling Afternoon Snacking</a> <i>-- 01 Sept 2015</i>
							</li>
							<li>
								<a href="#">Are You Keeping Your Child Safe?</a> <i>-- 31 Aug 2015</i>
							</li>
							<li>
								<a href="#">Building Your Child’s Confidence</a> <i>-- 30 Aug 2015</i>
							</li>
							<li>
								<a href="#">How sick is too sick for school?</a> <i>-- 30 Aug 2015</i>
							</li>
						</ul>
					</div>
				</div>
			</div><!-- sidebar container End here -->
		</div><!-- row ends here -->
		<footer class="footer">
			<p>Copyright © 2015<a href="#">• Student Diagnostics | Aim High Tuition</a> • All Rights Reserved</p>
		</footer>
	</div><!-- Main container ends here -->

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
	<!-- Data table plugins -->
	<script src="js/jquery.dataTables.min.js"></script>
	<!-- Charts plugins -->
	<script type="text/javascript" src="js/chart/jquery.flot.min.js"></script>
	<script type="text/javascript" src="js/chart/jquery.flot.stack.min.js"></script>
	<script type="text/javascript" src="js/chart/jquery.flot.resize.min.js"></script>
	<!-- Init plugins and custom javascript-->
	<script src="js/custom.js"></script>
</body>
</html>