<?php 
	session_start(); //required for every PHP file
	
	//Require template files for database and function executions
	require 'database.php';
	require 'siteTemplate.php';
	
	//If userid is not set, redirect to index page
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
	
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM students where students_id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	$userInfo = $data;
	$first_name = $data['students_first_name'];
	
	//Get student information
	$last_name = $data['students_last_name'];
	$phone = $data['students_phone'];
	$email = $data['students_email'];
	$middle_initial = $data['students_middle_initial'];
	$major = $data['students_major'];
	$isActive = $data['students_active'];
	$gpa = $data['students_gpa'];
	$standing = $data['students_standing'];
	$password = $data['students_password'];
	$admin = $data['students_isadmin'];
	$picture = $data['students_image'];
			
	//Create SQL query
	$query = "SELECT students_image FROM students WHERE id=$id";
	$result = mysql_query($query);
		
	$content = mysql_result($result, 0, "content");
	//Set session image variable				
	$_SESSION['image'] = "<img height='auto' width='50%' src='data:image/jpeg;base64," . base64_encode($picture) . "'>";
	Database::disconnect();
?>



<!DOCTYPE HTML>
<html>
	<head>
		<title>View Profile - SVSU Course Information</title>
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
				<?php SiteTemplate::loadHeaderNav(2);?>
			</div>

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
											<td><b>Standing:</b></td> 
											<td>  <?php echo $standing; ?></td>
										</tr>
										<?php if($admin == 0)
										{
											echo '<tr>
											<td><b>GPA: </b></td> 
											<td>' . $gpa . '</td>
												</tr>';
										}
										?>
										<tr>
										<td><b>Currently Active?:</b></td> 
											<td> <?php if($isActive)echo "True"; else echo"False"; ?></td>
										</tr>	
									</table>
									<center><a class="btn" href="javascript:history.back()">Back</a></center>
								</div>
							</section>
						</div>
					</div>
				</div>
			</section>
		</div>
				
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