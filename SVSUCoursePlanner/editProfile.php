<?php 
	session_start();
if(!isset($_SESSION['username']))
{
	echo "YOU MUST BE LOGGED IN TO SEE THIS PAGE";
	$_SESSION['message']= "You must be logged in to continue<br/>";
	header('Location: index.php'); 
	exit();
}
	
	
	require 'database.php';
	require 'siteTemplate.php';

	$id = $_SESSION['student'];

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
		$middleError = null;
		$majorError = null;
		
		
		// keep track post values
		$first_name = $_POST['first_name'];
		$time = $_POST['event_time'];
		$location = $_POST['event_location'];
		$description = $_POST['event_description'];
		$middle_initial = $_POST['students_middle_initial'];
		$major = $_POST['students_major'];
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
			$sql = "UPDATE students SET students_first_name = ?, students_last_name = ?, students_phone =?, students_email =?, students_middle_initial =?, students_major =? WHERE students_id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($first_name,$time,$location,$description,$middle_initial,$major,$id));
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
		$picture = $data['students_image'];
				
		
		Database::disconnect();
	}

	SiteTemplate::displayHeading();
	SiteTemplate::displayUserNavigation();
	$_SESSION['image'] = "<img height='auto' width='50%' src='data:image/jpeg;base64," . base64_encode($picture) . "'>";
	
?>





<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Update Your Profile</h3>
		    		</div>
					
					<!--
					<div class="row">
						<div class = "col">
							<?php echo $_SESSION['image'];?> <br/>
							<form action='fileUpload.php' enctype='multipart/form-data' method='post'>
								Change Profile Image:
								<input type='file' name="file1" id="file1"/>
								<input type='submit'/>
							</form>
						</div>
					</div>
					-->
					<div class="row">
						<div class="col-sm-1" style="text-align: right;">
						</div>
						<div class="col-sm-5" >
							<?php echo $_SESSION['image'];?> <br/><br/>
							<form action='fileUpload.php' enctype='multipart/form-data' method='post'>
								Change Profile Image:<br/>
								<input type='file' name="file1" id="file1"/>
								<input type='submit'/>
							</form>
						</div>
						<div class="col-sm-4">
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
								<div class="control-group <?php echo !empty($middleError)?'error':'';?>">
									<label class="control-label">Middle Initital</label>
									<div class="controls">
										<input name="students_middle_initial" type="text" placeholder="MI" value="<?php echo !empty($middle_initial)?$middle_initial:'';?>">
										<?php if (!empty($middleError)): ?>
											<span class="help-inline"><?php echo $middleError;?></span>
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
								<div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
									<label class="control-label">Major</label>
									<div class="controls">
										<input name="students_major" type="text"  placeholder="Major" value="<?php echo !empty($major)?$major:'';?>">
										<?php if (!empty($majorError)): ?>
											<span class="help-inline"><?php echo $majorError;?></span>
										<?php endif;?>
									</div>
								</div>
								<div class="control-group">
										<label class="control-label">Password:</label> <?php echo "<a href='resetPassword.php'>Click here</a> to change your password<br/><br/>"; ?>
								</div>
								<div class="form-actions">
									<button type="submit" class="btn btn-success">Update</button>
									<a class="btn" href="home.php">Back</a>
									</div>
								</form>
						</div>

					</div>
	    			
					
				</div>
				
    </div> <!-- /container -->
  </body>
</html>