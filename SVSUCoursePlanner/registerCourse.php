<?php
session_start();
include 'siteTemplate.php';
SiteTemplate::displayHeading();
SiteTemplate::displayUserNavigation();
if(!isset($_SESSION['username']))
{
	echo "YOU MUST BE LOGGED IN TO SEE THIS PAGE";
	exit();
}

$courseID=$_POST['courses'];
$studentID = $_SESSION['student'];

echo "Course Num: " . $courseID . "<br/>";
echo "StudentNum: " . $studentID . "<br/>";

$db=mysqli_connect("localhost","tlmille4","460207","tlmille4");

echo $courseID . $studentID;
$sql = "INSERT INTO enrolled_courses (students_id, courses_id) VALUES ('$studentID','$courseID')";
mysqli_query($db,$sql);

$_SESSION['message']="The selected class has been registered!";
header('Location: home.php');  //redirect home page
exit();

//echo '<p align="center">User Navigation: <a href="classes.php">Class Schedule</a> [--]
//	  <a href="registerClasses.php">Register for a Class</a></p>';
//
//	  
//	 
////SiteTemplate::courseRegistrationTable($db);		
//SiteTemplate::displayClosingTags();


?>
