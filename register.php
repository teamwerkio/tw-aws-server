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
	<title>Sign up for Teamwerk | Teamwerk</title>

	<!-- Style CSS -->
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon"/>

    <style type="text/css">
		/* Create two equal columns that floats next to each other */
		.column {
			float: left;
			width: 50%;
			padding: 10px;
		}

		/* Clear floats after the columns */
		.row:after {
			content: "";
			display: table;
			clear: both;
		}
    </style>
</head>

<body>
	<div id="wrapper">
		<header id="header" class="site-header">
			<div class="container">
				<div class="site-brand">
					<a href="login.php"><img src="../images/assets/logo.png" style="width: 170px; height: 28px;" alt=""></a>
				</div><!-- .site-brand -->
				<div class="right-header">					
					<!-- <nav class="main-menu">
						<button class="c-hamburger c-hamburger--htx"><span></span></button>
						<ul>
							<li>
								<a href="#">Home<i class="fa fa-caret-down" aria-hidden="true"></i></a>
								<ul class="sub-menu">
									<li><a href="index_v2.html">Home v2</a></li>
								</ul>
							</li>
							<li>
								<a href="#">Explore<i class="fa fa-caret-down" aria-hidden="true"></i></a>
								<ul class="sub-menu">
									<li><a href="explore_layout_one.html">Explore Layout One</a></li>
									<li><a href="explore_layout_two.html">Explore Layout Two</a></li>
									<li><a href="explore_layout_three.html">Explore Layout Three</a></li>
								</ul>
							</li>
							<li>
								<a href="#">Start a Campaigns<i class="fa fa-caret-down" aria-hidden="true"></i></a>
								<ul class="sub-menu">
									<li><a href="create_a_campaign.html">Create a campaign</a></li>
									<li><a href="update_a_campaign.html">Update a campaign</a></li>
								</ul>
							</li>
							<li>
								<a href="#">Pages<i class="fa fa-caret-down" aria-hidden="true"></i></a>
								<ul class="sub-menu">
									<li><a href="coming_soon.html">Coming Soon</a></li>
									<li><a href="about_us.html">About Us</a></li>
									<li><a href="404.html">404</a></li>
									<li><a href="login.html">Login</a></li>
									<li><a href="register.html">Register</a></li>
									<li><a href="faq.html">Faq</a></li>
									<li><a href="campaign_detail.html">Campaign details</a></li>
								</ul>
							</li>
							<li>
								<a href="#">Blog<i class="fa fa-caret-down" aria-hidden="true"></i></a>
								<ul class="sub-menu">
									<li><a href="blog_grid.html">Blog Grid</a></li>
									<li><a href="blog_list.html">Blog List</a></li>
									<li><a href="blog_list_sidebar.html">Blog Grid Sidebar</a></li>
									<li><a href="blog_details.html">Blog Details</a></li>
								</ul>
							</li>
							<li>
								<a href="#">Shop<i class="fa fa-caret-down" aria-hidden="true"></i></a>
								<ul class="sub-menu">
									<li><a href="shop-grid.html">Shop Grid</a></li>
									<li><a href="shop-details.html">Shop Details</a></li>
									<li><a href="cart.html">Cart</a></li>
									<li><a href="checkout.html">Checkout</a></li>
								</ul>
							</li>
							<li><a href="contact_us.html">Contact</a></li>
							<li>
								<a href="#">Account<i class="fa fa-caret-down" aria-hidden="true"></i></a>
								<ul class="sub-menu">
									<li><a href="dashboard.html">Dashboard</a></li>
									<li><a href="profile.html">Profile</a></li>
									<li><a href="account_my_campaigns.html">My Campaigns</a></li>
									<li><a href="account_pledges_received.html">Pledges Received</a></li>
									<li><a href="account_backed_campaigns.html">Backed Campaigns</a></li>
									<li><a href="account_rewards.html">Rewards</a></li>
									<li><a href="account_payments.html">Payments</a></li>
								</ul>
							</li>
						</ul>
					</nav> --><!-- .main-menu -->
		<!-- 			<div class="search-icon">
						<a href="#" class="ion-ios-search-strong"></a>
						<div class="form-search"></div>
						<form action="#" method="POST" id="searchForm">
					  		<input type="text" value="" name="search" placeholder="Search..." />
					    	<button type="submit" value=""><span class="ion-ios-search-strong"></span></button>
					  	</form>
					</div>	 -->

					<div class="login login-button">
						<a href="login.php" class="btn-primary">Log In</a>
					</div><!-- .login -->
				</div><!--. right-header -->
			</div><!-- .container -->
		</header><!-- .site-header -->
		<main id="main" class="site-main">
			<div class="page-title background-page">
				<div class="container">
					<h1>Sign Up</h1>
					<div class="breadcrumbs">
						<ul>
							<li><a href="index.html">Home</a><span>/</span></li>
							<li>Sign Up</li>
						</ul>
					</div><!-- .breadcrumbs -->
				</div>
			</div><!-- .page-title -->
			<div class="container">
				<div class="main-content">
					<div class="form-login form-register">
						<h2>Create an account</h2>
						<form name="signup" action="usr.php" method="post" enctype="multipart/form-data" id="registerForm" class="clearfix">
			  				<div class="field">
			  					<input name="firstname" type="text" value="" name="s" placeholder="First Name" />
			  				</div>
			  				<div class="field">
			  					<input name="lastname" type="text" value="" name="s" placeholder="Last Name" />
			  				</div>
			  				<div class="field">
			  					<input name="pitch" type="text" value="" name="s" placeholder="Talk to me about ..." />
			  				</div>
			  				<div class="field">
			  					<input name="email_signup" type="email" value="" name="s" placeholder=".edu Email Address" />
			  				</div>
			  				<div class="field">
			  					<input name="pass_signup" type="password" value="" name="s" placeholder="Password" />
			  				</div>
			  				<div class="field">
			  					<input name="pass_signup_verify" type="password" value="" name="s" placeholder="Verify your password" />
			  				</div>
			  				<div class="payment" style="margin-top: 0px;">
								<h4 style="font-size: 14px; margin-bottom: 5px; font-weight: bold; color: #555555">Your top interests *</h4>
								<h5 style="font-weight: normal; color: #555555; font-size: 14px; font-style: italic;">Pick your top interests</h5>
								<div class="row" style="padding-left: 6px;">
									<div class="column">
										<div class="create-account" style="margin-top: 10px;">
						  					<input type="checkbox" id="1" name="" value="">
						  					<label for="1" style="padding-left: 22px;">Design & Art</label>
						  					<div class="checkbox" style="margin-top: 2px;"></div>
					  					</div>
					  					<div class="create-account" style="margin-top: 10px;">
						  					<input type="checkbox" id="2" name="" value="">
						  					<label for="2" style="padding-left: 22px;">Film & Video</label>
						  					<div class="checkbox" style="margin-top: 2px;"></div>
					  					</div>
					  					<div class="create-account" style="margin-top: 10px;">
						  					<input type="checkbox" id="3" name="" value="">
						  					<label for="3" style="padding-left: 22px;">Books</label>
						  					<div class="checkbox" style="margin-top: 2px;"></div>
					  					</div>
					  					<div class="create-account" style="margin-top: 10px;">
						  					<input type="checkbox" id="4" name="" value="">
						  					<label for="4" style="padding-left: 22px;">Performances</label>
						  					<div class="checkbox" style="margin-top: 2px;"></div>
					  					</div>
				  					</div>
				  					<div class="column">
										<div class="create-account" style="margin-top: 10px;">
						  					<input type="checkbox" id="5" name="" value="">
						  					<label for="5" style="padding-left: 22px;">Crafts</label>
						  					<div class="checkbox" style="margin-top: 2px;"></div>
					  					</div>
					  					<div class="create-account" style="margin-top: 10px;">
						  					<input type="checkbox" id="6" name="" value="">
						  					<label for="6" style="padding-left: 22px;">Technology</label>
						  					<div class="checkbox" style="margin-top: 2px;"></div>
					  					</div>
					  					<div class="create-account" style="margin-top: 10px;">
						  					<input type="checkbox" id="7" name="" value="">
						  					<label for="7" style="padding-left: 22px;">Food</label>
						  					<div class="checkbox" style="margin-top: 2px;"></div>
					  					</div>
					  					<div class="create-account" style="margin-top: 10px;">
						  					<input type="checkbox" id="8" name="" value="">
						  					<label for="8" style="padding-left: 22px;">Games</label>
						  					<div class="checkbox" style="margin-top: 2px;"></div>
					  					</div>
				  					</div>
				  				</div>
				  				<div>
					  				<div class="field" style="margin-bottom: 1px; margin-top: 10px;">
					  					<p><strong>Upload a Profile Picture *</strong></p>
					  					<p><i>A size of 120 x 120 is preferred</i></p>
					  					<div class="file-upload">
					  						<div class="upload-bg">
						  						<div id="myfileupload1">
											   		<input type="file" id="uploadfile1" name="profilepic" onchange="readURL1(this);" />	  
											 	</div>
											 	<div id="thumbbox1">
											 		<img height="100" width="100" alt="Thumb image" id="thumbimage1" style="display: none" />
											  		<a class="removeimg1" href="javascript:" ></a>
											  	</div>
											 	<div id="boxchoice1">
											  		<a href="javascript:" class="choicefile1"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Upload Image</a>
											  		<p style="clear:both"></p>
											 	</div>
											  	<label class="filename1"></label>
						  					</div>
					  					</div>
					  				</div>
			  					</div>
			  				<div class="inline clearfix" style="margin-top: 10px;">
						  		<button type="submit" name="signup" class="btn-primary">Create Account</button>
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
									<li><a href="about_us.php">About</a></li>
									<li><a href="">Press</a></li>
									<li><a href="#">Team</a></li>
									<li><a href="#">Contact</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-sm-4 col-4">
							<div class="footer-menu-item">
								<h3>Community</h3>
								<ul>
									<li><a href="#">Support</a></li>
									<li><a href="#">Guidelines</a></li>
									<li><a href="#">Terms of Use</a></li>
									<li><a href="#">Privacy Policy</a></li>
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
							  	<div class="follow">
							  		<h3>Join us on</h3>
							  		<ul>
							  			<li class="facebook"><a target="_Blank" href="http://www.facebook.com"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							  			<li class="twitter"><a target="_Blank" href="http://www.twitter.com"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							  		</ul>
							  	</div>
							</div>
						</div>
					</div>
				</div>
			</div><!-- .footer-menu -->
			<div class="footer-copyright">
				<div class="container">
					<p class="copyright">© Copyrights 2017 by Teamwerk. All Rights Reserved.</p>
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