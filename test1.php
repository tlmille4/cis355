<?php 
session_start(); //required for every PHP file
//if userid is not set, call login function

	
echo "ASDFASDFASAFSD";

?>




		<div id="page-wrapper">
			
			<!-- Header -->
			<div id="header">
					<!-- Logo -->
					<!-- Nav -->
						<nav id="nav">
						<img style="padding-top: 10px;" alt="Saginaw Valley State University"src=images/svsuLogo.png>
							<ul>
								<li class="current"><a href="index.php">Home</a></li>
								<li><a href="http://my.svsu.edu">mySVSU</a></li>
								<li><a href="http://svsu.instructure.com">Canvas</a></li>';
							</ul>
						</nav>
			</div>

			<!-- Banner 
				<section id="banner">
					<header>
						<h2>Arcana: <em>A responsive site template freebie by <a href="http://html5up.net">HTML5 UP</a></em></h2>
						<a href="#" class="button">Learn More</a>
					</header>
				</section>-->

			<!-- Highlights -->
				<section class="wrapper style1">
					<div class="container">
						<div class="row 200%">
							<section class="4u 12u(narrower)">
								<div class="box highlight">
								
								<i class="icon major fa-sign-in"></i>
								<h2>Login</h2>
									Login to see course information and register for desired courses
	
								</div>
							</section>
							<section class="4u 12u(narrower)">
								<div class="box highlight">
									<img alt="SVSU Cardinals Logo" src="images/Svsu_cardinal.png"/>
									<?php 
									
									if($_SESSION['message'])
									{
										echo '<div style="color: red;">' .$_SESSION['message']. '</div>';
										unset($_SESSION['message']);
									}

									SiteTemplate::displayLoginForm(); ?>
								</div>
							</section>
							<section class="4u 12u(narrower)">
								<div class="box highlight">
									<!--<i class="icon major fa-calendar"></i>-->
									
									<img alt="Calendar Events" src="http://creativewriting.english.illinois.edu/_images/calendar/calendar_icon.png" style="width: 10%;"/>
									<h3>Upcoming Events</h3>
									
									<section align="center">
										
										<div class="calendar_data" style="border: 3px solid #b03427;padding-top:5px;padding-left:10px;">
											<script type="text/javascript" src="//25livepub.collegenet.com/scripts/spuds.js"></script> 
											<script type="text/javascript"> 
											$Trumba.addSpud({ 
												webName: "homepage-calendar-resource", 
												spudType : "main"
											});
											</script>
										
										</div>
									</section>
								

								</div>
							</section>
						</div>
					</div>
				</section>



			<!-- CTA -->
				<section id="cta" class="wrapper style3">
					<div class="container">
						<header>
							<h2>Need to register for your account?</h2>
							<a href="#Email" class="button">Let Us Know</a>
						</header>
					</div>
				</section>

			<!-- Footer -->
				<div id="footer">
					<div class="container">
						<div class="row">
						
							<section class="3u 12u(narrower)">
							
							</section>
							<section class="6u 12u(narrower)">
								<h3 id="Email">Need Help? We're At Your Service!</h3>
								<form action="http://tlmille4.noip.me/sendEmail.php" method="POST">
									<div class="row 50%">
										<div class="6u 12u(mobilep)">
											<input type="text" name="name" id="name" placeholder="Name" />
										</div>
										<div class="6u 12u(mobilep)">
											<input type="email" name="email" id="email" placeholder="Email" />
										</div>
									</div>
									<div class="row 50%">
										<div class="12u">
											<textarea name="message" id="message" placeholder="Message" rows="5"></textarea>
										</div>
									</div>
									<div class="row 50%">
										<div class="12u">
											<ul class="actions">
												<li><input name="emailMessage" type="submit" class="button alt" value="Send Message" /></li>
											</ul>
										</div>
									</div>
								</form>
							</section>
							<section class="3u 12u(narrower)">
							
							</section>
						</div>
					</div>

					<!-- Icons -->
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-github"><span class="label">GitHub</span></a></li>
							<li><a href="#" class="icon fa-linkedin"><span class="label">LinkedIn</span></a></li>
							<li><a href="#" class="icon fa-google-plus"><span class="label">Google+</span></a></li>
						</ul>

					<!-- Copyright -->
						<div class="copyright">
							<ul class="menu">
								<li>&copy; Untitled. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
							</ul>
						</div>

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
