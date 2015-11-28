<?php 

	session_start();
	$parent_id = $_SESSION['parent_id'];

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
	<title>Student Diagnostic | Student Registration</title>
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
						<a class="navbar-brand" href="index.php"><i class="glyphicon glyphicon-signal"></i>Student Diagnostics</a>
					</div>
				</div>
			</header><!-- Navigation header ends here -->
		</div><br /><br /><br />		
		<div class="row">
			<div class="col-sm-12 col-md-6 col-md-offset-6 sign-in animated flipInY">
				<div id="signup" class="lock-screen" >
					<div class="title icon-space"><i class="glyphicon glyphicon-lock"></i>Registration</div>
					<form action="student_signup.php?id=<?php echo $parent_id; ?>" method="post" class="form-stacked" novalidate>
						<fieldset id="customfset">
							<div id="registration-content">
								<div class="col-sm-12">
									<div class="widget-box">
										<h3>Student Details:</h3>
										<div id="uno">
											<div class="form-group">
												<label class="control-label" for="student-fname">First Name</label>
												<input type="text" id="student-fname" name="student-fname[]" required="required" class="form-control">
											</div>
											<div class="form-group">
												<label class="control-label" for="student-lname">Last Name</label>
												<input type="text" id="student-lname" name="student-lname[]" required="required" class="form-control">
											</div>
											<div class="col-sm-12">
												<div class="row">
													<div class="form-group col-md-6">
														<label class="control-label" for="yearlvl">Year Level</label>					
														<select id="yearlvl" name="yearlvl[]" class="form-control" required="required">
															<option value="" disabled selected>Please select year level</option>
															<option value="F">F</option>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
															<option value="6">6</option>
															<option value="7">7</option>
															<option value="8">8</option>
															<option value="9">9</option>
															<option value="10">10</option>
															<option value="11">11</option>
															<option value="12">12</option>
														</select>
													</div>
													<div class="customMtop col-md-6">
														<button type="button" id="addStd" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i>Add</button>
													</div>
												</div>
											</div>
										</div>
										<div id="dos" class="hidesometin">
											<hr>
											<div class="form-group">
												<label class="control-label" for="student-fname">First Name</label>
												<input type="text" id="student-fname" name="student-fname[]" required="required" class="form-control">
											</div>
											<div class="form-group">
												<label class="control-label" for="student-lname">Last Name</label>
												<input type="text" id="student-lname" name="student-lname[]" required="required" class="form-control">
											</div>
											<div class="col-sm-12">
												<div class="row">
													<div class="form-group col-md-6">
														<label class="control-label" for="yearlvl">Year Level</label>
														<input type="text" id="yearlvl" name="yearlvl[]" required="required" class="form-control" maxlength="1">														
													</div>
													<div class="customMtop col-md-6">
														<button type="button" id="addStd2" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i>Add</button>
														<button type="button" id="delStd2" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i>Delete</button>
													</div>
												</div>
											</div>
										</div>
										<div id="tres" class="hidesometin">
											<hr>
											<div class="form-group">
												<label class="control-label" for="student-fname">First Name</label>
												<input type="text" id="student-fname" name="student-fname[]" required="required" class="form-control">
											</div>
											<div class="form-group">
												<label class="control-label" for="student-lname">Last Name</label>
												<input type="text" id="student-lname" name="student-lname[]" required="required" class="form-control">
											</div>
											<div class="col-sm-12">
												<div class="row">
													<div class="form-group col-md-6">
														<label class="control-label" for="yearlvl">Year Level</label>
														<input type="text" id="yearlvl" name="yearlvl[]" required="required" class="form-control" maxlength="1">														
													</div>
													<div class="customMtop col-md-6">
														<button type="button" id="delStd3" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i>Delete</button>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="clearfix text-center"> 
										<p class="clickedit">By clicking Create your account button, you agree to our <a href="#" target="_blank"> terms of service </a> and  <a href="#" target="_blank">conditions.</a></p>
									</div>	
									<div class="actions text-center">
										<input type="submit" id="create-account" tabindex="9" class="btn btn-primary" value="Create your Account">
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
	<script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function () {

			$("#addStd").click(function () {
				$("#dos").removeClass("hidesometin"); 
				$(this).addClass("hidesometin");
			})
			$("#addStd2").click(function () {
				$(this).addClass("hidesometin");
				$("#delStd2").addClass("hidesometin");
				$("#tres").removeClass("hidesometin"); 
			})

			$("#delStd2").click(function () {
				$("#dos :input").not(':button, :submit, :reset, :hidden').val('');
				$("#dos").addClass("hidesometin"); 
				$("#addStd").removeClass("hidesometin");
			})
			$("#delStd3").click(function () {
				$("#tres :input").not(':button, :submit, :reset, :hidden').val('');
				$("#tres").addClass("hidesometin"); 	
				$("#addStd2").removeClass("hidesometin");
				$("#delStd2").removeClass("hidesometin");
			})
			
		});
	</script>
</body>
</html>