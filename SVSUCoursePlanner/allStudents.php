<?php 
/**************************************************************************
*filename: allStudents.php
*author:   Tyler Miller
*description: This PHP enables session control, echos HTML and displays all 
*             students in system.
*			  This page is also used to retrieve JSON information with key
*			  variable id=all for all students or the student number
**************************************************************************/  
	session_start(); //required for every PHP file
	
	//PHP Template file with functions and DB connections
	include 'siteTemplate.php';
	
	//Check that user is logged in, if not redirect to index page
	if(!isset($_SESSION['username']))
	{
		echo "YOU MUST BE LOGGED IN TO SEE THIS PAGE";
		$_SESSION['message']= "You must be logged in to continue<br/>";
		header('Location: index.php'); 
		exit();
	}
	
	//If GET id variable is set, get JSON object and echo to screen, id can be for 1 student or ALL for all
	if (isset($_GET['id']))
	{
		$db = SiteTemplate::connectDatabase();
		$getKey = $_GET['id'];
		
		if ($getKey == "all")
			$sql = "SELECT * FROM students";
		else
			$sql = "SELECT * FROM students WHERE students_id =$getKey";
		
		$arr = array();
		$result=mysqli_query($db,$sql);
					
		while($student = mysqli_fetch_assoc($result))
		{
			array_push($arr, $student['students_last_name'] . ", " . $student['students_first_name']);
		}
		SiteTemplate::closeDatabase();
		echo '{"users":' . json_encode($arr) . "}";
		exit();	
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>SVSU Course Information</title>
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
			<?php SiteTemplate::loadHeaderNav(4); ?>

			<!-- Highlights -->
			<section class="wrapper style1">
				<!-- Get all student from DB and display to screen -->
				<div class="container">
					<?php
						$sql="SELECT * FROM students";
						echo '<center><h2><b>All Users Currently in System</b></h2></center>';
						$key = ALL;
						SiteTemplate::displayAllStudents($key);					
					?>
					<center><a class="btn" href="javascript:history.back()">Back</a></center>
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