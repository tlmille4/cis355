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
	echo '<center><a href="logout.php">Logout</a></center>';
	echo '<center><img src="http://www.mix1063fm.com/wp-content/uploads/2016/08/SVSU-entrance-640x249.png" alt="SVSU"/></center>';
	echo "<div id='welcomeMsg'>TESTING THIS STUFF</div>";
		echo $_SESSION['username'];
		echo $_SESSION['student'];

		
SiteTemplate::displayClosingTags();


?>
