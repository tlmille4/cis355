<?php
	//print_r($_FILES);
	
	//require('startutorial/database.php');

	
	session_start();
	require 'database.php';
	require 'siteTemplate.php';


	SiteTemplate::displayHeading();
	SiteTemplate::displayUserNavigation();
	
	$id = $_SESSION['student'];;
	//ensuring PHP allows uploads
	ini_set('file-uploads', true);
	
	if ($_FILES['file1']['size'] > 0 && $_FILES['file1']['size'] < 2000000)
	{
		//Variables for the $_FILES elements
		$filename = $_FILES['file1']['name'];
		$tempname = $_FILES['file1']['tmp_name'];
		$filesize = $_FILES['file1']['size'];
		$filetype = $_FILES['file1']['type'];
		$filetype_show = $_FILES['file1']['type'];
		
		$filetype = (get_magic_quotes_gpc() == 0
			? mysql_real_escape_string($filetype)
			: mysql_real_escape_string(stripslashes($_FILES['file1'])));
		
		//open the file that was uploaded	
		$fp = fopen($tempname, 'r');
		$content = fread($fp, filesize($tempname));
		$content = addslashes($content);
		
		//display the properties of the file that is to be uploaded
		echo 'filename: ' . $filename . '<br/>';
		echo 'filesize: ' . $filesize . '<br/>';
		echo 'filetype: ' . $filetype_show . '<br/>';
		
		//close file
		fclose($fp);
		
		if(!get_magic_quotes_gpc())
		{
			$filename = addslashes($filename);	
		}
		
		//Connecting to database
		$con = mysql_connect('localhost', 'tlmille4', '460207') or die(mysql_error());
		$db = mysql_select_db('tlmille4', $con);
		
		//if connection successful, insert the contents into the BLOB (Binary large object) field of database. 
		if($db)
		{
			$query = "UPDATE students SET students_image='$content' WHERE students_id=$id";
			mysql_query($query) or die('Query failed');
			mysql_close();
			
			$_SESSION['image'] = "<img height='auto' width='50%' src='data:image/jpeg;base64," . base64_encode($content) . "'>";
			echo "Upload successful";
			echo '<br/><a href="home.php">Upload More Files</a>';
		}
		else
			echo "Upload failed. " . mysql_error();		
	}

?>