<?php 
	session_start(); //required for every PHP file

	//Template file that holds functions and DB access functions
	include 'siteTemplate.php';

	//If user is not logged in, redirect to index page
	if(!isset($_SESSION['username']))
	{
		echo "YOU MUST BE LOGGED IN TO SEE THIS PAGE";
		$_SESSION['message']= "You must be logged in to continue<br/>";
		header('Location: index.php'); 
		exit();
	}

	//If post courses variable set, register course with database
	if(isset($_POST['courses']))
	{
		$courseID=$_POST['courses'];
		$studentID = $_SESSION['student'];
		
		
		$db=SiteTemplate::connectDatabase();
		//mysqli_connect("localhost","tlmille4","460207","tlmille4");
		
		
		//See if already registered
		$sql = "SELECT * FROM enrolled_courses WHERE courses_id = '$courseID' AND students_id = '$studentID'";
		$result = mysqli_query($db,$sql);
		if(mysqli_num_rows($result)==0)
		{
			//Get availablity number and set new number
			$sql = "SELECT courses_available FROM courses WHERE courses_id = '$courseID'";
		
			$result = mysqli_query($db,$sql);
			while($course = mysqli_fetch_assoc($result))
				$courses[]=$course;
			foreach ($courses as $course)
				$availnum = $course['courses_available'];
			
			//Set availability
			$availnum = $availnum - 1;
			
			//If available register, otherwise, let user know class is full
			if ($availnum >= 0)
			{
				$sql = "UPDATE courses SET courses_available='$availnum' WHERE courses_id = '$courseID'";
				mysqli_query($db,$sql);
		
				$sql = "INSERT INTO enrolled_courses (students_id, courses_id) VALUES ('$studentID','$courseID')";
				mysqli_query($db,$sql);
		
				$_SESSION['message']="The selected class has been registered!";
			}
			else
				$_SESSION['message']="Error! Could not register for course: Class is full!";

		}
		else
			$_SESSION['message']="Error! You are already registered for this class!";
		
		header('Location: home.php');  //redirect home page
		exit();	
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
		<title>Register for a Course - SVSU Course Information</title>
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
			<div id="header">
				<!-- Logo -->
				<!-- Nav -->
				<?php SiteTemplate::loadHeaderNav(3);?>

			</div>

			<!-- Highlights -->
			<section class="wrapper style1">
				<div class="container">
					<?php
						echo "<h3 align='center'>Available Courses:</h3>";
						SiteTemplate::showAllCourses();
					?>
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
								<?php 
									echo "<h1>Register for a course below, " . $_SESSION['first_name'] . "</h1>";					
										SiteTemplate::courseRegistrationTable();	
								?>	
							</div>
						</section>		
					</div>
				</div>
			</section>
	
			<!-- Footer -->
			<div id="footer">
				<div class="container">
				<!-- Icons -->
					<ul class="icons">
						<li><a href="https://twitter.com/svsu?lang=en" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="https://www.facebook.com/svsu.edu/" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="https://github.com/tlmille4/cis355" class="icon fa-github"><span class="label">GitHub</span></a></li>
						<li><a href="https://www.linkedin.com/edu/saginaw-valley-state-university-18625" class="icon fa-linkedin"><span class="label">LinkedIn</span></a></li>
						<li><a href="https://www.instagram.com/svsucardinals/" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
					</ul>
				<!-- Copyright -->
					<div class="copyright">
						<ul class="menu">
							<li>&copy; 2017 Saginaw Valley State University. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a> & <a href="http://www.facebook.com/tlmille4">Tyler Miller</a></li>
						</ul>
					</div>
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