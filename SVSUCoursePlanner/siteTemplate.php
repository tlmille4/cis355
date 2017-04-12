<?php
class SiteTemplate 
{	
	//Open a connection to the CSIS database
	public function connectDatabase()
	{
		return mysqli_connect("localhost","tlmille4","460207","tlmille4");
	}
	
	//Close the connection to the CSIS database
	public function closeDatabase()
	{
		mysql_close();
	}
	
	//Load student navigation menu
	public function loadStudentMenu($adminCurr)
	{
		if($_SESSION['admin'] == 0)
		{
			echo 	'<li ' . $coursesCurr . '>
						<a href="#">Courses</a>
						<ul>
							<li><a href="classes.php">View My Courses</a></li>
							<li><a href="registerCourse.php">Register for a Course</a></li>
							<li><a href="dropClass.php">Drop a Course</a></li>
						</ul>
					</li>';
		}
		
	}
	
	//Load administrator navigation menu
	public function loadAdminMenu($adminCurr)
	{
		if($_SESSION['admin'] == 1)
		{
			echo '<li ' . $adminCurr . '>
						<a <a style="color:yellow;"href="#">Admin Menu</a>
						<ul>
							<li>
								<a href="#">Courses</a>
								<ul>
									<li><a href="adminCourses.php">View My Courses</a></li>
									<li><a href="createCourse.php">Create a Class</a></li>
									<li><a href="updateCourse.php">Update a Class</a></li>
									<li><a href="adminDeleteClass.php">Delete a Class</a></li>
									<li><a href="allCourses.php">View All Courses</a></li>
								</ul>
							</li>
							
							<li>
							<a href="#">Users/Students</a>
								<ul>
									<li><a href="allStudents.php">View All Users</a></li>
									<li><a href="createStudent.php">Create a User</a></li>
									<li><a href="dropStudent.php">Delete a User</a></li>
								</ul>
							</li>
							<li><a href="setGrade.php">Set Grades</a></li>
						</ul>
					</li>';
		}
		
	}
	
	//Load header navigation, use number guide to correctly show which is the correct page being displayed
	public function loadHeaderNav($key)
	{
		$curr = 'li class="current"';
		switch($key)
		{
			case 1:
				$indexCurr = $curr;
				break;
			case 2:
				$profileCurr = $curr;
				break;
			case 3:
				$coursesCurr = $curr;
				break;
			case 4:
				$adminCurr = $curr;
				break;
			default:
				$indexCurr = $curr;
		}
		
		echo	'<!-- Header -->
				<div id="header">
					<!-- Logo -->
					<!-- Nav -->
						<nav id="nav">
						<img style="padding-top: 10px;" alt="Saginaw Valley State University"src=images/svsuLogo.png>
							<ul>
								<li ' . $indexCurr . '><a href="index.php">Home</a></li>
								<li ' . $profileCurr . '>
									<a href="#">Profile Settings</a>
									<ul>
										<li><a href="viewProfile.php">View Profile</a></li>
										<li><a href="editProfile.php">Edit Profile</a></li>
										<li><a href="resetPassword.php">Change Password</a></li>
									</ul>
								</li>';
								SiteTemplate::loadStudentMenu($adminCurr);
								echo '<li><a href="http://my.svsu.edu">mySVSU</a></li>
								<li><a href="http://svsu.instructure.com">Canvas</a></li>';
								SiteTemplate::loadAdminMenu($adminCurr);
			echo '<li><a style="color:red;" href="logout.php">Logout</a></li>
							</ul>
						</nav>
				</div>';
	}
	
	//Get GPA and set it via letter grade
	public function getGPA($currGPA, $inGrade)
	{
		switch ($inGrade) 
		{
			case "A":
				$gpa = 4.0;
				break;
			case "A-":
				$gpa = 3.67;
				break;
			case "B+":
				$gpa = 3.33;
				break;
			case "B":
				$gpa = 3.00;
				break;
			case "B-":
				$gpa = 2.67;
				break;
			case "C+":
				$gpa = 2.33;
				break;
			case "C":
				$gpa = 2.0;
				break;
			case "C-":
				$gpa = 1.67;
				break;
			case "D+":
				$gpa = 1.33;
				break;
			case "D":
				$gpa = 1.0;
				break;
			case "D-":
				$gpa = 0.67;
				break;	
			default:
				$gpa = 0;
		}
		
		return (($currGPA + $gpa) / 2);
	}
	
