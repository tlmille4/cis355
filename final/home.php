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
	
	//connect to database
	$db=SiteTemplate::connectDatabase();

	$id = $_SESSION['student'];
	$sql = "SELECT * FROM students where students_id =$id";
	
	$result=mysqli_query($db,$sql);
		
	while($row = mysqli_fetch_assoc($result))
	{
		$first_name=$row['students_first_name'];
		$last_name=$row['students_last_name'];
		$email=$row['students_email'];
		$major=$row['students_major'];
		$isActive = $row['students_active'];
		$middle_initial = $row['students_middle_initial'];
		$gpa = $row['students_gpa'];
		$admin = $row['students_isadmin'];
		$standing = $row['students_standing'];
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
		<title>Home - SVSU Course Information</title>
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
				<?php SiteTemplate::loadHeaderNav(1);?>

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
							<section class="3u 12u(narrower)">
								<div class="box highlight">
									<i class="icon major fa-paper-plane"></i>
									<h3>User Overview</h3>
										<table>
											<tr>
												<td><b>First Name:</b></td> 
												<td><?php echo $first_name; ?></td>
											</tr>
											<tr>
												<td><b>Last Name:</b></td> 
												<td><?php echo $last_name; ?></td>
											</tr>	
											<tr>
												<td><b>Mid Init:</b></td> 
												<td><?php echo $middle_initial; ?></td>
											</tr>
											<tr>
												<td><b>Major:</b></td> 
												<td><?php echo $major; ?></td>
											</tr>	
	
											<tr>
												<td><b>Standing:</b></td> 
												<td>  <?php echo $standing; ?></td>
											</tr>	
											<tr>
												<td><b>GPA: </b></td> 
												<td> <?php echo $gpa; ?></td>
											</tr>
										</table>
								</div>
							</section>
							<section class="6u 12u(narrower)">
								<div class="box highlight">
									<?php 
										if(isset($_SESSION['message']))
										{
											echo "<center><div style='color: red;'>".$_SESSION['message']."</div></center><br/>";
											unset($_SESSION['message']);
										}
										echo SiteTemplate::getUserImage();
										echo "<h1>". SiteTemplate::getGreeting() . $_SESSION['first_name'] . '!</h1>';
								

						?>
								</div>
							</section>
							<section class="3u 12u(narrower)">
								<div class="box highlight">
									<i class="icon major fa-wrench"></i>
									<h3>Account Information</h3>
									<table>
	
											<tr>
												<td><b>Email/Login:</b></td> 
												<td> <?php echo $email; ?></td>
											</tr>
											<tr>
												<td><b>Password:</b></td> 
												<td> <?php echo "<a href='resetPassword.php'>Click here</a> to change"; ?></td>
											</tr>
											<tr>
												<td><b>Admin?:</b></td> 
												<td> <?php if($admin)echo "True"; else echo"False"; ?></td>
											</tr>												
	

											<tr>
												<td><b>Active?:</b></td> 
												<td> <?php if($isActive)echo "True"; else echo"False"; ?></td>
											</tr>	

										</table>
								</div>
							</section>
						</div>
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