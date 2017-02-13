<?php
	session_start();
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password_hash = md5($password);
	$loginApproved = false;

	//FIND RECORD WITH EMAIL ADDRESS

	include 'database.php';
	$pdo = Database::connect();
	$sql = 'SELECT * FROM customers WHERE email = "' . $email . '"';
	foreach ($pdo->query($sql) as $row) 
	{
		
		if(0 == strcmp(trim($row['password']),trim($password_hash)))
		{
			$loginApproved = true;
			$_SESSION['userid'] = $row['id'];
		}
		
	}
	Database::disconnect();


//CONFIRM PASSWORD EQUALS THE PASSWORD IN THE DATABASE

	
	//exit();
	header("Location: index_oop.php")
	
?>