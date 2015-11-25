<?php 	
	session_start();

	if($_SESSION['id'] == "" && $_SESSION['type'] == ""){
		header("Location: login.php");
		exit();
	}

	require("dbase/config.inc.php");
	require("dbase/Database.class.php");
	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();

	$id = $_SESSION['id']; //login user ID
	$sessionType = $_SESSION['type']; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="description" content="Student Diagnostic"/>
	<meta name="keywords" content="Online Assessment, Test Prep, Tutors, Review Center" />
	<meta name="author" content="Aim High Tuition"/>
	<link rel="shortcut icon" href="favicon.png">
	<title>Student Diagnostic | Account Setup</title>
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
							<li><a href="index.php">Dashboard</a></li>
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

		<div class="row pgtle-margin"><!-- Page Header starts here -->
			<div class="col-md-8" >
				<div class="page-title"><h1>Profile Setup</h1></div> 
			</div>
		</div><!-- Page Header ends here -->

		<div class="row">			
			<div class="col-sm-12 col-md-9 std-hdden"><!-- parent/tutor info container starts here -->
				<div class="widget-box">
					<div class="widget-title">
						<h2>Personal Information</h2>
					</div>
					<div class="widget-container">
						<div class="row">
							<div class="col-md-3">
								<aside>
									<div class="well">
										<strong>Quick Tip</strong>
										<hr id="hr-divider">
										<p><i class="glyphicon glyphicon-ok"></i> Onec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo Donec id elit non mi porta gravida at eget metus. Fusce daprmentum massa justo.</p>
									</div>
								</aside>
							</div>
							<div class="col-md-9">
								<div id="profile-info">
									<table class="table">
										<tbody>
											<?php
												if ($sessionType == 'p') {
													$parent = "SELECT * FROM tblparents where id='$id'";
													$parent_query = $db->query($parent);
													$loggedinfo = 1;
													if ($record = $db->fetch_array($parent_query)) {
														echo "<tr><td class=\"cell-sm\">First Name :</td>
														<td id='user-fname".$id."'>$record[fname]</td></tr>";
														echo "<tr><td class=\"cell-sm\">Last Name :</td>
														<td id='user-lname".$id."'>$record[lname]</td></tr>";
														echo "<tr><td class=\"cell-sm\">Email :</td>
														<td id='user-email".$id."'>$record[email]</td></tr>";
														echo "<tr><td class=\"cell-sm\">City :</td>
														<td id='user-city".$id."'>$record[city]</td></tr>";
														echo "<tr><td class=\"cell-sm\">Postcode :</td>
														<td id='user-postcode".$id."'>$record[postcode]</td></tr>";
														echo "<tr><td class=\"cell-sm\">State :</td>
														<td id='user-state".$id."'>$record[state]</td></tr>";
														echo "<tr><td class=\"cell-sm\">Phone Number :</td>
														<td id='user-phone".$id."'>$record[phone]</td></tr>";
													}
												}elseif ($sessionType == 't') {
													$tutor = "SELECT * FROM tbltutor where id='$id'";
													$tutor_query = $db->query($tutor);
													$loggedinfo = 2;

													if ($record = $db->fetch_array($tutor_query)) {
														echo "<tr><td class=\"cell-sm\">First Name :</td>
														<td id='user-fname".$id."'>$record[fname]</td></tr>";
														echo "<tr><td class=\"cell-sm\">Last Name :</td>
														<td id='user-lname".$id."'>$record[lname]</td></tr>";
														echo "<tr><td class=\"cell-sm\">Email :</td>
														<td id='user-email".$id."'>$record[email]</td></tr>";
														echo "<tr><td class=\"cell-sm\">City :</td>
														<td id='user-city".$id."'>$record[city]</td></tr>";
														echo "<tr><td class=\"cell-sm\">Postcode :</td>
														<td id='user-postcode".$id."'>$record[postcode]</td></tr>";
														echo "<tr><td class=\"cell-sm\">State :</td>
														<td id='user-state".$id."'>$record[state]</td></tr>";
														echo "<tr><td class=\"cell-sm\">Phone Number :</td>
														<td id='user-phone".$id."'>$record[phone]</td></tr>";
													}									
												}else{ 
													$loggedinfo = 3;
												}						
											?>
										</tbody>
									</table>
									<div class="pull-right">
										<button id="edit-btn" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i>Edit</button>
									</div>
								</div>
								<!-- edit profile info -->
								<form action="edit_update.php?user=<?php echo "$sessionType$id"; ?>" id="profile-update" method="post" class="form-horizontal hidesometin" role="form">	
									<div class="form-group">
										<label for="user-fname" class="col-md-3 control-label">First Name:</label>
										<div class="col-md-5">
											<input type="text" class="form-control" id="user-fname" name="user-fname" value="<?php echo "$record[fname]"; ?>" required="required">
										</div>
									</div>
									<div class="form-group">
										<label for="user-lname" class="col-md-3 control-label">Last Name:</label>
										<div class="col-md-5">
											<input type="text" class="form-control" id="user-lname" name="user-lname" value="<?php echo "$record[lname]"; ?>" required="required">
										</div>
									</div>
									<div class="form-group">
										<label for="user-email" class="col-md-3 control-label text=">Email:</label>
										<div class="col-md-5">
											<input type="email" class="form-control" id="user-email" name="user-email" value="<?php echo "$record[email]"; ?>" required="required">
										</div>
									</div>
									<div class="form-group">
										<label for="user-city" class="col-md-3 control-label">City:</label>
										<div class="col-md-5">
											<input type="text" class="form-control" id="user-city" name="user-city" value="<?php echo "$record[city]"; ?>" required="required">
										</div>
									</div>
									<div class="form-group">
										<label for="user-postcode" class="col-md-3 control-label">Postcode:</label>
										<div class="col-md-5">
											<input type="text" class="form-control" id="user-postcode" name="user-postcode" value="<?php echo "$record[postcode]"; ?>" maxlength="4" required="required">
										</div>
									</div>
									<div class="form-group">
										<label for="user-state" class="col-md-3 control-label">State:</label>
										<div class="col-md-5">
											<select id="state" name="user-state" class="form-control" required="required">
												<option value="<?php echo "$record[state]"; ?>" disabled selected>Please select your state</option>
												<option value="QLD">QLD</option>
												<option value="NSW">NSW</option>
												<option value="ACT">ACT</option>
												<option value="VIC">VIC</option>
												<option value="SA">SA</option>
												<option value="WA">WA</option>
												<option value="NT">NT</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="user-phone" class="col-md-3 control-label">Phone Number:</label>
										<div class="col-md-5">
											<input type="text" class="form-control" id="user-phone" name="user-phone" value="<?php echo "$record[phone]"; ?>" maxlength="10" required="required">
										</div>
									</div>
									<div class="text-center pull-right">
										<button type="submit" id="update-btn" class="btn btn-primary"><i class="glyphicon glyphicon-save"></i>Update</button>
										<button type="button" id="cancel-btn" class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i>Cancel</button>
									</div>
								</form>	
							</div>
						</div>
					</div>
				</div>
			</div><!-- parent/tutor info container End here -->		
			<div class="col-sm-12 col-md-3"><!-- development -->
				<div class="widget-box">
					<div class="widget-title">
						<h2>Development</h2>
					</div>
					<div class="widget-container vital-stats">
						<label>99% Math</label>
						<div class="progress progress-striped active">
							<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: 99%">
								<span class="sr-only">99% Complete (success)</span>
							</div>
						</div>
						<label>95% Science</label>
						<div class="progress progress-striped active">
							<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%">
								<span class="sr-only">95% Complete</span>
							</div>
						</div>
						<label>60% Literature</label>
						<div class="progress progress-striped active">
							<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
								<span class="sr-only">60% Complete (warning)</span>
							</div>
						</div>
						<label>40% History</label>
						<div class="progress progress-striped active">
							<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
								<span class="sr-only">40% Complete (danger)</span>
							</div>
						</div>
					</div>	
				</div>
			</div>
			<div class="col-sm-12 col-md-9 tut-hdden"><!-- student container starts here -->
				<div class="widget-box">
					<div class="widget-title"><h2>Student</h2></div>
					<div class="widget-container">
						<div class="row">
							<div class="col-md-3">
								<aside>
									<div class="well">
										<strong>Quick Tip</strong>
										<hr id="hr-divider">
										<p><i class="glyphicon glyphicon-ok"></i> Onerc id elit non mi porta gravida at eget metus. </p> 
									</div>
								</aside>
							</div>
							<div class="col-md-9">	
								<div id="student-info">
									<!-- add new student form --> 
									<form action="add_new.php?id=<?php echo "$id"; ?>" id="addNewStd" method="post" class="form-horizontal hidesometin" role="form">
										<div class="form-group">
											<label for="new-fname" class="col-md-3 control-label">First Name:</label>
											<div class="col-md-5">
												<input type="text" class="form-control" id="new-fname" name="new-fname" required="required">
											</div>
										</div>
										<div class="form-group">
											<label for="new-lname" class="col-md-3 control-label">Last Name:</label>
											<div class="col-md-5">
												<input type="text" class="form-control" id="new-lname" name="new-lname" required="required">
											</div>
										</div>
										<div class="form-group">
											<label for="new-yrlvl" class="col-md-3 control-label text=">Year Level:</label>
											<div class="col-md-5">
												<input type="text" class="form-control" id="new-yrlvl" name="new-yrlvl" required="required" maxlength="1">
											</div>
										</div>							
										<div class="pull-right"> <!-- controls -->
											<input type="submit" id="addNew" tabindex="9" class="btn btn-success" value="Add">
											<input type="button" id="cancelAdd" tabindex="9" class="btn btn-primary" value="Cancel">
										</div>
									</form>	
									<input type="submit" id="addStd" tabindex="9" class="btn btn-success pull-right std-hdden" value="Add Student">
									<table class="table">
										<tbody id="student-one">
											<?php 
											
												$ctr = 0;
												$studentid = "";
												$std2Name = "";
												$std3Name = "";
												$std1Name = "";

												if ($sessionType == 's') {
													
													$studentInfo = "SELECT * FROM tblstudents where id='$id'";
													$student_info = $db->query($studentInfo);

													while ($record = $db->fetch_array($student_info)) {

														echo "<tr><td class=\"cell-sm\">First Name :</td>
														<td>$record[fname]</td></tr>";
														echo "<tr><td class=\"cell-sm\">Last Name :</td>
														<td>$record[lname]</td></tr>";
														echo "<tr><td class=\"cell-sm\">Year Level :</td>
														<td>$record[year_level]</td></tr>";
														echo "<tr><td class=\"cell-sm hideme\">$ctr</td>
														<td></td></tr>"; 
													}


												}else{ 

													$student = "SELECT * FROM tblstudents where parent_id='$id'";
													$student_query = $db->query($student);
													
													while ($record = $db->fetch_array($student_query)) {
														$ctr = $ctr + 1;
														$studentID = $record["id"];
														if ($ctr>=2) {
															$studentid = "student_id".$ctr;
														}

														echo "<tr><td class=\"cell-sm\">First Name :</td>
														<td id='fname".$studentID."'>$record[fname]</td></tr>";
														echo "<tr><td class=\"cell-sm\">Last Name :</td>
														<td id='lname".$studentID."'>$record[lname]</td></tr>";
														echo "<tr><td class=\"cell-sm\">Year Level :</td>
														<td id='yearLevel".$studentID."'>$record[year_level]</td></tr>";
														echo "<tr><td class=\"cell-sm hideme\">$ctr</td>
														<td></td></tr>"; 

														if ($studentid=="student_id2") {
															$std2 = "$record[id]";
															$std2Name = "$record[fname]";
															$std2PrtCol = $studentid;

														}else if ($studentid=="student_id3") {
															$std3 = "$record[id]";
															$std3Name = "$record[fname]";
															$std3PrtCol = $studentid;
														}else{
															$std1 = "$record[id]";
															$std1Name = "$record[fname]";
															$std1PrtCol = "student_id";
														}
													}

												}
												
											?>
										</tbody>
									</table>
									<div class="pull-right std-hdden">
										<div id="std-controls">
											<button id="cancel-update" class="btn btn-primary hidesometin"><i class="glyphicon glyphicon-arrow-left"></i>Cancel</button>
											<button id="std-edit" class="btn btn-primary" data-toggle="modal" data-target="#stdEdtMsg"><i class="glyphicon glyphicon-pencil"></i>Edit</button>
											<button id="deleteBtn" class="btn btn-danger hidesometin" data-toggle="modal" data-target="#confirmDelete"><i class="glyphicon glyphicon-remove"></i>Delete</button>
										</div>
										<!-- confirm deletion -->
										<div id="confirmDelete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteStudent">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title" id="deleteStudent">Confirm Delete</h4>
													</div>
													<div class="modal-body">
														<div class="form-group deleteMsg">
															<label class="col-md-6 control-label">Choose student you wish to delete:</label>
															<div class="col-md-4">
																<select id="stdToDel" class="form-control">
																	<option value="<?php echo "$std1&prntCol=$std1PrtCol"; ?>"><?php echo "$std1Name"; ?></option>
																	<option value="<?php echo "$std2&prntCol=$std2PrtCol"; ?>"><?php echo "$std2Name"; ?></option>
																	<option value="<?php echo "$std3&prntCol=$std3PrtCol"; ?>"><?php echo "$std3Name"; ?></option>
																</select>
															</div>
														</div>
													</div>
													<div class="modal-footer">
														<button id="cancelStdEdit" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
														<button id="deleteStd" type="button" class="btn btn-primary">Delete</button>
													</div>
												</div>
											</div>
										</div>
										<!-- edit std deletion -->
										<div id="stdEdtMsg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateStudent">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button id="closeStdEdtMsg" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title" id="updateStudent">Edit</h4>
													</div>
													<div class="modal-body">
														<div class="form-group deleteMsg">
															<label class="col-md-7 control-label">Choose student profile you wish to edit:</label>
															<div class="col-md-4">
																<select id="stdToEdit" class="form-control">
																	<option value="<?php echo "$std1"; ?>"><?php echo "$std1Name"; ?></option>
																	<option value="<?php echo "$std2"; ?>"><?php echo "$std2Name"; ?></option>
																	<option value="<?php echo "$std3"; ?>"><?php echo "$s