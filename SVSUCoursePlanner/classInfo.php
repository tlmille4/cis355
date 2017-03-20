<?php 
session_start(); //required for every PHP file
//if userid is not set, call login function
if(!isset($_SESSION['username']))
{
	echo "YOU MUST BE LOGGED IN TO SEE THIS PAGE";
	$_SESSION['message']= "You must be logged in to continue<br/>";
	header('Location: index.php'); 
	exit();
}


include 'siteTemplate.php';
 

if(isset($_GET['id']))
{
	$courseID = $_GET['id'];
	$db = SiteTemplate::connectDatabase();
	//$db=mysqli_connect("localhost","tlmille4","460207","tlmille4");
	
	$sql = "SELECT courses_prefix, courses_number FROM courses WHERE courses_id=$courseID;";
	$result=mysqli_query($db,$sql);
	$row=mysqli_fetch_array($result);
	SiteTemplate::displayHeading();
	echo "<h2>" . $row['courses_prefix'] . $row['courses_number'] . " Class List </h2><br/>";
	
	
	$sql = "SELECT * FROM students WHERE students_id IN 
			(SELECT students_id FROM enrolled_courses WHERE courses_id=$courseID);";
	SiteTemplate::displayAllStudents($db, $sql);		
	//$result=mysqli_query($db,$sql);
	//while($row = mysqli_fetch_assoc($result))
	//{
	//	echo $row['students_id'];
	//	echo $row['students_first_name'] . " ";
	//	echo $row['students_last_name'];
	//	echo $row['courses_id'];
    //
	//	echo "<br/>";
    //
	//}
	
	
	echo $_GET['id'];
	SiteTemplate::closeDatabase();
}

	//include 'siteTemplate.php';
	
	//SiteTemplate::displayHeading();
	//SiteTemplate::displayClosingTags();


?>
