<?php	
session_start(); //required for every PHP file
include 'siteTemplate.php';

//if userid is not set, call login function

if(!isset($_SESSION['username']))
{
	echo "YOU MUST BE LOGGED IN TO SEE THIS PAGE";
	$_SESSION['message']= "You must be logged in to continue<br/>";
	header('Location: index.php'); 
	exit();
	
}
		$currGPA = $_SESSION['gpa'];
		$studID = $_SESSION['gradeID'];
		$courseID = $_POST['courses'];
		$grade = $_POST['grade'];
		
		$numGPA = SiteTemplate::getGPA($currGPA, $grade);

		$db = SiteTemplate::connectDatabase();
		$sql = "UPDATE enrolled_courses SET enrolled_courses_final_grade='$grade' WHERE students_id=$studID AND courses_id=$courseID";
		
		if(mysqli_query($db,$sql))
		{

			
			$_SESSION['message']= "Grade has been set for Student ID: $studID<br/>";

		}
		else
			$_SESSION['message']= "Error setting grade for Student ID: $studID<br/>";
		
		$sql = "UPDATE students SET students_gpa='$numGPA' WHERE students_id=$studID";
		
		if(mysqli_query($db,$sql))
		{
			unset($_SESSION['courseID']);
			$_SESSION['gpa'] = $numGPA;
			unset($_SESSION['gradeID']);


		}
		else
			$_SESSION['message']= "Error setting grade for Student ID: $studID<br/>";

						
		SiteTemplate::closeDatabase();
		
			header("location:home.php");  //redirect home page
			exit();
		
	

?>