<?php
class SiteTemplate 
{	
	public function displayHeading()
	{
		echo '<!DOCTYPE html><html lang=en><meta charset=utf-8><meta content="IE=edge"http-equiv=X-UA-Compatible><meta content="width=device-width,initial-scale=1"name=viewport><meta content="CSIS Course Planner"name=description><meta content="Tyler Miller"name=author><title>Home - SVSU CS/CIS Course Scheduling</title><link href=favicon.ico rel=icon type=image/x-icon><link href=favicon.ico rel="shortcut icon"type=image/x-icon><link href=css/bootstrap.css rel=stylesheet><link href=css/logo-nav.css rel=stylesheet><link href=css/custom.css rel=stylesheet><!--[if lt IE 9]><script src=https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js></script><script src=https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js></script><![endif]--><nav class="navbar navbar-fixed-top navbar-inverse"role=navigation><div class=container><div class=navbar-header><a href=http://www.svsu.edu class=navbar-brand><img alt="Saginaw Valley State University"src=img/svsuLogo.png></a></div><div class="collapse navbar-collapse"id=bs-example-navbar-collapse-1><ul class="nav navbar-nav"><li><a href=home.php style=color:#fff>Home</a><li><a href=cs.html>CSIS Course Planner</a><li><a href="https://my.svsu.edu/">mySVSU</a></ul></div></div></nav>';
	}
	
	public function displayClosingTags()
	{
		echo '<script src=js/jquery.js></script><script src=js/bootstrap.min.js></script>';
	}
	
	public function displayUserNavigation()
	{
		echo '<p align="center">User Navigation: <span><a href="classes.php">Class Schedule</a></span> &nbsp;|&nbsp;
	  <a href="registerClasses.php">Register for a Class</a>&nbsp;|&nbsp;
	  <a href="editProfile.php">Edit User Profile Info</a>&nbsp;|&nbsp;
	  <a href="createStudent.php">Create a New Student</a>&nbsp;|&nbsp;
	  <a href="viewProfile.php">View Profile</a>&nbsp;|&nbsp;
	  <a href="dropClass.php">Drop a Class</a>&nbsp;|&nbsp;
	  <a href="dropStudent.php">Drop a Student</a>&nbsp;|&nbsp;
	  <a href="logout.php">Logout</a></p><hr>';
	}
	
	public function displayLoginForm()
	{
		echo '<div id="welcomeMsg"><form action=index.php method=post><table><tr><td style="border:hidden;">Username :<td style="border:hidden;"><input class=textInput name=username><tr><td style="border:hidden;">Password :<td style="border:hidden;"><input class=textInput name=password type=password><tr><td style="border:hidden;"><td style="border:hidden;"><input class="In Log"name=login_btn type=submit></table></form></div>'; 
	}
	
	public function validateUser()
	{
		session_start();
		//connect to database
		$db=mysqli_connect("localhost","tlmille4","460207","tlmille4");
		if(isset($_POST['login_btn']))
		{
			//$username=mysql_real_escape_string($_POST['username']);
			//$password=mysql_real_escape_string($_POST['password']);
		
			$username=$_POST['username'];
			$password=$_POST['password'];
		
			$password=md5($password); //Remember we hashed password before storing last time
			$sql="SELECT * FROM students WHERE students_email='$username' AND students_password='$password'";
		
			$result=mysqli_query($db,$sql);
			if(mysqli_num_rows($result)==1)
			{				
				$_SESSION['message']="You are now Logged In";
				$_SESSION['username']=$username;
				
				while($row = mysqli_fetch_assoc($result))
				{
					$_SESSION['student'] = $row['students_id'];
					$_SESSION['first_name']=$row['students_first_name'];
					$_SESSION['last_name']=$row['students_last_name'];
				}
				
				header("location:home.php");
			}
			else
			{
				$_SESSION['message']="Username and Password combiation incorrect";
			}
		}
	}
	
	public function showEnrolledCourses()
	{
		session_start();
		//connect to database
		$db=mysqli_connect("localhost","tlmille4","460207","tlmille4");
		if(isset($_SESSION['username']))
		{
			$id=$_SESSION['student'];
			//$password=$_POST['password'];
			//$password=md5($password); //Remember we hashed password before storing last time
			$sql="SELECT * FROM enrolled_courses WHERE students_id='$id'";
			$result=mysqli_query($db,$sql);
			
			siteTemplate::styleCourseTable();
			
							echo '<div align ="center"><table><tr><th>Course</th><th>Section</th><th>Name</th>
					<th>Meeting Times</th><th>Location</th><th>Available</th>
					<th>Term</th><th>Credits</th></tr>';
			
			while($row = mysqli_fetch_assoc($result))
			{
				//echo $row['enrolled_courses_id'] . " ";
				//echo $row['students_id'] . " ";
				//echo $row['courses_id'] . " ";
				//echo $row['enrolled_courses_final_grade'] . " ";
				$courseID = $row['courses_id']; 
				 
				$sqlCourse="SELECT * FROM courses WHERE courses_id='$courseID'";
				$courseResult=mysqli_query($db,$sqlCourse);
				
				while($course = mysqli_fetch_assoc($courseResult))
				{
					echo '<tr><td>' . $course['courses_prefix'] . $course['courses_number'] . '</td>';
					echo '<td>' . $course['courses_section'] . '</td>';
					echo '<td>' . $course['courses_name'] . '</td>';
					echo '<td>' . $course['courses_meeting_times'] . '</td>';
					echo '<td>' . $course['courses_building'] . $course['courses_room_number'] . '</td>';
					echo '<td>' . $course['courses_available'] . '</td>';
					echo '<td>' . $course['courses_term'] . '</td>';
					echo '<td>' . $course['courses_credits'] . '</td></tr>';
				}
			}
			echo '</table></div>';
		}
	}
	
