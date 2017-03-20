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
$sql="SELECT * FROM students";



SiteTemplate::displayHeading();
SiteTemplate::displayUserNavigation();
echo '<center><p><b>All Students Currently in System</b></p></center>';
$key = ALL;
SiteTemplate::displayAllStudents($db, $key);

 if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
		 
		 echo "<div id='welcomeMsg'><h1>Welcome, " . $_SESSION['first_name'] . "!</h4></div>";
		 
    }
	echo '<center><a href="logout.php">Logout</a></center>';


		
SiteTemplate::displayClosingTags();


?>
