<?php 
session_start(); //required for every PHP file
//if userid is not set, call login function
if(!isset($_POST['login_btn']))
{
	login();
	exit();
}
else
{
	include 'siteTemplate.php';
	
	SiteTemplate::displayHeading();
	SiteTemplate::displayClosingTags();
	SiteTemplate::validateAdmin();
	if($_SESSION['message'])
	{
		echo $_SESSION['message'];
		SiteTemplate::displayAdminLoginForm();
	}

}

//enables user to login
function login()
{
	//echo file_get_contents("welcome.html");
	include 'siteTemplate.php';
	SiteTemplate::displayHeading();
	SiteTemplate::displayAdminLoginForm();
	//echo '<form action="demo_form.php" method="post">';
	//echo '<p>Email: ';
	//echo '<input type = "text" name="email"/> <br/>';
	//echo '<p>Password: ';
	//echo '<input type = "password" name="password"/> <br/>';
	//echo '<input type="submit" value="Submit">';
	//echo '</form>';
	SiteTemplate::displayClosingTags();
}
	

?>
