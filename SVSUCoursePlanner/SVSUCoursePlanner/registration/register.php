<?php
// from: https://www.youtube.com/watch?v=lGYixKGiY7Y

session_start();
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
	
	
     if($password==$password2)
     {      //Create User
            $password=md5($password); //hash password before storing for security purposes
            $sql="INSERT INTO students(students_first_name,students_last_name,students_middle_initial,students_email,students_major,students_active, students_gpa,students_phone,students_standing,students_password) VALUES('$firstname','Miller','L','$email','CS',1,3.5,9892855808,'SR','$password')";
            mysqli_query($db,$sql);  
            $_SESSION['message']="You are now logged in"; 
            $_SESSION['students_email']=$username;
            header("location:home.php");  //redirect home page
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
  <title>Register , login and logout user php mysql</title>
  <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div class="header">
    <h1>Register, login and logout user php mysql</h1>
</div>
<?php
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>
<form method="post" action="register.php">
  <table>
     <tr>
           <td>First Name : </td>
           <td><input type="text" name="students_first_name" class="textInput"></td>
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
           <td></td>
           <td><input type="submit" name="register_btn" class="Register"></td>
     </tr>
  
</table>
</form>
</body>
</html>
