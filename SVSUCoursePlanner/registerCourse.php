<?php
session_start();
if(!isset($_SESSION['username']))
{
	echo "YOU MUST BE LOGGED IN TO SEE THIS PAGE";
	exit();
}

$number=$_POST['courseNumber'];
$prefix=$_POST['coursePrefix'];

echo $number;
echo $prefix;

$db=mysqli_connect("localhost","tlmille4","460207","tlmille4");
$sql = "SELECT * FROM courses WHERE courses_prefix='$prefix' AND courses_number='$number'";

$result = mysqli_query($db,$sql);
print_r($result);
$row = mysqli_fetch_assoc($result);

$courseID = $row['courses_id'];
$studentID = $_SESSION['student'];
echo $courseID . $studentID;
$sql = "INSERT INTO enrolled_courses (students_id, courses_id) VALUES ('$studentID', '$courseID')";
mysqli_query($db,$sql);


//connect to database
//$db=mysqli_connect("localhost","tlmille4","460207","tlmille4");
include 'siteTemplate.php';

SiteTemplate::displayHeading();


echo '<p align="center">User Navigation: <a href="classes.php">Class Schedule</a> [--]
	  <a href="registerClasses.php">Register for a Class</a></p>';

	  
	 
//SiteTemplate::courseRegistrationTable($db);		
SiteTemplate::displayClosingTags();


?>
