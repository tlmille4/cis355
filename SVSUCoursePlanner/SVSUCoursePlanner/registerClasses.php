<?php
session_start();
if(!isset($_SESSION['username']))
{
	echo "YOU MUST BE LOGGED IN TO SEE THIS PAGE";
	$_SESSION['message']= "You must be logged in to continue<br/>";
	header('Location: index.php'); 
	exit();
}
 
//connect to database
$db=mysqli_connect("localhost","tlmille4","460207","tlmille4");
include 'siteTemplate.php';

SiteTemplate::displayHeading();


SiteTemplate::displayUserNavigation();

if(isset($_SESSION['message']))
{
	 echo "<div id='error_msg'>".$_SESSION['message']."</div>";
	 unset($_SESSION['message']);
	 
	 echo "<div id='welcomeMsg'><h1>Welcome, " . $_SESSION['first_name'] . "!</h4></div>";
	 
}
echo "<div id='welcomeMsg'>Register for a course below:</div>";
//echo $_SESSION['username'];
//print_r($_SESSION['student']);

SiteTemplate::courseRegistrationTable($db);		
SiteTemplate::displayClosingTags();


?>
