<?php
/*******************************************************************
*filename: logout.php
*author:   Tyler Miller
*description: This PHP file destorys session and sends user back
*			  index.php page
*******************************************************************/
session_start();
session_destroy();
header("Location: index.php?logout=1");
?>