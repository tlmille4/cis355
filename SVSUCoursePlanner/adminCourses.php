<?php
/*******************************************************************
*filename: adminCourses.php
*author:   Tyler Miller
*description: This PHP enables session control and displays all 
*             courses in system by calling showAllCourses function
*			  from SiteTemplate.php file
*******************************************************************/ 
	session_start(); //required for every PHP file
	
	//Template file that holds functions and DB access functions
	include 'siteTemplate.php';
	
	//Ensuring user is logged in, else redirect to index page
	if(!isset($_SESSION['username']))
	{
		echo "YOU MUST BE LOGGED IN TO SEE THIS PAGE";
		$_SESSION['message']= "You must be logged in to continue<br/>";
		header('Location: index.php'); 
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
		<title>View All Courses Taught - SVSU Course Information</title>
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
					<?php SiteTemplate::loadHeaderNav(3);?>

				</div>

				<!-- Highlights -->
				<section class="wrapper style1">
					<div class="container">

					<?php
						$id = $_SESSION['student'];
						echo "<h3 align='center'>Available Courses:</h3>";
						SiteTemplate::showAllCourses($id);
					?>
					</div>
					<center><a class="btn" href="javascript:history.back()">Back</a></center>
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

			<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>