<?php

session_start();
require 'siteTemplate.php';

//connect to database
$db=mysqli_connect("localhost","tlmille4","460207","tlmille4");
if(isset($_POST['register_btn']))
{
	$studentID = $_SESSION['student'];
	$sql = "SELECT students_password FROM students WHERE students_id=$studentID";
	$result=mysqli_query($db,$sql);
	$student=mysqli_fetch_assoc($result);

	
	print_r($student);
	$currentPassword=$student['students_password'];
    $password=$_POST['students_password'];
    $password2=$_POST['students_password2'];
	echo $password2;
	
	$password = md5($password);
	echo $password;
     if($password==$currentPassword)
     {      
            $password2=md5($password2); //hash password before storing for security purposes
            $sql = "UPDATE students SET students_password='$password2' WHERE students_id=$studentID";
            mysqli_query($db,$sql);  
            $_SESSION['message']="User password has been changed!";
            header("location:home.php");  //redirect home page
			exit();
    }
    else
    {
      $_SESSION['message']="Incorrect current password!";   
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
		<title>Reset Password - SVSU Course Information</title>
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
						<?php if(isset($_SESSION['message']))
										{
											echo "<center><div style='color: red;'>".$_SESSION['message']."</div></center><br/>";
											unset($_SESSION['message']);
										}
						?>
						<h2>Reset Password</h2>
						<form method="post" action="resetPassword.php">
						<table style="width: 40%;">
						
							<tr>
								<td>Current Password : </td>
								<td><input type="password" name="students_password" class="textInput"></td>
							</tr>
							<tr>
								<td>New Password: </td>
								<td><input type="password" name="students_password2" class="textInput"></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="submit" name="register_btn" class="Register"></td>
							</tr>
						</table>
						</form>
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