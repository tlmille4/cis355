<?php 
/**************************************************************************
*filename: dropStudent.php
*author:   Tyler Miller
*description: This PHP enables session control, echos HTML and allows an 
*		      admin user to update course info to the DB
**************************************************************************/  

	session_start(); //required for every PHP file
	//if userid is not set, call login function
	
	if(!isset($_SESSION['username']))
	{
		echo "YOU MUST BE LOGGED IN TO SEE THIS PAGE";
		$_SESSION['message']= "You must be logged in to continue<br/>";
		header('Location: index.php'); 
		exit();
	}
	
	
	include 'siteTemplate.php';
	
	if(isset($_POST['register_btn']))
	{
		//Processing get info from form
		$instructorID=$_POST['admin'];
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
		
		//Sending info to function to process input and insert into database
		SiteTemplate::updateCourse($_SESSION['courseID'],$instructorID,$section,$prefix,$courseNumber,$courseName,$meetingTimes,$buildingCode,$roomNumber,$occRate,$term,$credits);
	
		unset($_SESSION['courseID']);
		//Redirect to homepage
		header("location:home.php");  //redirect home page
		exit();
	
	}
	else if(isset($_POST['courses']))
	{
		$courseID = $_POST['courses'];
		$_SESSION['courseID'] = $_POST['courses'];
		$db=SiteTemplate::connectDatabase();
		$sql = "SELECT * FROM courses WHERE courses_id = '$courseID'";
		$result = mysqli_query($db,$sql);

		//$crs = mysqli_fetch_array($result);
		while($course = mysqli_fetch_assoc($result))
		{
			$courses[]=$course;
		}

		foreach ($courses as $course)
		{
			$instructorID=$course['instructors_id'];
			$section=$course['courses_section'];
			$prefix=$course['courses_prefix'];
			$courseNumber=$course['courses_number'];
			$courseName=$course['courses_name'];
			$meetingTimes=$course['courses_meeting_times'];
			$buildingCode=$course['courses_building'];
			$roomNumber=$course['courses_room_number'];
			$occRate=$course['courses_available'];
			$term=$course['courses_term'];
			$credits=$course['courses_credits'];
		}
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
		<title>Update a Course - SVSU Course Information</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>
		<div align="center"id="page-wrapper">
			
			<!-- Header -->
					<!-- Logo -->
					<!-- Nav -->
				<?php SiteTemplate::loadHeaderNav(4);?>


<?php	echo	'<!-- Highlights -->
				<section align="center" class="wrapper style1">
					<div align="center" class="container">
					<h2>Select Class to Edit</h2>';
					echo SiteTemplate::editCourseDropdown();
					echo	'<div class="row 200%">
						
							<form method="post" action="updateCourse.php">

								  <table>
									 <tr>
											
										   <td>Instructor: </td>
									<td><select name="admin" id="admin">'; //SiteTemplate::instructorDropdownUpdate($instructorID) 
									
									
									$db = SiteTemplate::connectDatabase();
									//$studentID = $_SESSION['student'];
									$sql = "SELECT * FROM students
											WHERE students_isadmin=1";
									$result = mysqli_query($db,$sql);

									//get all records into array
									while($admin = mysqli_fetch_assoc($result))
									{
										$admins[]=$admin;
									}


									foreach ($admins as $admin)
									{
										if($instructorID == $admin['students_id'])
											$showSelect = ' selected="selected"';
										else
											$showSelect = "";
										echo "<option value='" . $admin['students_id'] ."'" . $showSelect . ">" . $admin['students_last_name'] . ', ' . $admin['students_first_name'] . "</option>";
										
									}
									
									
									
									echo '</select></td>
									 </tr>';
									 echo '<tr>
										   <td>Course Section : </td>
										   <td><input type="text" value="' . htmlentities($section) . '" name="course_section" class="textInput"></td>
									 </tr>
									 <tr>
										   <td>Course Prefix : </td>
										   <td><input type="text" value="' . htmlentities($prefix) . '"name="course_prefix" class="textInput"></td>
									 </tr>
									 <tr>
										   <td>Course Number : </td>
										   <td><input type="text" value="' . htmlentities($courseNumber) . '"name="course_number" class="textInput"></td>
									 </tr>
									  <tr>
										   <td>Course Name : </td>
										   <td><input type="text" value="' . htmlentities($courseName) . '"name="course_name" class="textInput"></td>
									 </tr>
									  <tr>
										   <td>Meeting Times (String): </td>
										   <td><input type="text" value="' . htmlentities($meetingTimes) . '"name="meeting_times" class="textInput"></td>
									 </tr>
									 <tr>
										   <td>Building Code: </td>
										   <td><input type="text" value="' . htmlentities($buildingCode) . '"name="building_code" class="textInput"></td>
									 </tr>
									 <tr>
										   <td>Room Number: </td>
										   <td><input type="text" value="' . htmlentities($roomNumber) . '"name="room_number" class="textInput"></td>
									 </tr>
									 <tr>
										   <td>Term (ie 17WI): </td>
										   <td><input type="text" value="' . htmlentities($term) . '"name="term" class="textInput"></td>
									 </tr>
									<tr>
										   <td>Occupancy Rate: </td>
										   <td><input type="text" value="' . htmlentities($occRate) . '"name="occupancy_rate" class="textInput"></td>
									 </tr>
										   <tr>
										   <td>Credits: </td>
										   <td><input type="text" value="' . htmlentities($credits) . '"name="credits" class="textInput"></td>
									 </tr>
									  <tr>
										   <td></td>
										   <td><input value="Submit" type="submit" name="register_btn" class="Register"></td>
									 </tr>
								  
								</table>
								</form>
						</div>
					</div>
				</section>';
?>


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