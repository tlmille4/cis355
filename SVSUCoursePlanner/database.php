<?php
/**************************************************************************
*filename: database.php
*author:   Tyler Miller
*description: This PHP file contains database connection functions
**************************************************************************/  
class Database 
{
	private static $dbName = 'tlmille4' ; 
	private static $dbHost = 'localhost' ;
	private static $dbUsername = 'tlmille4';
	private static $dbUserPassword = '460207';
	
	private static $cont  = null;
	
	public function __construct() {
		exit('Init function is not allowed');
	}
	
	public static function connect()
	{
	   // One connection through whole application
       if ( null == self::$cont )
       {      
        try 
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);  
        }
        catch(PDOException $e) 
        {
          die($e->getMessage());  
        }
       } 
       return self::$cont;
	}
	
	public static function disconnect()
	{
		self::$cont = null;
	}
	
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
		Database::importBootstrap();
		Database::displayListHeading();
		Database::displayListTableContents();
		Database::displayListFooting();
		Database::disconnect();
	}
	
	public function displayHeading()
	{
		echo '<!DOCTYPE html><html lang=en><meta charset=utf-8><meta content="IE=edge"http-equiv=X-UA-Compatible><meta content="width=device-width,initial-scale=1"name=viewport><meta content="CSIS Course Planner"name=description><meta content="Tyler Miller"name=author><title>Home - SVSU CS/CIS Course Scheduling</title><link href=favicon.ico rel=icon type=image/x-icon><link href=favicon.ico rel="shortcut icon"type=image/x-icon><link href=css/logo-nav.css rel=stylesheet><link href=css/bootstrap.css rel=stylesheet><!--[if lt IE 9]><script src=https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js></script><script src=https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js></script><![endif]--><nav class="navbar navbar-fixed-top navbar-inverse"role=navigation><div class=container><div class=navbar-header><a href=http://www.svsu.edu class=navbar-brand><img alt="Saginaw Valley State University"src=img/svsuLogo.png></a></div><div class="collapse navbar-collapse"id=bs-example-navbar-collapse-1><ul class="nav navbar-nav"><li><a href=index.html style=color:#fff>Home</a><li><a href=cs.html>CSIS Course Planner</a><li><a href="https://my.svsu.edu/CookieAuth.dll?GetLogon?curl=Z2F&reason=0&formdir=3">mySVSU</a></ul></div></div></nav>';
	}
}
?>