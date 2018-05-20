<?php
	include("dbconnect.php");
	@session_start();
	if(isset($_SESSION['usr'])){
		header("Location:library.php");
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Log in to Teamwerk | Teamwerk</title>

	<!-- Style CSS -->
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />
    <link rel="icon" href="../images/favicon.png" type="image/x-icon"/>

    <style type="text/css">
    	#fbcenter {
			margin: 0 auto;
			text-align: center;
		}
    </style>
</head>

<body>

<!-- <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId=111072682828913&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script> -->

	<div id="wrapper">
		<header id="header" class="site-header">
			<div class="container">
				<div class="site-brand">
					<a href="landing.php"><img src="../images/assets/logo.png" style="width: 205px; height: 40px;" alt=""></a>
				</div><!-- .site-brand -->
				<div class="right-header">				
					<div class="login login-button">
						<a href="register.php" class="btn-primary">Sign Up</a>
					</div>
				</div>
			</div><!-- .container -->
		</header><!-- .site-header -->
		<main id="main" class="site-main">
			<div class="page-title background-page">
				<div class="container">
					<h1>Log In</h1>
					<div class="breadcrumbs">
						<ul>
							<li><a href="http://www.teamwerk.io">Home</a><span>/</span></li>
							<li>Log In</li>
						</ul>
					</div><!-- .breadcrumbs -->
				</div>
			</div><!-- .page-title -->
			<div class="container">
				<div class="main-content">
					<div class="form-login">
						<!-- <h2 align="center">Log in with Facebook</h2>
						<hr>
						<div id="fbcenter">
							<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true"></div>
						</div>

						<h2 align="center" style="margin-top: 35px;">Log in with Email</h2>
						<hr> -->
						<h2>Log in to Teamwerk</h2>
						<form name="login" action="usr.php" method="post" id="loginForm" class="clearfix">
			  				<div class="field">
			  					<input type="email" value="" name="email" placeholder="College Email" />
			  				</div>
			  				<div class="field">
			  					<input type="password" value="" name="pass" placeholder="Password" />
			  				</div>
			  				<div class="inline clearfix">
						  		<button name="login" type="submit" class="btn-primary">Log In</button>
						  		<p><a href="register.php">Don't have an account?</a></p>
						  	</div>
					  	</form>
					</div>
				</div>
			</div>	
		</main>
<!-- .site-main -->

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
    <!-- orther script -->
    <script  type="text/javascript" src="js/main.js"></script>
</body>
</html>