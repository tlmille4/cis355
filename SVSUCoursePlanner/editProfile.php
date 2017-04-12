<?php 
session_start(); //required for every PHP file
//if userid is not set, call login function

//Redirect back to login if not logged in
if(!isset($_SESSION['username']))
{
	echo "YOU MUST BE LOGGED IN TO SEE THIS PAGE";
	$_SESSION['message']= "You must be logged in to continue<br/>";
	header('Location: index.php'); 
	exit();
}

	require 'database.php';
	require 'siteTemplate.php';

	$id = $_SESSION['student'];

	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	

	
	if ( !empty($_POST)) {
		// keep track validation errors
		$first_nameError = null;
		$timeError = null;
		$locationError = null;
		$descriptionError = null;
		$middleError = null;
		$majorError = null;
		
		
		// keep track post values
		$first_name = $_POST['first_name'];
		$time = $_POST['event_time'];
		$location = $_POST['event_location'];
		$description = $_POST['event_description'];
		$middle_initial = $_POST['students_middle_initial'];
		$major = $_POST['students_major'];
		echo $first_name;
		echo $time;
		echo $location;
		echo $description;
		
		// validate input
		$valid = true;
		if (empty($first_name)) {
			$first_nameError = 'Please enter First Name';
			$valid = false;
		}
		
		if (empty($time)) {
			$timeError = 'Please enter a Last Name';
			$valid = false;
		} 
		
		if (empty($location)) {
			$locationError = 'Please enter Phone Number';
			$valid = false;
		}
		if (empty($description)) {
			$descriptionError = 'Please enter Email Address';
			$valid = false;
			
		}
		echo $valid;
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE students SET students_first_name = ?, students_last_name = ?, students_phone =?, students_email =?, students_middle_initial =?, students_major =? WHERE students_id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($first_name,$time,$location,$description,$middle_initial,$major,$id));
			Database::disconnect();
			$_SESSION['message'] = "Your profile information has been updated!";
			header("Location: home.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM students where students_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$userInfo = $data;
		$first_name = $data['students_first_name'];
		$time = $data['students_last_name'];
		$location = $data['students_phone'];
		$description = $data['students_email'];
		$middle_initial = $data['students_middle_initial'];
		$major = $data['students_major'];
		$isActive = $data['students_active'];
		$gpa = $data['students_gpa'];
		$standing = $data['students_standing'];
		$password = $data['students_password'];
		$picture = $data['students_image'];
				
		$_SESSION['image'] = "<img height='auto' width='50%' src='data:image/jpeg;base64," . base64_encode($picture) . "'>";
		Database::disconnect();
	}


	
?>



