<?php
session_start();
 
//connect to database
$db=mysqli_connect("localhost","tlmille4","460207","tlmille4");
include 'siteTemplate.php';

SiteTemplate::displayHeading();
 if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
		 
		 echo "<div><h1>Welcome " . $_SESSION['username'] . "!</h4></div>";
		 echo '<a href="logout.php">Logout</a>';
    }
	
			echo $_SESSION['username'];
		echo $_SESSION['students_id'];
		echo "SHITE";
		
SiteTemplate::displayClosingTags();
?>
<!-- <!DOCTYPE html>
<html>
<head>
  <title>Register , login and logout user php mysql</title>
  <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div class="header">
    <h1>Register, login and logout user php mysql</h1>
</div>

    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>
<h1>Home</h1>
<div>
    <h4>Welcome <?php echo $_SESSION['username']; ?></h4></div>
</div>
<a href="logout.php">Log Out</a>
</body>
</html>
--!>