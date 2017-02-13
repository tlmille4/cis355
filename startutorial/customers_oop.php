<?php
class Customers 
{
	public function displayListTableContents()
	{
		$pdo = Database::connect();
		$sql = 'SELECT * FROM customers ORDER BY id DESC';
		
		foreach ($pdo->query($sql) as $row) 
		{
			echo '<tr>';
			echo '<td>'. $row['name'] . '</td>';
			echo '<td>'. $row['email'] . '</td>';
			echo '<td>'. $row['mobile'] . '</td>';
			echo '<td width=250>';
			echo '<a class="btn" href="read.php?id='.$row['id'].'">Read</a>';
			echo '&nbsp;';
			echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>';
			echo '&nbsp;';
			echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
			echo '</td>';
			echo '</tr>';
		}
		Database::disconnect();
	}
	
	public function displayListHeading()
	{
		//Used Minifyer
		echo '<body><p align="center"><a href="events.php">Click here</a> to go to the \'Events\' Star Tutorial</p><div class="container"> <div class="row"> <h3>Customers</h3> </div><div class="row"><p><a href="create.php" class="btn btn-success">Create</a><a href="logout.php" class="btn btn-danger">Logout</a></p></div><table class="table table-striped table-bordered"> <thead> <tr> <th>Name</th> <th>Email Address</th> <th>Mobile Number</th> <th>Action</th> </tr></thead> <tbody>';
	}
	
	public function importBootstrap()
	{
		//Used Minifyer
		echo '<!DOCTYPE html><html lang="en"><head> <meta charset="utf-8"> <link href="css/bootstrap.min.css" rel="stylesheet"> <script src="js/bootstrap.min.js"></script></head>';
	}
	
	public function displayListFooting()
	{
		//Used Minifyer
		echo '</tbody></table></div></div></body></html>';
	}
	
	public function displayListScreen()
	{
		Customers::importBootstrap();
		Customers::displayListHeading();
		Customers::displayListTableContents();
		Customers::displayListFooting();
		//Database::disconnect();
	}
}
?>