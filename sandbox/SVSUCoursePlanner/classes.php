<?php
session_start();
if(!isset($_SESSION['username']))
{
	echo "YOU MUST BE LOGGED IN TO SEE THIS PAGE";
	$_SESSION['message']= "You must be logged in to continue";
	header('Location: index.php'); 
	exit();
}
 
//connect to database
$db=mysqli_connect("localhost","tlmille4","460207","tlmille4");
include 'siteTemplate.php';

SiteTemplate::displayHeading();
SiteTemplate::displayUserNavigation();

echo "<h1>Course Schedule for";
$firstname=$_SESSION['first_name'];
$lastname=$_SESSION['last_name'];
echo " $firstname $lastname</h2> <br/><br/>";
SiteTemplate::showEnrolledCourses();
SiteTemplate::displayClosingTags();


?>
