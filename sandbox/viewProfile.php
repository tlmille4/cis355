
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

	if(isset($_GET['id']))
		$id = $_GET['id'];
	else
		$id = $_SESSION['student'];	
	

	require 'database.php';
	require 'siteTemplate.php';

	
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM students where students_id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	$userInfo = $data;
	$first_name = $data['students_first_name'];
	
	$last_name = $data['students_last_name'];
	$phone = $data['students_phone'];
	$email = $data['students_email'];
	$middle_initial = $data['students_middle_initial'];
	$major = $data['students_major'];
	$isActive = $data['students_active'];
	$gpa = $data['students_gpa'];
	$standing = $data['students_standing'];
	$password = $data['students_password'];
	$picture = $data['students_image'];
			
			
	$query = "SELECT students_image FROM students WHERE id=$id";
	$result = mysql_query($query);
		
	$content = mysql_result($result, 0, "content");
					
	$_SESSION['image'] = "<img height='auto' width='50%' src='data:image/jpeg;base64," . base64_encode($picture) . "'>";
	Database::disconnect();

	
?>



<!DOCTYPE HTML>
<!--
	Arcana by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>View Profile - SVSU Course Information</title>
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
		    			<h3>View <?php echo $first_name . " " . $last_name . "'s"; ?> Profile</h3>
		    		</div>
				
					<div class="row 200%">
						
						    
								<section class="5u 12u(narrower)">
									<div class="box highlight">
										<?php echo $_SESSION['image']; ?>
									</div>
								</section>
								
								<section class="6u 12u(narrower)">
									<div class="box highlight">
										<table style="width: 70%;">
											<tr>
												<td><b>First Name:</b></td> 
												<td><?php echo $first_name; ?></td>
											</tr>
											<tr>
												<td><b>Last Name:</b></td> 
												<td><?php echo $last_name; ?></td>
											</tr>	
											<tr>
												<td><b>Middle Initital:</b></td> 
												<td><?php echo $middle_initial; ?></td>
											</tr>
											<tr>
												<td><b>Major:</b></td> 
												<td><?php echo $major; ?></td>
											</tr>	
											<tr>
												<td><b>Email/Login:</b></td> 
												<td> <?php echo $email; ?></td>
											</tr>
											<tr>
												<td><b>Password:</b></td> 
												<td> <?php echo "<a href='resetPassword.php'>Click here</a> to change your password"; ?></td>
											</tr>	
											<tr>
												<td><b>Standing:</b></td> 
												<td>  <?php echo $standing; ?></td>
											</tr>	
											<tr>
												<td><b>GPA: </b></td> 
												<td> <?php echo $gpa; ?></td>
											</tr>
											<tr>
												<td><b>Currently Active?:</b></td> 
												<td> <?php if($isActive)echo "True"; else echo"False"; ?></td>
											</tr>	

										</table>
										
												<a class="btn" href="javascript:history.back()">Back</a>
									</div>
								</section>
							</div>
								


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