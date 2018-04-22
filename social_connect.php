<?php
	include("dbconnect.php");
	session_start();
	unset($_SESSION['fb']);
	$usr_sql="SELECT * FROM users WHERE usrID=".$_SESSION['usr'];
	$usr_qry=mysqli_query($dbconnect, $usr_sql);
	$usr_res=mysqli_fetch_assoc($usr_qry);

	$parsed_ini=parse_ini_file("../../fb.ini", true);
	$app_id=$parsed_ini['FB']['app_id'];
	$app_secret=$parsed_ini['FB']['app_secret'];
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Social Connect | Teamwerk</title>

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

	<!-- Login with facebook script -->
	<div id="fb-root"></div>
	<script>
	  function statusChangeCallback(response) {
	    console.log('statusChangeCallback');
	    console.log(response.status);
	    if(response.status==='connected'){
	    	$.ajax({
    				url: 'fbLogin.php',
    				type: 'POST',
    				data: {
    					'login': 1,
    				},
    				success: function(data){
    					window.location.href="library.php";
    				}
			});	
	    }
	    // The response object is returned with a status field that lets the
	    // app know the current login status of the person.
	    // Full docs on the response object can be found in the documentation
	    // for FB.getLoginStatus().
	  }
    function checkLoginState() {
	    FB.getLoginStatus(function(response) {
	      statusChangeCallback(response);
	    });
	  }
	  window.fbAsyncInit = function() {
	    FB.init({
	      appId: <?php echo $app_id;?>,
	      autoLogAppEvents : true,
	      xfbml            : true,
	      cookie: true, // This is important, it's not enabled by default
	      version: 'v2.8'
	    });

	    FB.getLoginStatus(function(response) {
	      statusChangeCallback(response);
	    });



	  };
	  (function(d, s, id){
	    var js, fjs = d.getElementsByTagName(s)[0];
	    if (d.getElementById(id)) {return;}
	    js = d.createElement(s); js.id = id;
	    js.src = "https://connect.facebook.net/en_US/sdk.js";
	    fjs.parentNode.insertBefore(js, fjs);
	  }(document, 'script', 'facebook-jssdk'));
	</script>

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
									<a href="searchresults.php" class="ion-ios-search-strong"></a>
									<div class="form-search"></div>
									<form action="#" method="POST" id="searchForm">
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
								<a href="#"><?php echo $usr_res['firstname'];?><i class="fa fa-caret-down" aria-hidden="true"></i></a>
								<ul class="sub-menu">
									<li><a href="profile.php">Profile</a></li>
									<li><a href="my_projects.php">My Projects</a></li>
									<li><a href="profile_settings.php">Profile Settings</a></li>	
									<li><a href="usr.php?action=logout">Logout</a></li>									
								</ul>
							</li>
						</ul>
					</nav>

					<div class="login login-button">
						<a href="add_project.php" class="btn-primary">+ Project</a>
					</div><!-- .login -->
				</div><!--. right-header -->
			</div><!-- .container -->
		</header><!-- .site-header -->

		<main id="main" class="site-main">
			<div class="page-title background-page">
				<div class="container">
					<h1>Welcome aboard, <?php echo $usr_res['firstname'];?>!</h1>
				</div>
			</div>
			
			<div class="faq-content">
				<div class="container">

					<img src="../images/tw-fb.jpg" style="max-width: 200px; max-height: 500px; margin: 0 auto; display: block; margin-bottom: 25px;">
					
					<h2 align="center" style="margin-bottom: 5px;">Connect with Facebook</h2>
					<p align="center">Connect your Teamwerk account with Facebook so we can find you the top projects that would interest you the most.</p>
					<!-- Facebook login button -->
					<div id="fbcenter" style="margin-top: 15px;">
						<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-scope="user_likes,user_posts,user_education_history,user_work_history" data-auto-logout-link="false" data-use-continue-as="false" onlogin="checkLoginState();"></div>
					</div>
					<a href="library.php" align="center" style="font-size: 12px; margin-top: 8px;"><u>No thanks, take me to my account</u></a>

				</div>
			</div>

		</main>

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
			</div>
			<div class="footer-copyright">
				<div class="container">
					<p class="copyright">© Copyrights 2018 by Teamwerk. All Rights Reserved.</p>
					<a href="#" class="back-top">Back to top<span class="ion-android-arrow-up"></span></a>
				</div>
			</div>
		</footer>
	</div>
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