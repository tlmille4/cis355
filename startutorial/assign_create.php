<?php 
	
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$custError = null;
		$eventError = null;
		$commentsError = null;
		$descriptionError = null;
		
		// keep track post values
		$cust = $_POST['cust'];
		$event = $_POST['event'];
		$comments = $_POST['comments'];
		
		// validate input
		$valid = true;
		if (empty($cust)) {
			$custError = 'Please enter cust';
			$valid = false;
		}
		
		if (empty($event)) {
			$eventError = 'Please enter a event';
			$valid = false;
		} 
		
		if (empty($comments)) {
			$commentsError = 'Please enter comments';
			$valid = false;
		}

		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO assignments (cust_id,event_id,comments) values(?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($cust,$event,$comments));
			Database::disconnect();
			header("Location: assign_create.php");
		}
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
		    			<h3>Create an Assignment</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="assign_create.php" method="post">
					  <div class="control-group <?php echo !empty($custError)?'error':'';?>">
					  <!--
					    <label class="control-label">cust</label>
					    <div class="controls">
					      	<input name="cust" type="text"  placeholder="cust" value="<?php echo !empty($cust)?$cust:'';?>">
					      	<?php if (!empty($custError)): ?>
					      		<span class="help-inline"><?php echo $custError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  -->
					  <select name="cust">
						<?php 
							$pdo = Database::connect();
							$sql = 'SELECT * FROM customers ORDER BY id DESC';
							foreach ($pdo->query($sql) as $row) 
							{
								echo '<option value ="' . $row['id'] . '">' . $row[name] . '</option>';
							}
							Database::disconnect();
						?>
					  </select>
					  
					  
					  <div class="control-group <?php echo !empty($eventError)?'error':'';?>">
					    <label class="control-label">event</label>
					    <div class="controls">
					      	<input name="event" type="text" placeholder="event" value="<?php echo !empty($event)?$event:'';?>">
					      	<?php if (!empty($eventError)): ?>
					      		<span class="help-inline"><?php echo $eventError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($commentsError)?'error':'';?>">
					    <label class="control-label">comments</label>
					    <div class="controls">
					      	<input name="comments" type="text"  placeholder="comments" value="<?php echo !empty($comments)?$comments:'';?>">
					      	<?php if (!empty($commentsError)): ?>
					      		<span class="help-inline"><?php echo $commentsError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="assign_create.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>