<!DOCTYPE HTML>
<!--
	Arcana by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Edit Profile - SVSU Course Information</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="icon" href="favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>
		<div id="page-wrapper">
			
			<!-- Header -->
					<!-- Logo -->
					<!-- Nav -->
				<!-- Header -->
				<div id="header">
					<!-- Logo -->
					<!-- Nav -->
						<?php SiteTemplate::loadHeaderNav(2);?>

				</div>

			<!-- Banner 
				<section id="banner">
					<header>
						<h2>Arcana: <em>A responsive site template freebie by <a href="http://html5up.net">HTML5 UP</a></em></h2>
						<a href="#" class="button">Learn More</a>
					</header>
				</section>-->

							<!-- Highlights -->
				<section class="wrapper style1">
					<div class="container">

								<div class="span10 offset1">
    				<div class="row">
		    			<h3>Update Your Profile</h3>
		    		</div>
					
					<!--
					<div class="row">
						<div class = "col">
							<?php echo $_SESSION['image'];?> <br/>
							<form action='fileUpload.php' enctype='multipart/form-data' method='post'>
								Change Profile Image:
								<input type='file' name="file1" id="file1"/>
								<input type='submit'/>
							</form>
						</div>
					</div>
					-->
					<div class="row 200%">
						
						<section class="6u 12u(narrower)">
							<div class="box highlight">
							<?php echo $_SESSION['image'];?> <br/><br/>
							<form action='fileUpload.php' enctype='multipart/form-data' method='post'>
								Change Profile Image:<br/>
								<input type='file' name="file1" id="file1"/>
								<input type='submit'/>
							</form>
							</div>
						</section>
						<section class="5u 12u(narrower)">
							<div class="box highlight">
								<form action="editProfile.php?id=<?php echo $id?>" method="post">
									<div class="control-group <?php echo !empty($first_nameError)?'error':'';?>">
										<label class="control-label">First Name</label>
											
											<input name="first_name" type="text"  placeholder="First Name" value="<?php echo !empty($first_name)?$first_name:'';?>">
											<?php if (!empty($first_nameError)): ?>
												<span class="help-inline"><?php echo $first_nameError;?></span>
											<?php endif; ?>
										
									</div>
									<div class="control-group <?php echo !empty($timeError)?'error':'';?>">
										<label class="control-label">Last Name</label>
										<div class="controls">
											<input name="event_time" type="text" placeholder="Time" value="<?php echo !empty($time)?$time:'';?>">
											<?php if (!empty($timeError)): ?>
												<span class="help-inline"><?php echo $timeError;?></span>
											<?php endif;?>
										</div>
									</div>
									<div class="control-group <?php echo !empty($middleError)?'error':'';?>">
										<label class="control-label">Middle Initital</label>
										<div class="controls">
											<input name="students_middle_initial" type="text" placeholder="MI" value="<?php echo !empty($middle_initial)?$middle_initial:'';?>">
											<?php if (!empty($middleError)): ?>
												<span class="help-inline"><?php echo $middleError;?></span>
											<?php endif;?>
										</div>
									</div>
									<div class="control-group <?php echo !empty($locationError)?'error':'';?>">
										<label class="control-label">Phone Number</label>
										<div class="controls">
											<input name="event_location" type="text"  placeholder="Location" value="<?php echo !empty($location)?$location:'';?>">
											<?php if (!empty($locationError)): ?>
												<span class="help-inline"><?php echo $locationError;?></span>
											<?php endif;?>
										</div>
									</div>
									<div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
										<label class="control-label">Email Address/Login</label>
										<div class="controls">
											<input name="event_description" type="text"  placeholder="Description" value="<?php echo !empty($description)?$description:'';?>">
											<?php if (!empty($descriptionError)): ?>
												<span class="help-inline"><?php echo $descriptionError;?></span>
											<?php endif;?>
										</div>
									</div>
									<div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
										<label class="control-label">Major</label>
										<div class="controls">
											<input name="students_major" type="text"  placeholder="Major" value="<?php echo !empty($major)?$major:'';?>">
											<?php if (!empty($majorError)): ?>
												<span class="help-inline"><?php echo $majorError;?></span>
											<?php endif;?>
										</div>
									</div>
									<div class="control-group">
											<label class="control-label">Password:</label> <?php echo "<a href='resetPassword.php'>Click here</a> to change your password<br/><br/>"; ?>
									</div>
									<div class="form-actions">
										
										<input type="submit" value="Update" name="Submit"/>
										<a class="btn" href="home.php">Back</a>
										</div>
									</form>
							</div>
						</section>
						
						
					</div>
	    			
					
				</div>
					</div>
				</section>
				
							<!-- Highlights -->
				<section class="wrapper style1">
					<div class="container">
					
						<div class="row 200%">
							<section class="3u 12u(narrower)">
								<div class="box highlight">
								</div>
							</section>
							<section class="6u 12u(narrower)">
								<div class="box highlight">
								<!-- Showing enrolled courses table with PHP -->

									
								</div>
							</section>
							<section class="3u 12u(narrower)">
							</section>
						</div>
					</div>
				</section>
				


			<!-- Footer -->
				<div id="footer">
					<div class="container">
						<div class="row">

					</div>

					<!-- Icons -->
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-github"><span class="label">GitHub</span></a></li>
							<li><a href="#" class="icon fa-linkedin"><span class="label">LinkedIn</span></a></li>
							<li><a href="#" class="icon fa-google-plus"><span class="label">Google+</span></a></li>
						</ul>

					<!-- Copyright -->
						<div class="copyright">
							<ul class="menu">
								<li>&copy; Untitled. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
							</ul>
						</div>

				</div>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>