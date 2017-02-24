<?php 
	session_start();
	require 'database.php';
	require 'siteTemplate.php';

	$id = $_SESSION['student'];
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
			
	
	Database::disconnect();

	SiteTemplate::displayHeading();
	SiteTemplate::displayUserNavigation();

?>

<body>
    <div class="container">
    
		<div class="span10 offset1">
			<div class="row">
				<h3>View Your Profile</h3>
			</div>

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
				<a class="btn" href="home.php">Back</a>
				</div>
		</div>
				
    </div> <!-- /container -->
  </body>
</html>