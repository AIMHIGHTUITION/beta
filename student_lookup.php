<?php 
	session_start();

	if($_SESSION['id'] == "" || $_SESSION['type'] == ""){
		header("Location: login.php");
		exit();
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

	<title>Student Diagnostic | Lookup</title>
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="css/style.css" rel="stylesheet">
	<link href="css/animate.css" rel="stylesheet">

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
								if ($_SESSION['type'] == 't') {
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
							if ($_SESSION['type'] == 't') {
								echo "<li><a href=\"student_lookup.php\"><i class=\"glyphicon glyphicon-search\"></i>Student Lookup</a></li>";
							}elseif ($_SESSION['type'] == 'p') {
								echo "<li><a href=\"tutor_lookup.php\"><i class=\"glyphicon glyphicon-search\"></i>Tutor Lookup</a></li>";
							}
							?>
							<li><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i>Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>

		<div class="row pgtle-margin"><!-- Page Header starts here -->
			<div class="col-md-8" >
				<div class="page-title"><h1>Student Lookup</h1></div>
			</div>
		</div><!-- Page Header ends here -->

		<div class="row">
			<div class="col-sm-12 col-md-3">
				<div class="widget-box">
					<div class="widget-title">
						<h2>Search Filters</h2>
					</div>
					<div class="widget-container vital-stats">
						<div class="clearfix">
							<form id="search" class="input-append">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="keyword">
									<span class="input-group-btn"><button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button></span>
								</div>
							</form>
						</div>
						<br>
						<div class="form-group">
							<label class="control-label">Choose Year Level:</label>
							<div>
								<div class="col-md-6">
									<div class="checkbox">
										<label><input type="checkbox" class="form-control" value="">1</label>
									</div>
									<div class="checkbox">
										<label><input type="checkbox" class="form-control" value="">2</label>
									</div>
									<div class="checkbox">
										<label><input type="checkbox" class="form-control" value="">3</label>
									</div>
									<div class="checkbox">
										<label><input type="checkbox" class="form-control" value="">4</label>
									</div>
									<div class="checkbox">
										<label><input type="checkbox" class="form-control" value="">5</label>
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkbox">
										<label><input type="checkbox" class="form-control" value="">6</label>
									</div>
									<div class="checkbox">
										<label><input type="checkbox" class="form-control" value="">7</label>
									</div>
									<div class="checkbox">
										<label><input type="checkbox" class="form-control" value="">8</label>
									</div>
									<div class="checkbox">
										<label><input type="checkbox" class="form-control" value="">9</label>
									</div>
									<div class="checkbox">
										<label><input type="checkbox" class="form-control" value="">10</label>
									</div>
								</div>	
							</div>
						</div>
						<label id="sub-cat">Subjects:</label>
						<ul id="sc-list">
							<li><a href="#">English</a> <i>(211)</i></li>
							<li><a href="#">Math</a> <i>(107)</i></li>
							<li><a href="#">Science</a> <i>(49)</i></li>
						</ul>
					</div>	
				</div>
			</div>

			<div class="col-sm-12 col-md-9"> <!-- students -->
				<div class="widget-box">
					<div class="widget-title">
						<h2 class="logo">Students</h2>
					</div>
					<div class="widget-container">
						<div class="row">
							<ul class="thumbnails list-unstyled">
								<li class="col-sm-6 col-md-3">
									<div class="team-thumbnail">
										<div class="team-thumbnail-img"><img src="img/profile-01.jpg" alt=""></div>
										<div class="caption">
											<h4>Name here</h4>
											<p>Short description for this team member goes here.</p>
										</div>
									</div>
								</li> 
								<li class="col-sm-6 col-md-3">
									<div class="team-thumbnail">
										<div class="team-thumbnail-img"><img src="img/profile-02.jpg" alt=""></div>
										<div class="caption">
											<h4>Name here</h4>
											<p>Short description for this team member goes here.</p>
										</div>
									</div>
								</li> 
								<li class="col-sm-6 col-md-3">
									<div class="team-thumbnail">
										<div class="team-thumbnail-img"><img src="img/profile-02.jpg" alt=""></div>
										<div class="caption">
											<h4>Name here</h4>
											<p>Short description for this team member goes here.</p>
										</div>
									</div>
								</li> 
								<li class="col-sm-6 col-md-3">
									<div class="team-thumbnail">
										<div class="team-thumbnail-img"><img src="img/profile-01.jpg" alt=""></div>
										<div class="caption">
											<h4>Name here</h4>
											<p>Short description for this team member goes here.</p>
										</div>
									</div>
								</li> 
								<li class="col-sm-6 col-md-3">
									<div class="team-thumbnail">
										<div class="team-thumbnail-img"><img src="img/profile-01.jpg" alt=""></div>
										<div class="caption">
											<h4>Name here</h4>
											<p>Short description for this team member goes here.</p>
										</div>
									</div>
								</li> 
								<li class="col-sm-6 col-md-3">
									<div class="team-thumbnail">
										<div class="team-thumbnail-img"><img src="img/profile-01.jpg" alt=""></div>
										<div class="caption">
											<h4>Name here</h4>
											<p>Short description for this team member goes here.</p>
										</div>
									</div>
								</li> 
								<li class="col-sm-6 col-md-3">
									<div class="team-thumbnail">
										<div class="team-thumbnail-img"><img src="img/profile-01.jpg" alt=""></div>
										<div class="caption">
											<h4>Name here</h4>
											<p>Short description for this team member goes here.</p>
										</div>
									</div>
								</li> 
								<li class="col-sm-6 col-md-3">
									<div class="team-thumbnail">
										<div class="team-thumbnail-img"><img src="img/profile-01.jpg" alt=""></div>
										<div class="caption">
											<h4>Name here</h4>
											<p>Short description for this team member goes here.</p>
										</div>
									</div>
								</li> 
							</ul>
						</div>
					</div>
				</div>
			</div> <!-- students -->			
		</div>
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

	<!-- Init plugins and custom javascript-->
	<script src="js/custom.js"></script>
</body>
</html>