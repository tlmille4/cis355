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

echo '<a href="logout.php">Logout</a>';
echo "<br/>";
echo "<h1>Course Schedule</h1>";
echo "<h2>Welcome " . $_SESSION['first_name'] . "!</h2>";
SiteTemplate::showEnrolledCourses();
SiteTemplate::displayClosingTags();


?>
