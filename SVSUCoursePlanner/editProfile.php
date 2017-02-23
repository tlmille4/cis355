<?php 
	session_start();
	require 'database.php';

	$id = $_SESSION['student'];;
	echo $id;
	echo "HIHIHI";
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		//header("Location: home.php");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$first_nameError = null;
		$timeError = null;
		$locationError = null;
		$descriptionError = null;
		
		// keep track post values
		$first_name = $_POST['first_name'];
		$time = $_POST['event_time'];
		$location = $_POST['event_location'];
		$description = $_POST['event_description'];
		echo $first_name;
		echo $time;
		echo $location;
		echo $description;
		
		// validate input
		$valid = true;
		if (empty($first_name)) {
			$first_nameError = 'Please enter First Name';
			$valid = false;
		}
		
		if (empty($time)) {
			$timeError = 'Please enter a Last Name';
			$valid = false;
		} 
		
		if (empty($location)) {
			$locationError = 'Please enter Phone Number';
			$valid = false;
		}
		if (empty($description)) {
			$descriptionError = 'Please enter Email Address';
			$valid = false;
			
		}
		echo $valid;
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE students SET students_first_name = ?, students_last_name = ?, students_phone =?, students_email =? WHERE students_id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($first_name,$time,$location,$description,$id));
			Database::disconnect();
			$_SESSION['message'] = "   [  !  ] Your profile information has been updated!";
			header("Location: home.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM students where students_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$userInfo = $data;
		$first_name = $data['students_first_name'];
		$time = $data['students_last_name'];
		$location = $data['students_phone'];
		$description = $data['students_email'];
		$middle_initial = $data['students_middle_initial'];
		$major = $data['students_major'];
		$isActive = $data['students_active'];
		$gpa = $data['students_gpa'];
		$standing = $data['students_standing'];
		$password = $data['students_password'];
				
		
		Database::disconnect();
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Update Your Profile</h3>
		    		</div>
					<?php echo $password; ?>
	    			<form class="form-horizontal" action="editProfile.php?id=<?php echo $id?>" method="post">
					  <div class="control-group <?php echo !empty($first_nameError)?'error':'';?>">
					    <label class="control-label">First Name</label>
					    <div class="controls">
					      	<input name="first_name" type="text"  placeholder="First Name" value="<?php echo !empty($first_name)?$first_name:'';?>">
					      	<?php if (!empty($first_nameError)): ?>
					      		<span class="help-inline"><?php echo $first_nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($timeError)?'error':'';?>">
					    <label class="control-label">Last Name</label>
					    <div class="controls">
					      	<input name="event_time" type="text" placeholder="Time" value="<?php echo !empty($time)?$time:'';?>">
					      	<?php if (!empty($timeError)): ?>
					      		<span class="help-inline"><?php echo $timeError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($locationError)?'error':'';?>">
					    <label class="control-label">Phone Number</label>
					    <div class="controls">
					      	<input name="event_location" type="text"  placeholder="Location" value="<?php echo !empty($location)?$location:'';?>">
					      	<?php if (!empty($locationError)): ?>
					      		<span class="help-inline"><?php echo $locationError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
					    <label class="control-label">Email Address/Login</label>
					    <div class="controls">
					      	<input name="event_description" type="text"  placeholder="Description" value="<?php echo !empty($description)?$description:'';?>">
					      	<?php if (!empty($descriptionError)): ?>
					      		<span class="help-inline"><?php echo $descriptionError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="home.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>