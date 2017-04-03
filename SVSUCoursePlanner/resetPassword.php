<?php

session_start();
require 'siteTemplate.php';
SiteTemplate::displayHeading();
SiteTemplate::displayUserNavigation();
//connect to database
$db=mysqli_connect("localhost","tlmille4","460207","tlmille4");
if(isset($_POST['register_btn']))
{
	$studentID = $_SESSION['student'];
	$sql = "SELECT students_password FROM students WHERE students_id=$studentID";
	$result=mysqli_query($db,$sql);
	$student=mysqli_fetch_assoc($result);
	//while($stud = mysqli_fetch_assoc($result))
	//{
	//	$courses[]=$course;
	//}
	
	print_r($student);
	$currentPassword=$student['students_password'];
    $password=$_POST['students_password'];
    $password2=$_POST['students_password2'];
	echo $password2;
	
	$password = md5($password);
	echo $password;
     if($password==$currentPassword)
     {      //Create User
            $password2=md5($password2); //hash password before storing for security purposes
            $sql = "UPDATE students SET students_password='$password2' WHERE students_id=$studentID";
            mysqli_query($db,$sql);  
            $_SESSION['message']="User password has been changed!";
            header("location:home.php");  //redirect home page
			exit();
    }
    else
    {
      $_SESSION['message']="Incorrect current password!";   
     }
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Register Student</title>
  <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div class="header">
    <h1>Change your Password</h1>
</div>
<?php
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>
<div id="welcomeMsg">
<form method="post" action="resetPassword.php">
  <table>

      <tr>
           <td>Current Password : </td>
           <td><input type="password" name="students_password" class="textInput"></td>
     </tr>
      <tr>
           <td>New Password: </td>
           <td><input type="password" name="students_password2" class="textInput"></td>
     </tr>
	 <tr>
           <td></td>
           <td><input type="submit" name="register_btn" class="Register"></td>
     </tr>
</table>
</form>
</div>
<?php SiteTemplate::displayClosingTags();?>
</body>
</html>
