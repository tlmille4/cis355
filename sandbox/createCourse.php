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

//connect to database
$db=mysqli_connect("localhost","tlmille4","460207","tlmille4");
include 'siteTemplate.php';

if(isset($_POST['register_btn']))
{
    //$username=mysql_real_escape_string($_POST['username']);
    //$email=mysql_real_escape_string($_POST['email']);
    //$password=mysql_real_escape_string($_POST['password']);
    //$password2=mysql_real_escape_string($_POST['password2']);  
	
	$instructorID=$_POST['instructor_id'];
    $section=$_POST['course_section'];
    $prefix=$_POST['course_prefix'];
    $courseNumber=$_POST['course_number'];
	$courseName=$_POST['course_name'];
	$meetingTimes=$_POST['meeting_times'];
	$buildingCode=$_POST['building_code'];
	$roomNumber=$_POST['room_number'];
	$occRate=$_POST['occupancy_rate'];
	$term=$_POST['term'];
	$credits=$_POST['credits'];
	 
	
	$sql="INSERT INTO courses(instructors_id, courses_section, courses_prefix, courses_number, courses_name, courses_meeting_times, courses_building, courses_room_number,courses_available, courses_term, courses_credits) VALUES('$instructorID','$section','$prefix','$courseNumber','$courseName','$meetingTimes','$buildingCode','$roomNumber','$occRate', '$term' ,'$credits')";
	
	
	if(mysqli_query($db,$sql))
		$_SESSION['message']="$courseName has been created";
	else
		$_SESSION['message']="Error creating $courseName. Please check for proper inputs";
	
	
	header("location:home.php");  //redirect home page
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
		<title>Create a New Course - SVSU Course Information</title>
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
				<?php SiteTemplate::loadHeaderNav(4);?>

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
					
						<div class="row 200%">
							<form method="post" action="createCourse.php">
								<h2>Create a New Class</h2>
								  <table>
									 <tr>
										   <td>Instructor ID : </td>
										   <td><input type="text" name="instructor_id" class="textInput"></td>
									 </tr>
									 <tr>
										   <td>Course Section : </td>
										   <td><input type="text" name="course_section" class="textInput"></td>
									 </tr>
									 <tr>
										   <td>Course Prefix : </td>
										   <td><input type="text" name="course_prefix" class="textInput"></td>
									 </tr>
									 <tr>
										   <td>Course Number : </td>
										   <td><input type="text" name="course_number" class="textInput"></td>
									 </tr>
									  <tr>
										   <td>Course Name : </td>
										   <td><input type="text" name="course_name" class="textInput"></td>
									 </tr>
									  <tr>
										   <td>Meeting Times (String): </td>
										   <td><input type="text" name="meeting_times" class="textInput"></td>
									 </tr>
									 <tr>
										   <td>Building Code: </td>
										   <td><input type="text" name="building_code" class="textInput"></td>
									 </tr>
									 <tr>
										   <td>Room Number: </td>
										   <td><input type="text" name="room_number" class="textInput"></td>
									 </tr>
									 <tr>
										   <td>Term (ie 17WI): </td>
										   <td><input type="text" name="term" class="textInput"></td>
									 </tr>
									<tr>
										   <td>Occupancy Rate: </td>
										   <td><input type="text" name="occupancy_rate" class="textInput"></td>
									 </tr>
										   <tr>
										   <td>Credits: </td>
										   <td><input type="text" name="credits" class="textInput"></td>
									 </tr>
									  <tr>
										   <td></td>
										   <td><input type="submit" name="register_btn" class="Register"></td>
									 </tr>
								  
								</table>
								</form>
						</div>
					</div>
				</section>


			<!-- CTA -->
				<section id="cta" class="wrapper style3">
					<div class="container">
						<header>
							<h2>See what classes are available</h2>
							<a href="#" class="button">View Classes</a>
						</header>
					</div>
				</section>

			<!-- Footer -->
				<div id="footer">
					<div class="container">
						<div class="row">

						</div>
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