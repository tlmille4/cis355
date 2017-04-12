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


?>



<!DOCTYPE HTML>
<!--
	Arcana by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Assign Grades - SVSU Course Information</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>
		<div id="page-wrapper">
			
			<!-- Header -->
					<!-- Logo -->
					<!-- Nav -->
				<?php SiteTemplate::loadHeaderNav(4);?>


<?php	echo	'<!-- Highlights -->
				<section class="wrapper style1">
					<div class="container">
					<h2>Set a Grade</h2><br/></br>';

					echo	'<div class="row 200%">
					<section class="10u 12u(narrower)">
								<div class="box highlight">
						

								  <table>
									 <tr>
											
										   <td>Student: </td>';
									echo  '<td>';

					
					
					echo '<td>' . SiteTemplate::dropdownStudent($db, $key) . '</td></tr></table>';
		    		if(isset($_POST['students']))
					{
						echo "<div>";
						$studID = $_POST['students'];
						$_SESSION['gradeID'] = $studID;
						$db = SiteTemplate::connectDatabase();
						$sql = "SELECT * FROM students WHERE students_id=$studID";
						$result = mysqli_query($db,$sql);

						//$crs = mysqli_fetch_array($result);
						while($student = mysqli_fetch_assoc($result))
						{
							$students[]=$student;
						}

						foreach ($students as $student)
						{
							$f = $student['students_first_name'];
							$l = $student['students_last_name'];
							
							$title = "Set Grade for: " . $f . " " . $l;
						}
						
						SiteTemplate::closeDatabase();
				
				
						echo '<form action="applyGrade.php" method="post">';
					
						echo  SiteTemplate::gradeCourseDropdown($studID, $title);

						
						echo "<br/>Grade:<br/><center><input align='center' style='width: 80px;' type='text' name='grade'/></center><br/>";
						echo "<input type='submit' value='Submit'/></form>";
						
						echo '</div>';
						echo '</table>';
						echo '</div>';
						
					}

								
			echo '</div>
					</div>
				</section>';
?>


			<!-- Footer -->
				<div id="footer">
					<div class="container">
						<div class="row">

						</div>
					</div>

					<!-- Icons -->
						<ul class="icons">
							<li><a href="https://twitter.com/svsu?lang=en" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="https://www.facebook.com/svsu.edu/" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="https://github.com/tlmille4/cis355" class="icon fa-github"><span class="label">GitHub</span></a></li>
							<li><a href="https://www.linkedin.com/edu/saginaw-valley-state-university-18625" class="icon fa-linkedin"><span class="label">LinkedIn</span></a></li>
							<li><a href="https://www.instagram.com/svsucardinals/" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						</ul>

					<!-- Copyright -->
						<div class="copyright">
							<ul class="menu">
								<li>&copy; 2017 Saginaw Valley State University. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a> & <a href="http://www.facebook.com/tlmille4">Tyler Miller</a></li>
							</ul>
						</div>

				</div>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>