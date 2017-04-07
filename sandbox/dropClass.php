<?php 
session_start(); //required for every PHP file
//if userid is not set, call login function


if(!isset($_SESSION['username']))
{
	echo "YOU MUST BE LOGGED IN TO SEE THIS PAGE";
	$_SESSION['message']= "You must be logged in to continue<br/>";
	header('Location: index.php'); 
	exit();
}

require 'siteTemplate.php';
if (isset($_POST['courses']))
{
	$db = SiteTemplate::connectDatabase();
	$removeCourse=$_POST['courses'];
	$studentID=$_SESSION['student'];
	$sql = "DELETE FROM enrolled_courses
			WHERE courses_id=$removeCourse AND students_id=$studentID";
	mysqli_query($db,$sql);
    $_SESSION['message']="The selected class has been dropped!";
	SiteTemplate::closeDatabase();
    //echo $removeCourse . " " . $studentID;
	header('Location: home.php');  //redirect home page
	
	exit();
}

else
{
	//connect to database
	$db=mysqli_connect("localhost","tlmille4","460207","tlmille4");


	//echo "<div id='welcomeMsg'>Register for a course below:</div>";
	//echo $_SESSION['username'];
	//print_r($_SESSION['student']);
	
	

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
		<title>Drop a Class - SVSU Course Information</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
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
				<?php SiteTemplate::loadHeaderNav(3);?>

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

								<?php 
									echo "<h1>Currently Enrolled Classes for ";
									$firstname=$_SESSION['first_name'];
									$lastname=$_SESSION['last_name'];
									echo " $firstname $lastname</h2> <br/><br/>";
									SiteTemplate::showEnrolledCourses();
									
									echo "<div align='center'>Select a course to drop: <br/>";

									SiteTemplate::dropStudentCourses($db);	
									echo "<br/><br/></div>";
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

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>