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
	
	$firstname=$_POST['students_first_name'];
    $email=$_POST['students_email'];
    $password=$_POST['students_password'];
    $password2=$_POST['students_password2'];
	$lastname=$_POST['students_last_name'];
	$major=$_POST['students_major'];
	$middleinitial=$_POST['students_middle_initial'];
	$gpa=$_POST['students_gpa'];
	$phone=$_POST['students_phone'];
	$standing=$_POST['students_standing'];
	
	
     if($password==$password2)
     {      //Create User
            $password=md5($password); //hash password before storing for security purposes
            $sql="INSERT INTO students(students_first_name,students_last_name,students_middle_initial,students_email,students_major,students_active, students_gpa,students_phone,students_standing,students_password) VALUES('$firstname','$lastname','$middleinitial','$email','$major',1,$gpa,$phone,'$standing','$password')";
            mysqli_query($db,$sql);  
            $_SESSION['message']="User $firstname $lastname has been created!";
            header("location:home.php");  //redirect home page
			exit();
    }
    else
    {
      $_SESSION['message']="The two password do not match";   
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
		<title>Create a New Student - SVSU Course Information</title>
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
							<form method="post" action="createStudent.php">
<h2>Create a New Student</h2>
  <table>
     <tr>
           <td>First Name : </td>
           <td><input type="text" name="students_first_name" class="textInput"></td>
     </tr>
	 <tr>
           <td>Middle Initial : </td>
           <td><input type="text" name="students_middle_initial" class="textInput"></td>
     </tr>
	 <tr>
           <td>Last Name : </td>
           <td><input type="text" name="students_last_name" class="textInput"></td>
     </tr>
     <tr>
           <td>Email : </td>
           <td><input type="email" name="students_email" class="textInput"></td>
     </tr>
      <tr>
           <td>Password : </td>
           <td><input type="password" name="students_password" class="textInput"></td>
     </tr>
      <tr>
           <td>Password again: </td>
           <td><input type="password" name="students_password2" class="textInput"></td>
     </tr>
	 <tr>
           <td>Current GPA: </td>
           <td><input type="text" name="students_gpa" class="textInput"></td>
     </tr>
	 <tr>
           <td>Major: </td>
           <td><input type="text" name="students_major" class="textInput"></td>
     </tr>
	       <tr>
           <td>Phone: </td>
           <td><input type="text" name="students_phone" class="textInput"></td>
     </tr>
	       <tr>
           <td>Standing: </td>
           <td><input type="text" name="students_standing" class="textInput"></td>
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