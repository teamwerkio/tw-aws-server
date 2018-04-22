<?php
	include("dbconnect.php");
	session_start();
	include("img_url.php");
	include("utilities.php");
	
	if(!isset($_SESSION['usr']) || !isset($_POST['search'])){
		header("Location:usr.php");
	}
	else{
		$home_sql = "SELECT * FROM users WHERE usrID='".$_SESSION['usr']."'";
		$home_qry = mysqli_query($dbconnect, $home_sql);
		$home_res = mysqli_fetch_assoc($home_qry);
		$tab_disp=$home_res['firstname'];

		$queryTerm=$_POST['search'];
		if($queryTerm===""){
			header("Location:usr.php");
		}

		$parsed_ini=parse_ini_file("../../cred.ini", true);

		$apiKey=$parsed_ini["API"]["apiKey"];
	}





?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Search Results | Teamwerk</title>

	<!-- Style CSS -->
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />
    <link rel="icon" href="../images/favicon.png" type="image/x-icon"/>
</head>

<body>
	<div id="wrapper">
		<header id="header" class="site-header">
			<div class="container">
				<div class="site-brand">
					<a href="library.php"><img src="../images/assets/logo.png" style="width: 205px; height: 40px;" alt=""></a>
				</div><!-- .site-brand -->
				<div class="right-header">					
					<nav class="main-menu">
						<button class="c-hamburger c-hamburger--htx"><span></span></button>
						<ul>
							<li>
								<div class="search-icon">
									<a href="#" class="ion-ios-search-strong"></a>
									<div class="form-search"></div>
									<form action="searchresults.php" method="POST" id="searchForm">
								  		<input type="text" value="" name="search" placeholder="Search..." />
								    	<button type="submit" value=""><span class="ion-ios-search-strong"></span></button>
								  	</form>
								</div>	
							</li>
							<!-- notifications bell icon -->
							<!-- <li style="margin-left: 0px;">
								<div class="search-icon">
									<a href="#" class="ion-ios-bell-outline" style="cursor: pointer;"></a>
								</div>
							</li> -->
							<li>
								<a href="library.php">Library<i class="fa fa-caret-down" aria-hidden="true"></i></a>
							</li>
							<li>
								<a href="my_projects.php">My Projects<i class="fa fa-caret-down" aria-hidden="true"></i></a>
							</li>
							<li>
								<a href="#"><?php echo $tab_disp; ?><i class="fa fa-caret-down" aria-hidden="true"></i></a>
								<ul class="sub-menu">
									<?php if(!isset($_SESSION['usr'])){
										?>
										<li><a href="usr.php">Sign Up/Log In</a></li>
										<?php
									} ?>
									<li><a href="profile.php">Profile</a></li>
									<li><a href="my_projects.php">My Projects</a></li>
									<li><a href="profile_settings.php">Profile Settings</a></li>
									<?php if(isset($_SESSION['usr'])) {
										?>
										<li><a href="usr.php?action=logout">Logout</a></li>

										<?php
									} ?>									
								</ul>
							</li>
						</ul>
					</nav><!-- .main-menu -->


					<div class="login login-button">
						<a href="add_project.php" class="btn-primary">+ Project</a>
					</div><!-- .login -->
				</div><!--. right-header -->
			</div><!-- .container -->
		</header><!-- .site-header -->

		<main id="main" class="site-main">

			<div style="margin-top: 20px;"></div><!-- .page-title -->

			<div class='container' style="margin-bottom: 25px;">
					<h2 style="margin-top: 13px; float: left;"><i class="fa fa-search"></i> Showing results for: <?php echo $_POST['search'];?></h2>
					<div class="field-select" style="width: 280px; float: right;">
						<select name="em_ext" id="" style="margin-bottom: 0px; border-radius: 0px;">
							<option value="">Sort by A-Z</option>
							<option value="">Sort by Z-A</option>
							<option value="">Sort by Newest-Oldest</option>
							<option value="">Sort by Oldest-Newest</option>
							<option value="">Sort by Team Size [High to Low]</option>
							<option value="">Sort by Team Size [Low to High]</option>
							<option value="">Sort by Involvement [High to Low]</option>
							<option value="">Sort by Involvement [Low to High]</option>
							<option value="">Sort by Interest [High to Low]</option>
							<option value="">Sort by Interest [Low to High]</option>
						</select>
					</div>
				</div>

			<div class="campaigns">
				<div class="container">
					<div class="campaign-content" id="proj-res">
					</div>

				</div>
			</div><!-- .latest -->
		</main><!-- .site-main -->


		<footer id="footer" class="site-footer">
			<div class="footer-menu">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-sm-4 col-4">
							<div class="footer-menu-item">
								<h3>Company</h3>
								<ul>
									<li><a href="about.html">About</a></li>
									<li><a href="press.html">Press</a></li>
									<li><a href="contact.html">Contact</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-sm-4 col-4">
							<div class="footer-menu-item">
								<h3>Community</h3>
								<ul>
									<li><a href="support.html">Support</a></li>
									<li><a href="guidelines.html">Guidelines</a></li>
									<li><a href="termsofuse.html">Terms of Use</a></li>
									<li><a href="privacypolicy.html">Privacy Policy</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-sm-4 col-4">
							<div class="footer-menu-item">
								<h3>Projects</h3>
								<ul>
									<li><a href="#">Technology</a></li>
									<li><a href="#">Games</a></li>
									<li><a href="#">Design &amp; Art</a></li>
									<li><a href="#">Film &amp; Video</a></li>
									<li><a href="#">Performances</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-sm-12 col-12">
							<div class="footer-menu-item newsletter">
								<h3>Subscribe</h3>
								<div class="newsletter-description">Join the Teamwerk community</div>
								<form action="s" method="POST" id="newsletterForm">
							  		<input type="text" value="" name="s" placeholder="Enter your email..." />
							    	<button type="submit" value=""><span class="ion-android-drafts"></span></button>
							  	</form>
							  	<!-- <div class="follow">
							  		<h3>Join us on</h3>
							  		<ul>
							  			<li class="facebook"><a target="_Blank" href="http://www.facebook.com"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							  			<li class="twitter"><a target="_Blank" href="http://www.twitter.com"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							  		</ul>
							  	</div> -->
							</div>
						</div>
					</div>
				</div>
			</div><!-- .footer-menu -->
			<div class="footer-copyright">
				<div class="container">
					<p class="copyright">© Copyrights 2018 by Teamwerk. All Rights Reserved.</p>
					<a href="#" class="back-top">Back to top<span class="ion-android-arrow-up"></span></a>
				</div>
			</div>
		</footer><!-- site-footer -->
	</div><!-- #wrapper -->
	<!-- jQuery -->    
    <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="libs/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="libs/owl-carousel/owl.carousel.min.js"></script>
    <script type="text/javascript" src="libs/jquery.countdown/jquery.countdown.min.js"></script>
    <script type="text/javascript" src="libs/wow/wow.min.js"></script>
    <script type="text/javascript" src="libs/isotope/isotope.pkgd.min.js"></script>
    <script type="text/javascript" src="libs/bxslider/jquery.bxslider.min.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.24.0/babel.js"></script>

	<script crossorigin src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
	<script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
	
	<!-- For Dev only! -->
<!-- 	<script crossorigin src="https://unpkg.com/react@16/umd/react.development.js"></script>
	<script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script> -->
    <!-- orther script -->
    <script  type="text/javascript" src="js/main.js"></script>
    <script type="text/babel" src="js/search.js"></script>
    <script type="text/javascript">
    	var apiKey="<?php echo $apiKey;?>";
    	var queryTerm="<?php echo $queryTerm;?>";
    	
    </script>
    
</body>
</html>
