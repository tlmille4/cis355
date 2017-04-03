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
	require 'database.php';
	require 'siteTemplate.php';

	$id = $_GET['id'];
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
	$image = "<img height='auto' width='50%' src='data:image/jpeg;base64," . base64_encode($picture) . "'>";			
	
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
		<title>SVSU Course Information</title>
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
			<?php SiteTemplate::loadHeaderNav(); ?>


			<!-- Highlights -->
				<section class="wrapper style1">
					<div class="container">
						<div class="row 200%">
							<section class="4u 12u(narrower)">
								<div class="box highlight">
								<?php echo $image; ?>
								</div>
							</section>
							<section class="4u 12u(narrower)">
								<div class="box highlight">
								
								<div class="control-group">
						<label class="control-label">First Name:</label> <?php echo $first_name; ?>
					</div>
					<div class="control-group">
						<label class="control-label">Last Name:</label> <?php echo $last_name; ?>
					</div>
					<div class="control-group">
						<label class="control-label">Middle Initital:</label> <?php echo $middle_initial; ?>
					</div>
					<div class="control-group">
						<label class="control-label">Major:</label> <?php echo $major; ?>
					</div>
					<div class="control-group">
						<label class="control-label">Email/Login:</label> <?php echo $email; ?>
					</div>
					<div class="control-group">
						<label class="control-label">Password:</label> <?php echo "<a href='resetPassword.php'>Click here</a> to change your password"; ?>
					</div>
					<div class="control-group">
						<label class="control-label">Standing:</label> <?php echo $standing; ?>
					</div>
					<div class="control-group">
						<label class="control-label">GPA:</label> <?php echo $gpa; ?>
					</div>
					<div class="control-group">
						<label class="control-label">Currently Active?:</label> <?php if($gpa)echo "True"; else echo"False"; ?>
					</div>
					<div class="form-actions">
						<a href="javascript:history.back()">Go Back</a>
						</div>
								
								</div>
							</section>
							<section class="4u 12u(narrower)">
								<div class="box highlight">
								</div>
							</section>
						</div>
					</div>
				</section>



			<!-- CTA -->
				<section id="cta" class="wrapper style3">
					<div class="container">
						<header>
							<h2>Are you ready to continue your quest?</h2>
							<a href="#" class="button">Insert Coin</a>
						</header>
					</div>
				</section>

			<!-- Footer -->
				<div id="footer">
					<div class="container">
						<div class="row">
							<section class="3u 6u(narrower) 12u$(mobilep)">
								<h3>Links to Stuff</h3>
								<ul class="links">
									<li><a href="#">Mattis et quis rutrum</a></li>
									<li><a href="#">Suspendisse amet varius</a></li>
									<li><a href="#">Sed et dapibus quis</a></li>
									<li><a href="#">Rutrum accumsan dolor</a></li>
									<li><a href="#">Mattis rutrum accumsan</a></li>
									<li><a href="#">Suspendisse varius nibh</a></li>
									<li><a href="#">Sed et dapibus mattis</a></li>
								</ul>
							</section>
							<section class="3u 6u$(narrower) 12u$(mobilep)">
								<h3>More Links to Stuff</h3>
								<ul class="links">
									<li><a href="#">Duis neque nisi dapibus</a></li>
									<li><a href="#">Sed et dapibus quis</a></li>
									<li><a href="#">Rutrum accumsan sed</a></li>
									<li><a href="#">Mattis et sed accumsan</a></li>
									<li><a href="#">Duis neque nisi sed</a></li>
									<li><a href="#">Sed et dapibus quis</a></li>
									<li><a href="#">Rutrum amet varius</a></li>
								</ul>
							</section>
							<section class="6u 12u(narrower)">
								<h3>Get In Touch</h3>
								<form>
									<div class="row 50%">
										<div class="6u 12u(mobilep)">
											<input type="text" name="name" id="name" placeholder="Name" />
										</div>
										<div class="6u 12u(mobilep)">
											<input type="email" name="email" id="email" placeholder="Email" />
										</div>
									</div>
									<div class="row 50%">
										<div class="12u">
											<textarea name="message" id="message" placeholder="Message" rows="5"></textarea>
										</div>
									</div>
									<div class="row 50%">
										<div class="12u">
											<ul class="actions">
												<li><input type="submit" class="button alt" value="Send Message" /></li>
											</ul>
										</div>
									</div>
								</form>
							</section>
						</div>
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
								<li>&copy; 2017 Tyler Miller. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
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