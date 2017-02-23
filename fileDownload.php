<?php
	//Connecting to database
	$con = mysql_connect('localhost', 'tlmille4', '460207') or die(mysql_error());
	$db = mysql_select_db('tlmille4', $con);

	//if connection successful, insert the contents into the BLOB (Binary large object) field of database. 
	if($db)
	{
		//$id is the value of the id field in the table that contains the uploaded file
		if(isset($_POST['img_id'])) 
		{
			$id = $_POST['img_id'];
		}
		else
			$id = 1; //initializing to something
		
		//get all of the info from the uploads file
		$query = "SELECT id, name, size, type FROM uploads";
		$result = mysql_query($query);
		
		//display list
		while ($row = mysql_fetch_assoc($result))
		{
			echo "<p>" . $row['id'] . " " . $row['name'] . " " . $row['size'] . " " . $row['type'] . "</p>";
		}
		
		//display form to user
		echo "<form method='post' action='fileDownload.php'>";
		echo "<br/>Type in an image ID number: <br/>";
		echo "<input type='text' name='img_id'/>";
		echo "<input type='submit' value='Submit'/>";
		echo "</form>";
		
		$query = "SELECT id, name, size, type, content FROM uploads WHERE id=$id";
		$result = mysql_query($query);
		
		$content = mysql_result($result, 0, "content");
		
		echo "<img height='auto' width='50%' src='data:image/jpeg;base64," . base64_encode($content) . "'>";	
	}
	else
		echo "Connection Not Successful";

?>