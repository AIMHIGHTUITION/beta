<!DOCTYPE html>
<html class="no-js" lang="en" >
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="description" content="Student Diagnostic"/>
	<meta name="keywords" content="Online Assessment, Test Prep, Tutors, Review Center" />
	<meta name="author" content="Aim High Tuition"/>
	<link rel="shortcut icon" href="favicon.png">
	<title>Student Diagnostic | Sign-up</title>
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
					<form action="signup_process.php" method="post" class="form-stacked">
						<fieldset id="customfset">
							<div id="registration-content">
								<div id="step2Con" class="col-sm-12 col-md-6">
									<div class="widget-box">
										<div class="step1">
											<h3>Contact Info:</h3>
											<div class="form-group">
												<label class="control-label" for="fname">First Name</label>
												<input type="text" id="fname" name="fname" required="required" class="form-control">
											</div>
											<div class="form-group">
												<label class="control-label" for="lname">Last Name</label>
												<input type="text" id="lname" name="lname" required="required" class="form-control">
											</div>
											<div class="form-group">
												<label class="control-label" for="email">Email</label>
												<input type="email" id="email" name="email" required="required" class="form-control">
											</div>
											<div class="form-group">
												<label class="control-label" for="password">Password</label> 
												<input type="password" id="password" name="password" required="required" class="form-control" maxlength="6" />
											</div>
											<div class="form-group">
												<label class="control-label" for="confirm_password">Confirm Password</label> 
												<input type="password" id="confirm_password" name="confirm_pass" required="required" class="form-control" maxlength="6"/>
												<div id="divCheckPasswordMatch"></div>
											</div>
										</div>          					
									</div>
								</div>
								<div class="step1 col-sm-12 col-md-6">
									<div class="widget-box">
										<h3 class="hideme">Info:</h3>									
										<div class="form-group">
											<label class="control-label" for="city">City</label>
											<input type="text" id="city" name="city" required="required" class="form-control">
										</div>
										<div class="form-group">
											<label class="control-label" for="postcode">Postcode</label>
											<input type="text" name="postcode" id="postcode" required="required" class="input req form-control" maxlength="4">
										</div>
										<div class="form-group">
											<label class="control-label" for="state">State</label>					
											<select id="state" name="state" class="form-control" required="required">
												<option value="" disabled selected>Please select your state</option>
												<option value="QLD">QLD</option>
												<option value="NSW">NSW</option>
												<option value="ACT">ACT</option>
												<option value="VIC">VIC</option>
												<option value="SA">SA</option>
												<option value="WA">WA</option>
												<option value="NT">NT</option>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label" for="phone_number">Phone number</label>
											<input type="text" name="phone_number" id="phone_number" required="required" class="form-control" maxlength="10" >
										</div>
									</div>
								</div>
								<div class="step1">
									<div class="clearfix text-center"> 
										<p></p>
									</div>	
									<div class="actions text-center">
										<button type="submit" id="add-student" tabindex="9" class="btn btn-success" disabled="disabled">Add Student</button>
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

		$("#add-student").css("opacity","inherit");
		// $("#create-account").css("opacity","inherit");

		function checkPasswordMatch() {
			var password = $("#password").val();
			var confirmPassword = $("#confirm_password").val();

			if (password != confirmPassword){
				$("#divCheckPasswordMatch").html("Passwords do not match!").css("color","red");
				// $("#create-account").prop("disabled",true);
				$("#add-student").prop("disabled",true);
				$("#confirm_password").focus();
			}else{
				$("#divCheckPasswordMatch").html("Password match.").css("color","green");
				$("#add-student").prop("disabled",false);
				// $("#create-account").prop("disabled",false);
			}
		}

		// function studentPasswordMatch() {
		// 	var password = $("#student-pass").val();
		// 	var confirmPassword = $("#student-conpas").val();

		// 	if (password != confirmPassword){
		// 		$("#studentPassMatch").html("Passwords do not match!").css("color","red");
		// 		$("#student-conpas").focus();
		// 		$("#add-student").prop("disabled",true);
		// 		// $("#create-account").prop("disabled",true);
		// 	}else{
		// 		$("#studentPassMatch").html("Password match.").css("color","green");
		// 		$("#add-student").prop("disabled",false);
		// 		// $("#create-account").prop("disabled",false);
		// 	}
		// }

		$("#confirm_password").change(checkPasswordMatch);
		// $("#student-conpas").change(studentPasswordMatch);

		// $("#add-student").click(function() {
		// 	$(".step1").fadeOut("slow").addClass("hidesometin");
		// 	$(".step2").removeClass("hidesometin").fadeIn("slow");
		// 	$("#step2Con").removeClass("col-md-6");
		// });

		// $("#create-account").click(function() {
		// 	if($("#terms-cond").prop('checked') == false){
		// 		alert( "Please check Terms and Conditions to proceed" );
		// 	}		
		// });
	});
</script>
</body>
</html>