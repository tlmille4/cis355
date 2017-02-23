<?php 
session_start(); //required for every PHP file
//if userid is not set, call login function
if(empty($_SESSION['userid']))
{
	login();
	exit();
}
else
{
	include 'customers_oop.php';	
	include 'database.php';
	
	Customers::displayListScreen();
}

//enables user to login
function login()
{

	echo '<form action="demo_form.php" method="post">';
	echo '<p>Email: ';
	echo '<input type = "text" name="email"/> <br/>';
	echo '<p>Password: ';
	echo '<input type = "password" name="password"/> <br/>';
	echo '<input type="submit" value="Submit">';
	echo '</form>';
}
	

?>
