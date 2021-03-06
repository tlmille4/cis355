
<!-- 
filename  : menu.html
author    : Tyler Miller
date      : 2016-09-19
email     : tlmille4@svsu.edu
course    : CIS-255
link      : http://csis.svsu.edu/~tlmille4/cis255/tlmille4/menu.html
purpose   : This file is the menu for CIS255 the course, 
			CIS-255: Client Side Web Development, 
			at Saginaw Valley State University (SVSU)   
external code used in this file: 
			Basic styling cues and codes taken from W3Schools.com
external code references (links) in this file: 
			Tyler Miller
program structure (design):
	<head>: 
		STYLE CSS for Design and Formatting
	<body>: 
		DIVCLASS-FlexTable: 
			NavClass: Usefull Links Navigation
			ArticleClass: Assignments
			Footer: Copyright to Credit External Code Use
-->
<!DOCTYPE html>
<html>

	<head>
	<link href="https://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Special+Elite" rel="stylesheet">
	<link rel="icon" type="image/png" href="favicon.ico">
	<title>Tyler Miller's Menu - CIS255 Client Side Web Development</title>
		<style>
			.flex-container {
				display: -webkit-flex;
				display: flex;
				-webkit-flex-flow: row wrap;
				flex-flow: row wrap;
				text-align: center;
			}

			.flex-container > * {
				padding: 5px;
				-webkit-flex: 1 100%;
				flex: 1 100%;
			}

			.article {
				text-align: left;
				padding-left: 20px;
			}

			header {background: black;color:white;font-family:Courier New; padding: 0px;}
			footer {background: #aaa;color:white;}
			.nav {background:#eee;}

			.nav ul {
				list-style-type: disk;
				padding: 10;
			}
			   
			.nav ul a {
			 text-decoration: none;
			}

			@media all and (min-width: 768px) {
				.nav {text-align:left;-webkit-flex: 1 auto;flex:1 auto;-webkit-order:1;order:1;}
				.article {-webkit-flex:5 0px;flex:5 0px;-webkit-order:2;order:2;}
				footer {-webkit-order:3;order:3;}
			}
			
			.navMenu ul {
				font-family: 'Lato', sans-serif;
				list-style-type: none;
				margin: 0px;
				padding: 0;
				overflow: hidden;
				background-color: #333;
				width: 100%;
			}

			.navMenu li {
				float: left;
			}

			.navMenu li a {
				display: inline-block;
				color: white;
				text-align: center;
				padding: 14px 16px;
				text-decoration: none;
			}

			.navMenu li a:hover {
				background-color: #111;
			}
			.headerTitle {
				font-family: 'Special Elite', cursive;
				padding-left: 50px;
				padding-top: 50px;
				padding-bottom: 50px;
				text-align: left;
				font-style: oblique;
				font-size: 30px;
				float:left;
				
			}
			.subHeaderTitle {
				font-family: 'Gloria Hallelujah', cursive;
				padding-left: 10px;
				padding-top: 50px;
				text-align: center;
				text-decoration: overline ;
				font-size: 23px;
			}
			
		</style>
	</head>
	
	<body>

		<header>
		
			<div class="headerTitle">
				<img width="80%" src="http://tlmille4.noip.me/tlmille4.gif"/>
				
			</div>
			<div class="subHeaderTitle">
				<h3>CIS355 : Server Side Web App Devt</h3>
			</div>
			<div class="navMenu">
				<ul>
					<li><a href="https://github.com/tlmille4/cis355">CIS355 GitHub Repo</a></li>
					<li style="float:right"><a href="http://csis.svsu.edu/~tlmille4/">tlmille4 CSIS Directory</a></li>
				</ul>
			</div>
		</header>
	
		<div class="flex-container">
			<nav class="nav">
			<!--
				<h2>Useful Links:</h2>
				<ul>				
					<li><a href="http://www.cis255.com">CIS255 Homepage</a></li>
					<li><a href="https://github.com/cis255/cis255">CIS255 GitHub Repo</a></li>
					<li><a href="http://tlmille41.wixsite.com/mysite">Wix Resume</a></li>
					<li><a href="http://tlmille4.weebly.com/">Weebly Resume</a></li>
				</ul> -->
				
				<h2>Class Activities:</h2>
				<ul>
					<li><a href="cubic.html">Cubic Quiz - HTML</a></li>
					<li><a href="cubic.php">Cubic Quiz - PHP</a></li>
					<li><a href="fileDownload.php">File Download</a></li>
					<li><a href="fileUpload.php">File Upload - PHP</a></li>
					<li><a href="fileupload.html">File Upload - HTML</a></li>
					<li><a href="startutorial/">Star Tutorial CRUD</a></li>
					<li><a href="sandbox/">Sandbox Directory</a></li>
					<li><a href="test.html">Test PHP/HTML</a></li>
					<li><a href="test1.php">Test1.php</a></li>
				</ul>
			</nav>

			<article class="article">
				<br/>
				
				<h1>Final Project:</h1>
				<p>
					<strong><a href="SVSUCoursePlanner/">SVSU Course Registration [CRUD] System</a></strong>
					<br /> 
					Utilizes SQL, PHP, and HTML to create a course registration system
				</p>

				<!-- Future Assignment Links Here -->
			</article>

			<footer></footer>
		</div><!-- endFlexContainer div container class -->
	</body><!--end Body tag -->
</html>