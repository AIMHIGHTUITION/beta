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

	<title>Verification Email Sent</title>
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="css/style.css" rel="stylesheet">

	<script src="js/custom.modernizr.js" type="text/javascript" ></script>
</head>
<body>
	<div class="container"><!-- Main Container starts here -->
		<div class="row">
			<div class="col-sm-12 col-md-6 col-md-offset-3">
				<div class="widget-box text-center coming-soon">
					<div class="widget-title">
						<h2 class="logo"><i class="glyphicon glyphicon-signal"></i>Student Diagnostics</h2>
					</div>
					<div class="widget-container">
						<p>Confirm Your Email Address</p>								
						<p>Account successfully created! A confirmation email has been sent to <strong><?php echo $_SESSION['email_add'];?></strong> Click on the confirmation link in the email to activate your account.</p>
					</div>
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
</body>
</html>