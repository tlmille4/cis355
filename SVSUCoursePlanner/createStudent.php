<?php
// from: https://www.youtube.com/watch?v=lGYixKGiY7Y

session_start();
require 'siteTemplate.php';
SiteTemplate::displayHeading();
SiteTemplate::displayUserNavigation();
//connect to database
$db=mysqli_connect("localhost","tlmille4","460207","tlmille4");
if(isset($_POST['register_btn']))
{
    //$username=mysql_real_escape_string($_POST['username']);
    //$email=mysql_real_escape_string($_POST['email']);
    //$password=mysql_real_escape_string($_POST['password']);
    //$password2=mysql_real_escape_string($_POST['password2']);  
	
	$firstname=$_POST['students_first_name'];
    $email=$_POST['students_email'];
    $password=$_POST['students_password'];
    $password2=$_POST['students_password2'];
	$lastname=$_POST['students_last_name'];
	$major=$_POST['students_major'];
	$middleinitial=$_POST['students_middle_initial'];
	$gpa=$_POST['students_gpa'];
	$phone=$_POST['students_phone'];
	$standing=$_POST['students_standing'];
	
	
     if($password==$password2)
     {      //Create User
            $password=md5($password); //hash password before storing for security purposes
            $sql="INSERT INTO students(students_first_name,students_last_name,students_middle_initial,students_email,students_major,students_active, students_gpa,students_phone,students_standing,students_password) VALUES('$firstname','$lastname','$middleinitial','$email','$major',1,$gpa,$phone,'$standing','$password')";
            mysqli_query($db,$sql);  
            $_SESSION['message']="User $firstname $lastname has been created!";
            header("location:home.php");  //redirect home page
			exit();
    }
    else
    {
      $_SESSION['message']="The two password do not match";   
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
    <h1>Register a New Student</h1>
</div>
<?php
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>
<div id="welcomeMsg">
<form method="post" action="createStudent.php">
  <table>
     <tr>
           <td>First Name : </td>
           <td><input type="text" name="students_first_name" class="textInput"></td>
     </tr>
	 <tr>
           <td>Middle Initial : </td>
           <td><input type="text" name="students_middle_initial" class="textInput"></td>
     </tr>
	 <tr>
           <td>Last Name : </td>
           <td><input type="text" name="students_last_name" class="textInput"></td>
     </tr>
     <tr>
           <td>Email : </td>
           <td><input type="email" name="students_email" class="textInput"></td>
     </tr>
      <tr>
           <td>Password : </td>
           <td><input type="password" name="students_password" class="textInput"></td>
     </tr>
      <tr>
           <td>Password again: </td>
           <td><input type="password" name="students_password2" class="textInput"></td>
     </tr>
	 <tr>
           <td>Current GPA: </td>
           <td><input type="text" name="students_gpa" class="textInput"></td>
     </tr>
	 <tr>
           <td>Major: </td>
           <td><input type="text" name="students_major" class="textInput"></td>
     </tr>
	       <tr>
           <td>Phone: </td>
           <td><input type="text" name="students_phone" class="textInput"></td>
     </tr>
	       <tr>
           <td>Standing: </td>
           <td><input type="text" name="students_standing" class="textInput"></td>
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
