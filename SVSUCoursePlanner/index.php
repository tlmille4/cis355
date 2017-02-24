<?php 
session_start(); //required for every PHP file
//if userid is not set, call login function
if(isset($_SESSION['student']))
{
	header("Location: home.php");
}
if(!isset($_POST['login_btn']))
{
	if($_SESSION['message'])
	{
		echo "<div id='error_msg'>".$_SESSION['message']."</div>";
		unset($_SESSION['message']);
	}
	login();
	exit();
}
else
{
	include 'siteTemplate.php';
	
	SiteTemplate::displayHeading();
	SiteTemplate::displayClosingTags();
	SiteTemplate::validateUser();
	if($_SESSION['message'])
	{
		echo "<div id='error_msg'>".$_SESSION['message']."</div>";
		unset($_SESSION['message']);
		SiteTemplate::displayLoginForm();
	}

}

//enables user to login
function login()
{
	//echo file_get_contents("welcome.html");
	include 'siteTemplate.php';
	SiteTemplate::displayHeading();
	echo '[Not implemented yet] <a href="adminlogin.php">Instructors/Administrators Login</a>';
	SiteTemplate::displayLoginForm();
	SiteTemplate::displayClosingTags();
}
	

?>
