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

	$resource = "SELECT tbllearningcategories.year as year, tbllearningtopics.name as name, tblresources.pdf_name as pdfname
	FROM tblresources INNER JOIN tblminoroutcome ON tblresources.minor_outcomes_id=tblminoroutcome.id
	RIGHT JOIN tblmajoroutcome ON tblminoroutcome.major_outcome_id=tblmajoroutcome.id 
	RIGHT JOIN tbllearningcategories ON tblmajoroutcome.learning_categories_id=tbllearningcategories.id 
	RIGHT JOIN tbllearningtopics ON tbllearningcategories.learning_topic_id=tbllearningtopics.id
	WHERE tblresources.minor_outcomes_id=tblminoroutcome.id AND tblminoroutcome.major_outcome_id=tblmajoroutcome.id AND 
	tblmajoroutcome.learning_categories_id=tbllearningcategories.id AND tbllearningcategories.learning_topic_id=tbllearningtopics.id";
	$resquery = $db->query($resource);
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
	<!-- Data-Table style -->
	<link href="css/jquery.dataTables.css" rel="stylesheet">
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
								echo "<li><a href=\"tutor_resources.php\">Resources</a></li>";						
							}else{
								echo "<li><a href=\"assessmentsetup.php\">Assessments</a></li>";
								echo "<li><a href=\"results.php\">Results</a></li>";
								echo "<li class=\"active\"><a href=\"resources.php\">Resources</a></li>";									
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
				<div class="page-title"><h1>Resources</h1></div> 
			</div>
		</div>
		<!-- Page Header ends here -->

		<div class="row">		
			<div class="col-md-12"> 
				<div class="widget-box">
					<div class="widget-title">
						<h2><i class="glyphicon glyphicon-book"></i>Library:</h2>
					</div>					
					<div class="widget-container table-responsive">
						<div class="content noPad clearfix">
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
								to the Resources page, just click the name of the resource title to know more.
							</p>
							<table class="responsive dynamicTable display table table-hover table-bordered">
								<thead>
									<tr>
										<th>Year</th>
										<th>Learning Category</th>
										<th>Name</th>
										<th>Action</th>												
									</tr>
								</thead>
								<tbody>
									<?php 						  
										while ($record = $db->fetch_array($resquery)) {											
											echo "<tr>
											<td>$record[year]</td>
											<td>$record[name]</td>
											<td>$record[pdfname]</td>
											<td>					
												<button class='btn btn-sm btn-success'><i class='glyphicon glyphicon-eye-open'></i>View</button>			
												<button class='btn btn-sm btn-primary'><i class='glyphicon glyphicon-print'></i>Print</button>
											</td>
											</tr>";
										}
									?>											
								</tbody>
								<tfoot>
									<tr>
										<th>Year</th>
										<th>Learning Category</th>
										<th>Name</th>
										<th>Action</th>																	
									</tr>
								</tfoot>
							</table><!--end of resource table-->		
						</div> 								
					</div>			
				</div>
			</div>
		</div>	
	</div>
	<footer class="footer">
		<p>Copyright © 2015<a href="#">• Student Diagnostics | Aim High Tuition</a> • All Rights Reserved</p>
	</footer>	
	<!-- Important js put in all pages -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery.js"><\/script>')</script>
	<script src="js/bootstrap.min.js"></script>
	<!-- Important js for all pages end  -->
	<!-- Fix plugins -->
	<script type="text/javascript" src="js/ios-orientationchange-fix.js"></script>
	<!-- Data table plugins -->
	<script src="js/jquery.dataTables.min.js"></script>
	<!-- knob plugins -->
	<script src="js/jquery.knob.js"></script>
	<!-- Init plugins and custom javascript-->
	<script src="js/custom.js"></script>
	<script language="javascript" type="text/javascript">
		$(document).ready(function() {
			
		});                  
	</script>
</body>
</html>