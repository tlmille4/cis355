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

		$studID = $_SESSION['gradeID'];
		$courseID = $_POST['courses'];
		$grade = $_POST['grade'];
		

		$db = SiteTemplate::connectDatabase();
		$sql = "UPDATE enrolled_courses SET enrolled_courses_final_grade='$grade' WHERE students_id=$studID AND courses_id=$courseID";
		
		if(mysqli_query($db,$sql))
		{
			//unset($_SESSION['courseID']);
			unset($_SESSION['gradeID']);
			$_SESSION['message']= "Grade has been set for Student ID: $studID<br/>";
			//Redirect to homepage
			header("location:home.php");  //redirect home page
			exit();
		}
		else
			$_SESSION['message']= "Error setting grade for Student ID: $studID<br/>";

						
		SiteTemplate::closeDatabase();
		
		echo $studID ;
		echo $courseID;
		echo $grade;
	
		
	

?>