	public function styleCourseTable()
	{
		echo '<style>
						table, td, th, tr{
							border: 1px solid black;
						}
						
						table {
							border-collapse: collapse;
							width: 80%;
						}
						
						th {
							height: 50px;
						}
						</style>';
	}
	
	public function courseRegistrationTable($db)
	{
		$sql = "SELECT * FROM courses";
		$result = mysqli_query($db,$sql);

		//$crs = mysqli_fetch_array($result);
		while($course = mysqli_fetch_assoc($result))
		{
			$courses[]=$course;
		}
		
		
		//echo "<select name='courses'>";
		//while ($row = mysqli_fetch_assoc($result)) 
		//{
		//	echo $row['courses_number'];
		//	echo "<option value='" . $row['courses_prefix'] . $row['courses_number'] . "'>" . $row['courses_prefix'] . $row['courses_number'] ."</option>";
		//}
		//echo "</select>";
		echo "<div id='welcomeMsg'>";
		echo '<form action="registerCourse.php" method="post">';
		echo "<select name='courses' id='courses'>";
		foreach ($courses as $course)
		{
			print "<option value='" . $course['courses_id'] . "'>" . $course['courses_prefix'] .$course['courses_number'] . $course['courses_name'] . "</option>";
			
		}
		echo "</select>";
		
		
		//echo "Input Course Prefix: ";
		//echo '<input type="text" name="coursePrefix" />';
		//echo "<br/>";
		//echo "Input Course Number: ";
		//echo '<input type="text" name="courseNumber" />';
		echo '<input type="submit" value="Submit"/>';
		echo '</form>'; 
		echo "</div>";
	}
	
	public function registerCourse()
	{
		$number=$_POST['courseNumber'];
		$prefix=$_POST['coursePrefix'];
		
		$sql = "SELECT * FROM courses WHERE courses_prefix='$prefix' AND courses_number='$courseNumber'";
		$result = mysqli_query($db,$sql);
		if ($row = mysqli_fetch_assoc($result) == 1)
		{
			echo $course['courses_prefix'] . $course['courses_number'] . "<br/>";
		}			
		
	}
	
	public function dropStudentCourses($db)
	{
		$studentID = $_SESSION['student'];
		$sql = "SELECT * FROM enrolled_courses
				JOIN courses ON courses.courses_id = enrolled_courses.courses_id
				WHERE enrolled_courses.students_id=$studentID";
		$result = mysqli_query($db,$sql);

		//$crs = mysqli_fetch_array($result);
		while($course = mysqli_fetch_assoc($result))
		{
			$courses[]=$course;
		}
		
		
		
		echo "<div id='welcomeMsg'>";
		echo '<form action="dropClass.php" method="post">';
		echo "<select name='courses' id='courses'>";
		foreach ($courses as $course)
		{
			print "<option value='" . $course['courses_id'] . "'>" . $course['courses_prefix'] .$course['courses_number'] . $course['courses_name'] . "</option>";
			
		}
		echo "</select>";
		
		

		echo '<input type="submit" value="Submit"/>';
		echo '</form>'; 
		echo "</div>";
	}
	
	public function dropStudent($db)
	{
	    $studentID = $_SESSION['student'];
		$sql = "SELECT * FROM students;";
		$result = mysqli_query($db,$sql);

		//$crs = mysqli_fetch_array($result);
		while($student = mysqli_fetch_assoc($result))
		{
			$students[]=$student;
		}
		
		echo "<div id='welcomeMsg'>";
		echo '<form action="dropStudent.php" method="post">';
		echo "<select name='students' id='students'>";
		foreach ($students as $student)
		{
			print "<option value='" . $student['students_id'] . "'>" . $student['students_first_name'] . " " . $student['students_middle_initial'] . " " . $student['students_last_name'] . "</option>";
			
		}
		echo "</select>";
		
		

		echo '<input type="submit" value="Submit"/>';
		echo '</form>'; 
		echo "</div>";
	}
	
}
?>