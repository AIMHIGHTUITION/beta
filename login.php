<?php 
	
	session_start();
	if ($_SESSION['id'] != "" || $_SESSION['type'] != "") {
		header("Location: index.php");
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
	<title>Student Diagnostic | Login</title>
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<!-- Daneden animate CSS -->
	<link href="css/animate.css" rel="stylesheet">
	<link href="css/animate.min.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="css/style.css" rel="stylesheet">
	<script src="js/custom.modernizr.js" type="text/javascript" ></script>
	<!-- form validator plugin -->
	<script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
</head>
<body>	
	<div class="container"><!-- Main Container starts here -->
		<div class="row navbar-fixed-top" id="top-navigation">
			<header class=" col-sm-12 col-md-10"><!-- Navigation header starts here -->
				<div class="navbar navbar-default">
					<div class="navbar-header">
						<a class="navbar-brand" href="index.php"><i class="glyphicon glyphicon-signal"></i>Student Diagnostics</a>
					</div><!--/.nav-collapse -->
				</div>
			</header><!-- Navigation header ends here -->		      
		</div>
		<br />
		<br />
		<div class="row">
			<div class="col-sm-12 col-md-4 col-md-offset-4 sign-in animated flipInY">
				<div id="signup" class="lock-screen" >
					<div class="title icon-space"><i class="glyphicon glyphicon-lock"></i>Login</div>
					<form id="login-form" action="login_verification.php" method="post" class="form-stacked">
						<fieldset>
							<img  class="login-image center-block" src="img/assmntlock.png" alt="">
							<div class="form-group">
								<input type="text" id="email" class="form-control" name="email" placeholder="Email" required="required"/>
							</div>
							<div class="form-group">
								<div class="input">
									<input type="password" id="password" name="password" class="form-control" placeholder="Password" required="required"/>
								</div>
							</div>
							<div class="input form-group">
								<label>
									<input id="ch" tabindex="8" type="checkbox" name="remember" value="1" checked="checked" /><span>Remember me</span>
								</label>
							</div>
							<div class="form-group">
								<p class="reset">Forgot your <a tabindex="4" href="forgot-password.php" title="Recover your username or password">password</a>?</p> 
								<p class="reset"><a id="createTrigger">Create a new account.</a></p>
								<div id="typePick" class="hidesometin">
									<label class="control-label" id="accntInts" style="display:none;">Please specify type of account: </label>
									<div class="radio-inline">
										<div class="radio">
											<label style="display:none;" id="parent-accnt"><input type="radio" name="accntType" class="form-control" value="parent-accnt">Parent</label>
										</div>
									</div>
									<div class="radio-inline">
										<div class="radio">
											<label style="display:none;" id="tutor-accnt"><input type="radio" name="accntType" class="form-control" value="tutor-accnt">Tutor</label>
										</div>
									</div>
								</div>
							</div>
							<div class="actions">
								<input tabindex="9" class="btn btn-success large" type="submit" value="Login">
							</div>						            	           					
						</fieldset>
					</form>
				</div>																					
			</div><!-- login container End here -->					
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
	<script type="text/javascript">
	$(document).ready(function () {

		$('#email').focus();
		$("#createTrigger").click(function () {
			$("#typePick").removeClass("hidesometin");
			$("#createTrigger").fadeOut(3500);
			$("#accntInts").fadeIn();
			$("#parent-accnt").fadeIn(1000);
			$("#tutor-accnt").fadeIn(1500);
		});
		$("#parent-accnt").click(function () {
			window.location.href = "registration.php";
		});
		$("#tutor-accnt").click(function () {
			window.location.href = "registration_for_tutor.html";
		});

	});	
	</script>

</body>
</html>