	//Code used to display HTML login form 
	public function displayLoginForm()
	{
		echo '<form action=index.php method=post><table><tr><td>Username :</td><td><input type=text name=username></td></tr><tr><td>Password :</td><td><input class=textInput name=password type=password></td></tr><br/></table><input value="Log In" name=login_btn type=submit></form>'; 
	}
	
	
	//Used when user logs in -- validates username and password with that stored in DB, then retrieves relevent info and logs the student into their home page
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
					$_SESSION['major']=$row['students_major'];
					$picture = $row['students_image'];
					$_SESSION['image'] = "<img height='auto' width='50%' src='data:image/jpeg;base64," . base64_encode($picture) . "'>";
					$_SESSION['admin'] = $row['students_isadmin'];
					$_SESSION['gpa'] = $row['students_gpa'];
				}
				
				header("location:home.php");
			}
			else
			{
				$_SESSION['message']="Username and Password combiation incorrect";
			}
		}
	}
	
	//Function used to display the welcome greeting based on time of day
	public function getGreeting()
	{
		 $time = date("H");
		/* Set the $timezone variable to become the current timezone */
		$timezone = date("e");
		/* If the time is less than 1200 hours, show good morning */
		if ($time < "12") {
			return "Good Morning, ";
		} else
		/* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
		if ($time >= "12" && $time < "17") {
			return "Good Afternoon, ";
		} else
		/* Should the time be between or equal to 1700 and 1900 hours, show good evening */
		if ($time >= "17" && $time < "19") {
			return "Good Evening, ";
		} else
		/* Finally, show good night if the time is greater than or equal to 1900 hours */
		if ($time >= "19") {
			return "Good Night, ";	
		}
	}
	
	//Connect to DB and show all enrolled coruses for a user and display via HTML table
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
			
			echo '<div align ="center"><table><tr><th>Grade</th><th>Course</th><th>Section</th><th>Name</th><th>Instructor</th>
					<th>Meeting Times</th><th>Location</th><th>Available</th>
					<th>Term</th><th>Credits</th></tr>';
			
			while($row = mysqli_fetch_assoc($result))
			{
				//echo $row['enrolled_courses_id'] . " ";
				//echo $row['students_id'] . " ";
				//echo $row['courses_id'] . " ";
				//echo $row['enrolled_courses_final_grade'] . " ";
				$courseID = $row['courses_id'];
				$grade = $row['enrolled_courses_final_grade'];
				 
				$sqlCourse="SELECT * FROM courses WHERE courses_id='$courseID'";
				$courseResult=mysqli_query($db,$sqlCourse);
				
				while($course = mysqli_fetch_assoc($courseResult))
				{
					echo '<tr align="center"><td>' . $grade . '</td><td><a href="classInfo.php?id=' . $courseID . '">' . $course['courses_prefix'] . $course['courses_number'] . '</a></td>';
					echo '<td>' . $course['courses_section'] . '</td>';
					echo '<td>' . $course['courses_name'] . '</td>';
					
					echo '<td><a href="viewProfile.php?id=' . $course['instructors_id'] . '">' . SiteTemplate::getInstructor($db,$course['instructors_id']) . '</td>';
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
	
	//Function used to get all instructors, used when creating/updating courses
	public function getInstructor($db, $id)
	{
		$sql = "SELECT * FROM students WHERE students_id='$id'";
		$result = mysqli_query($db,$sql);
		while($instructor = mysqli_fetch_assoc($result))
		{
			$name = $instructor['students_first_name'] . " " . $instructor['students_last_name'];
		}
		return $name;
	}
	
	//Connect to DB to get all instructor names into dropdown menu
	public function instructorDropdown($selected)
	{
		$db = SiteTemplate::connectDatabase();
		//$studentID = $_SESSION['student'];
		$sql = "SELECT * FROM students
				WHERE students_isadmin=1";
		$result = mysqli_query($db,$sql);

		//get all records into array
		while($admin = mysqli_fetch_assoc($result))
		{
			$admins[]=$admin;
		}
		
		
		echo '<form action="dropClass.php" method="post">';
		echo "<select name='admin' id='admin'>";
		foreach ($admins as $admin)
		{
			if($selected == $admin['students_id'])
				$showSelect = ' selected="selected"';
			else
				$showSelect = "";
			print "<option value='" . $admin['students_id'] ."'" . $showSelect . ">" . $admin['students_last_name'] . ', ' . $admin['students_first_name'] . "</option>";
			
		}
		echo "</select>";
		
		echo '</form>'; 
		
		SiteTemplate::closeDatabase();
		
	}
	
	//Connect to DB to get all instructor names into dropdown menu
	public function instructorDropdownUpdate($selected)
	{
		$db = SiteTemplate::connectDatabase();
		//$studentID = $_SESSION['student'];
		$sql = "SELECT * FROM students
				WHERE students_isadmin=1";
		$result = mysqli_query($db,$sql);

		//get all records into array
		while($admin = mysqli_fetch_assoc($result))
		{
			$admins[]=$admin;
		}
		

		foreach ($admins as $admin)
		{
			if($selected == $admin['students_id'])
				$showSelect = ' selected="selected"';
			else
				$showSelect = "";
			print "<option value='" . $admin['students_id'] ."'" . $showSelect . ">" . $admin['students_last_name'] . ', ' . $admin['students_first_name'] . "</option>";
			
		}

		SiteTemplate::closeDatabase();
		
	}
	
	//Function used to update a course in the database
	public function updateCourse($courseID, $instructorID,$section,$prefix,$courseNumber,$courseName,$meetingTimes,$buildingCode,$roomNumber,$occRate,$term,$credits)
	{
		$db = SiteTemplate::connectDatabase();
		$sql="SELECT * FROM courses WHERE courses_id='$courseID'";
		$result = mysqli_query($db,$sql);
	
	
		if(mysqli_num_rows($result)==1)
		{
				
			$sql="UPDATE courses SET instructors_id='$instructorID',courses_section='$section', courses_prefix='$prefix', courses_number=$courseNumber, courses_name='$courseName', courses_meeting_times='$meetingTimes', courses_building='$buildingCode', courses_room_number='$roomNumber',courses_available=$occRate, courses_term='$term', courses_credits=$credits WHERE courses_id=$courseID";
			
			$crs = $_SESSION['courseID'];
			if(mysqli_query($db,$sql))
				$_SESSION['message']="$courseName has been updated";
			else
				$_SESSION['message']="Error updating $courseName. Please check for proper inputs $instructorID";
		}
		else
			$_SESSION['message']="Error";
		SiteTemplate::closeDatabase();
	}
	
	//Function used to insert course into database
	public function insertCourse($instructorID,$section,$prefix,$courseNumber,$courseName,$meetingTimes,$buildingCode,$roomNumber,$occRate,$term,$credits)
	{
		$db = SiteTemplate::connectDatabase();
		$sql="SELECT * FROM courses WHERE courses_prefix='$prefix' AND courses_number='$courseNumber' AND courses_section='$section'";
		$result = mysqli_query($db,$sql);
	
	
		if(mysqli_num_rows($result)==0)
		{
				
			$sql="INSERT INTO courses(instructors_id, courses_section, courses_prefix, courses_number, courses_name, courses_meeting_times, courses_building, courses_room_number,courses_available, courses_term, courses_credits) VALUES('$instructorID','$section','$prefix','$courseNumber','$courseName','$meetingTimes','$buildingCode','$roomNumber','$occRate', '$term' ,'$credits')";
			
			
			if(mysqli_query($db,$sql))
				$_SESSION['message']="$courseName has been created";
			else
				$_SESSION['message']="Error creating $courseName. Please check for proper inputs";
		}
		else
			$_SESSION['message']="Error creating $courseName. Course Already Exists!";
		SiteTemplate::closeDatabase();
	}
	
	//Function used to show all available courses or all courses if admin, and displays them via HTML table
	public function showAllCourses($admin)
	{
					$db=mysqli_connect("localhost","tlmille4","460207","tlmille4");
					siteTemplate::styleCourseTable();
			
					echo '<div align ="center"><table><tr><th>Course</th><th>Section</th><th>Name</th><th>Instructor</th>
					<th>Meeting Times</th><th>Location</th><th>Available</th>
					<th>Term</th><th>Credits</th></tr>';
					
				 //Showing only available courses to student
				$sqlCourse="SELECT * FROM courses WHERE courses_available != 0";
				
				//Showing ALL courses to admin
				if($_SESSION['admin'] == 1)
				{
					if($admin == $_SESSION['student'])
						$sqlCourse="SELECT * FROM courses WHERE instructors_id = $admin";
					else
						$sqlCourse="SELECT * FROM courses";
					
				}
				
				$courseResult=mysqli_query($db,$sqlCourse);
				
				while($course = mysqli_fetch_assoc($courseResult))
				{
					$courseID = $course['courses_id'];
					echo '<tr><td><a href="classInfo.php?id=' . $courseID . '">' . $course['courses_prefix'] . $course['courses_number'] . '</a></td>';
					echo '<td>' . $course['courses_section'] . '</td>';
					echo '<td>' . $course['courses_name'] . '</td>';
					echo '<td><a href="viewProfile.php?id=' . $course['instructors_id'] . '">' . SiteTemplate::getInstructor($db,$course['instructors_id']) . '</td>';
					echo '<td>' . $course['courses_meeting_times'] . '</td>';
					echo '<td>' . $course['courses_building'] . $course['courses_room_number'] . '</td>';
					echo '<td>' . $course['courses_available'] . '</td>';
					echo '<td>' . $course['courses_term'] . '</td>';
					echo '<td>' . $course['courses_credits'] . '</td></tr>';
				}
			
			echo '</table></div>';
			SiteTemplate::closeDatabase();
	}
	
	//Function that holds the CSS style tag info for the HTML tables
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
	
	//Show course registration dropdown menu via DB courses
	public function courseRegistrationTable()
	{
		$db = SiteTemplate::connectDatabase();
		$sql = "SELECT * FROM courses WHERE courses_available != 0";
		$result = mysqli_query($db,$sql);

		//$crs = mysqli_fetch_array($result);
		while($course = mysqli_fetch_assoc($result))
		{
			$courses[]=$course;
		}
		
		echo '<form action="registerCourse.php" method="post">';
		echo "<select name='courses' id='courses'>";
		foreach ($courses as $course)
		{
			print "<option value='" . $course['courses_id'] . "'>" .  $course['courses_prefix'] . $course['courses_number'] . " [" .$course['courses_section'] . "]  " . $course['courses_name'] . "</option>";
			
		}
		echo "</select>";

		echo '<input type="submit" name="Submit" value="Submit"/>';
		echo '</form>'; 
		SiteTemplate::closeDatabase();
	}
	
	
	public function editCourseDropdown()
	{
		$db = SiteTemplate::connectDatabase();
		$sql = "SELECT * FROM courses";
		$result = mysqli_query($db,$sql);

		//$crs = mysqli_fetch_array($result);
		while($course = mysqli_fetch_assoc($result))
		{
			$courses[]=$course;
		}
		
		echo '<form action="updateCourse.php" method="post">';
		echo "<select name='courses' id='courses'>";
		foreach ($courses as $course)
		{
			print "<option value='" . $course['courses_id'] . "'>" .  $course['courses_prefix'] . $course['courses_number'] . " [" .$course['courses_section'] . "]  " . $course['courses_name'] . "</option>";
			
		}
		echo "</select>";

		echo '<input value="Select" type="submit" name="Submit" value="Submit"/>';
		echo '</form>'; 
		SiteTemplate::closeDatabase();
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
	
	//Function used to get drop student courses dropdown menu
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
			print "<option value='" . $course['courses_id'] . "'>" .  $course['courses_prefix'] . $course['courses_number'] . " [" .$course['courses_section'] . "]  " . $course['courses_name'] . "</option>";
			
		}
		echo "</select>";
		
		

		echo '<input type="submit" value="Submit"/>';
		echo '</form>'; 
		echo "</div>";
	}
	
	//Function used to delete courses and show the delete course dropdown
	public function deleteCourseDropdown()
	{
		$db = SiteTemplate::connectDatabase();
		$studentID = $_SESSION['student'];
		$sql = "SELECT * FROM courses";
		$result = mysqli_query($db,$sql);

		//$crs = mysqli_fetch_array($result);
		while($course = mysqli_fetch_assoc($result))
		{
			$courses[]=$course;
		}
		
		echo '<form action="adminDeleteClass.php" method="post">';
		echo "<select name='courses' id='courses'>";
		foreach ($courses as $course)
		{
			print "<option value='" . $course['courses_id'] . "'>" .  $course['courses_prefix'] . $course['courses_number'] . " [" .$course['courses_section'] . "]  " . $course['courses_name'] . "</option>";
			
		}
		echo "</select>";
		
		

		echo '<input type="submit" value="Submit"/>';
		echo '</form>'; 
		SiteTemplate::closeDatabase();
	}
	
	//Function used to show grade/course dropdown menu
	public function gradeCourseDropdown($studID, $title)
	{
		$db = SiteTemplate::connectDatabase();
		
		$sql = "SELECT * FROM (enrolled_courses as e JOIN courses as c ON e.courses_id=c.courses_id) WHERE e.students_id=$studID";
		$result = mysqli_query($db,$sql);

		while($course = mysqli_fetch_assoc($result))
		{
			$courses[]=$course;
		}
		//echo '<td>';
		echo '<div>';
		echo $title . "<br/>";
		echo "<select name='courses' id='courses'>";
		foreach ($courses as $course)
		{
			print "<option value='" . $course['courses_id'] . "'>" .  $course['courses_prefix'] . $course['courses_number'] . " [" .$course['courses_section'] . "]  " . $course['courses_name'] . "</option>";
			
		}
		echo "</select>";
		
		SiteTemplate::closeDatabase();
	}
	
	//Used to display all students via HTML table
	public function displayAllStudents($key)
	{
		$db=SiteTemplate::connectDatabase();
		if($key == ALL)
			$sql="SELECT * FROM students";
		else
			$sql=$key;
		
		$result=mysqli_query($db,$sql);
		while($student = mysqli_fetch_assoc($result))
		{
			$students[]=$student;
		}
		siteTemplate::styleCourseTable();
		echo '<div align ="center"><table><tr><th>First Name</th><th>Last Name</th><th>Major</th><th>Profile</th></tr>';
		foreach ($students as $student)
		{
					$id = $student['students_id'];
					echo '<tr><td>' . $student['students_first_name'] . '</td>';
					echo '<td>' . $student['students_last_name'] . '</td>';
					echo '<td>' . $student['students_major'] . '</td>';
					echo '<td>' . '<a href="viewProfile.php?id=' . $id . '">View Profile</a>' . '</td></tr>';					
		}
		echo '</table></div>';
		SiteTemplate::closeDatabase();
	}
	
	//Function used to show drop student dropdown menu
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
			if(!($student['students_id'] == $studentID))
				print "<option value='" . $student['students_id'] . "'>" . $student['students_first_name'] . " " . $student['students_middle_initial'] . " " . $student['students_last_name'] . "</option>";
			
		}
		echo "</select>";
		
		

		echo '<input type="submit" value="Submit"/>';
		echo '</form>'; 
		echo "</div>";
	}
	
	//Used to show students for setgrade php page
	public function dropdownStudent($db, $key)
	{ 
		$db = SiteTemplate::connectDatabase();
	   
		$sql = "SELECT * FROM students;";
		$result = mysqli_query($db,$sql);

		//$crs = mysqli_fetch_array($result);
		while($student = mysqli_fetch_assoc($result))
		{
			$students[]=$student;
		}
		
		echo "<form action='setGrade.php' method='post'>";
		echo "<select name='students' id='students'>";
		foreach ($students as $student)
		{	
			print "<option value='" . $student['students_id'] . "'>" . $student['students_first_name'] . " " . $student['students_middle_initial'] . " " . $student['students_last_name'] . "</option>";
			
		}
		echo "</select>";
		
		

		echo "<input type='submit' style='padding: 0px 0px;' value='Select'/>";
		echo "</form>"; 
		SiteTemplate::closeDatabase();
	}
	
	//Used to get image
	public function getUserImage()
	{
		require 'database.php';
		
		$id = $_SESSION['student'];
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM students where students_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$picture = $data['students_image'];
		$image = "<img height='auto' width='50%' src='data:image/jpeg;base64," . base64_encode($picture) . "'>";
		Database::disconnect();
		return $image;
	}
	
}
?>