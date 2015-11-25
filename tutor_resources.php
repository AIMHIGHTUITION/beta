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

	<title>Student Diagnostic | Resources</title>
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
								if ($_SESSION['type'] == 't') {
									echo "<li><a href=\"student_pl.php\">Student Program</a></li>";		
									echo "<li class=\"active\"><a href=\"tutor_resources.php\">Resources</a></li>";						
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

		<!-- Page Header starts here -->
		<div class="row pgtle-margin">
			<div class="col-md-8" >
				<div class="page-title"><h1>Tutor Resources</h1></div> 
			</div>
		</div>
		<!-- Page Header ends here -->

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
						<label id="learning-cat">Learning Categories:</label>
						<ul id="lc-list">
							<li><a href="#">Number and Algebra</a> <i>(211)</i></li>
							<li><a href="#">Measurements and Geometry</a> <i>(107)</i></li>
							<li><a href="#">Statistics and Probability</a> <i>(49)</i></li>
						</ul>
					</div>	
				</div>
			</div>

			<div class="col-sm-12 col-md-9"> 
				<div class="widget-box">
					<div class="widget-title">
						<h2><i class="glyphicon glyphicon-book"></i>Library</h2>
					</div>
					<div class="widget-container">
						<div class="widget-container table-responsive">
							<table class="table table-hover table-striped order-table table-red">
								<thead>
									<tr>
										<th>Year</th>
										<th>Learning Category</th>
										<th>Name</th>										
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>Number and Algebra</td>
										<td>Begin to read the time to the hour on a clock</td>
										<td>
											<button type="button" class="btn btn-xs btn-info btn-icon"><i class="glyphicon glyphicon-eye-open"></i></button>
											<button type="button" class="btn btn-xs btn-success btn-icon"><i class="glyphicon glyphicon-print"></i></button>
											<button type="button" class="btn btn-xs btn-primary btn-icon"><i class="glyphicon glyphicon-save"></i></button>
											<button type="button" class="btn btn-xs btn-darkgreen btn-icon"><i class="glyphicon glyphicon-link"></i></button>
											<button type="button" class="btn btn-xs btn-danger btn-icon"><i class="glyphicon glyphicon-remove"></i></button>

										</td>
									</tr>
									<tr>
										<td>2</td>
										<td>Number and Algebra</td>
										<td>Subtracting tens and units ( no decompositions)</td>
										<td>
											<button type="button" class="btn btn-xs btn-info btn-icon"><i class="glyphicon glyphicon-eye-open"></i></button>
											<button type="button" class="btn btn-xs btn-success btn-icon"><i class="glyphicon glyphicon-print"></i></button>
											<button type="button" class="btn btn-xs btn-primary btn-icon"><i class="glyphicon glyphicon-save"></i></button>
											<button type="button" class="btn btn-xs btn-darkgreen btn-icon"><i class="glyphicon glyphicon-link"></i></button>
											<button type="button" class="btn btn-xs btn-danger btn-icon"><i class="glyphicon glyphicon-remove"></i></button>

										</td>
									</tr>
									<tr>
										<td>3</td>
										<td>Measurements and Geometry</td>
										<td>Mental addition and subtraction of decimal Fraction</td>
										<td>
											<button type="button" class="btn btn-xs btn-info btn-icon"><i class="glyphicon glyphicon-eye-open"></i></button>
											<button type="button" class="btn btn-xs btn-success btn-icon"><i class="glyphicon glyphicon-print"></i></button>
											<button type="button" class="btn btn-xs btn-primary btn-icon"><i class="glyphicon glyphicon-save"></i></button>
											<button type="button" class="btn btn-xs btn-darkgreen btn-icon"><i class="glyphicon glyphicon-link"></i></button>
											<button type="button" class="btn btn-xs btn-danger btn-icon"><i class="glyphicon glyphicon-remove"></i></button>	
										</td>
									</tr>
									<tr>
										<td>4</td>
										<td>Statistics and Probability</td>
										<td>Adding and Subtracting around the thousands boundary</td>
										<td>
											<button type="button" class="btn btn-xs btn-info btn-icon"><i class="glyphicon glyphicon-eye-open"></i></button>
											<button type="button" class="btn btn-xs btn-success btn-icon"><i class="glyphicon glyphicon-print"></i></button>
											<button type="button" class="btn btn-xs btn-primary btn-icon"><i class="glyphicon glyphicon-save"></i></button>
											<button type="button" class="btn btn-xs btn-darkgreen btn-icon"><i class="glyphicon glyphicon-link"></i></button>
											<button type="button" class="btn btn-xs btn-danger btn-icon"><i class="glyphicon glyphicon-remove"></i></button>
										</td>
									</tr>
								</tbody>
							</table>	
						</div>
						<hr>
						<article class="blog-post">
							<header class="blog-header">
								<h3>
									Begin to read the time to the hour on a clock
									<small>
										by
										<i>John Doe</i>,
										12 Sep 2012.
									</small>
								</h3>
							</header>	
							<p>
								What confuses kids the most about telling time on a clock with hands? "It's the fact that the numbers have two separate meanings," explains Amy Sperrazza, a second-grade teacher in New York City. To get her students' attention, she tells them that the numbers on a clock are double agents -- and they each have a secret identity. "I'll explain that the secret identity of the number one is five, for instance," says Sperrazza. "And that identity comes out -- like when Clark Kent becomes Superman -- only when the big hand is on the number." Swipe her idea, and practice the two identities of each number with your child on your clock at home.
							</p>
							<p>
								Or, make a simple clock that clearly illustrates the double-agent concept: Leslie Buttonow, a mom in Ronkonkoma, New York, made a practice cardboard clock for her 8-year-old daughter, Alexandra, that contains both the real numbers and each of their secret identities. Says Buttonow: "Seeing them alongside each other really made the concept click for her."
							</p>		                      		                      						
						</article>	
					</div>
				</div>
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
		
		<!-- knob plugins -->
		<script src="js/jquery.knob.js"></script>
		
		<!-- Charts plugins -->
		<script type="text/javascript" src="js/chart/jquery.flot.min.js"></script>
		<script type="text/javascript" src="js/chart/jquery.flot.stack.min.js"></script>
		<script type="text/javascript" src="js/chart/jquery.flot.pie.min.js"></script>
		<script type="text/javascript" src="js/chart/jquery.flot.resize.min.js"></script>
		
		<!-- Init plugins and custom javascript-->
		<script src="js/custom.js"></script>

	</body>
	</html>