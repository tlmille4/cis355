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

if (isset($_POST['students']))
{
	$studentID=$_POST['students'];

	$sql = "DELETE FROM students
			WHERE students_id=$studentID";
	mysqli_query($db,$sql);
    $_SESSION['message']="The selected student has been deleted!";
    header('Location: home.php');  //redirect home page
	exit();
}


SiteTemplate::displayHeading();
SiteTemplate::displayUserNavigation();


echo "<div id='welcomeMsg'>Select a student to delete:</div>";

SiteTemplate::dropStudent($db);		
SiteTemplate::displayClosingTags();


?>