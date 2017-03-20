<?php
session_start();
//connect to database
$db=mysqli_connect("localhost","tlmille4","460207","tlmille4");
include 'siteTemplate.php';

if(!isset($_SESSION['username']))
{
	echo "YOU MUST BE LOGGED IN TO SEE THIS PAGE";
	$_SESSION['message']= "<b>You must be logged in to continue</b><br/>";
	header('Location: index.php'); 
	exit();
}

if (isset($_POST['courses']))
{

	$removeCourse=$_POST['courses'];
	$studentID=$_SESSION['student'];
	$sql = "DELETE FROM enrolled_courses
			WHERE courses_id=$removeCourse AND students_id=$studentID";
	mysqli_query($db,$sql);
    $_SESSION['message']="The selected class has been dropped!";
    header('Location: home.php');  //redirect home page
	exit();
}


SiteTemplate::displayHeading();
SiteTemplate::displayUserNavigation();

echo "<div id='center'>Select a course to drop: <br/>";

SiteTemplate::dropStudentCourses($db);	
echo "<br/><br/>";
SiteTemplate::showEnrolledCourses();
echo "</div>";
SiteTemplate::displayClosingTags();


?>