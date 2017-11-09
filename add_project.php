<?php
	include("dbconnect.php");
	session_start();

	if(!isset($_SESSION['usr'])){
		header("Location:library.php");
	}
	else{
		$addp_sql = "SELECT * FROM users WHERE usrID='".$_SESSION['usr']."'";
		$addp_qry = mysqli_query($dbconnect, $addp_sql);
		$addp_res = mysqli_fetch_assoc($addp_qry);
	}
?>


<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add a Project | Teamwerk</title>

	<!-- Style CSS -->
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />
    <link rel="icon" href="images/favicon.png" type="image/x-icon"/>
</head>

<body class="campaign-detail">
	<div id="wrapper">
		<header id="header" class="site-header">
			<div class="container">
				<div class="site-brand">
					<a href="library.html"><img src="../images/assets/logo.png" style="width: 170px; height: 28px;" alt=""></a>
				</div><!-- .site-brand -->
				<div class="right-header">					
					<nav class="main-menu">
						<button class="c-hamburger c-hamburger--htx"><span></span></button>
						<ul>
							<li>
								<a href="library.php">Library<i class="fa fa-caret-down" aria-hidden="true"></i></a>
							</li>
							<li>
								<a href="my_projects.php">My Projects<i class="fa fa-caret-down" aria-hidden="true"></i></a>
							</li>
							<li>
								<a href="#"><?php echo $addp_res['firstname']; ?><i class="fa fa-caret-down" aria-hidden="true"></i></a>
								<ul class="sub-menu">
									<li><a href="dashboard.php">Dashboard</a></li>
									<li><a href="profile.php">Profile</a></li>
									<li><a href="ongoing_projects.php">Ongoing Projects</a></li>
									<li><a href="past_projects.php">Past Projects</a></li>
									<li><a href="usr.php?action=logout">Log Out</a></li>
								</ul>
							</li>
						</ul>
					</nav><!-- .main-menu -->
<!-- 					<div class="search-icon">
						<a href="#" class="ion-ios-search-strong"></a>
						<div class="form-search"></div>
						<form action="#" method="POST" id="searchForm">
					  		<input type="text" value="" name="search" placeholder="Search..." />
					    	<button type="submit" value=""><span class="ion-ios-search-strong"></span></button>
					  	</form>
					</div>	 -->

					<div class="login login-button">
						<a href="add_project.php" class="btn-primary">+ Project</a>
					</div><!-- .login -->
				</div><!--. right-header -->
			</div><!-- .container -->
		</header><!-- .site-header -->

		<main id="main" class="site-main">
<!-- 			<div class="page-title background-campaign">
				<div class="container">
					<h1>Start a campaign</h1>
					<div class="breadcrumbs">
						<ul>
							<li><a href="index.html">Home</a><span>/</span></li>
							<li>Start a campaign</li>
						</ul>
					</div>
				</div>
			</div -->
			<div style="margin-top: 50px;"></div><!-- .page-title -->
			<div class="campaign-form form-update">
				<div class="container">
					<form name="addp" action="proj_submit.php" method="post" enctype="multipart/form-data">
						<!-- <legend>Start a campaign</legend> -->
						<div class="field">
							<label for="title">Project Name *</label>
							<span class="label-desc">What is the name of your project?</span>
		  					<input type="text" value="" name="projname" placeholder="The Oreous Pillow" />
		  				</div>
		  				<div class="field">
							<label for="">Project Tagline *</label>
							<span class="label-desc">Provide a short project tagline.</span>
		  					<textarea name="projtagl" rows="2" placeholder="Enter upto 85 characters"></textarea>
		  				</div>
		  				<div class="field">
							<label for="">Project Short Description *</label>
							<span class="label-desc">Provide a short description that best describes your project to your audience.</span>
		  					<textarea name="proj_sh_desc" rows="2" placeholder="Enter upto 215 characters"></textarea>
		  				</div>
		  				<div class="field">
							<label for="">Project Long Description *</label>
							<span class="label-desc">Give details about your project, why did you start this project? What makes it unique?</span>
		  					<textarea name="proj_lg_desc" rows="5" placeholder="Enter upto 500 characters"></textarea>
		  				</div>
		  				<div>
			  				<div class="field">
			  					<label for="">Big Banner *</label>
								<span class="label-desc">This image shows up in a large project details dialog. A size of 570 x 350 is preferred.</span>
			  					<div class="file-upload">
			  						<div class="upload-bg">
				  						<div id="myfileupload1">
									   		<input type="file" id="uploadfile1" name="big_ban" onchange="readURL1(this);" />	  
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
		  				<div>
		  					<div class="field">
								<label for="">Small Banner *</label>
								<span class="label-desc">This image shows up in a small project details dialog. A size of 370 x 240 is preferred.</span>
								<div class="file-upload">
			  						<div class="upload-bg">
				  						<div id="myfileupload2">
									   		<input type="file" id="uploadfile2" name="sm_ban" onchange="readURL2(this);" />	  
									 	</div>
									 	<div id="thumbbox2">
									 		<img height="100" width="100" alt="Thumb image" id="thumbimage2" style="display: none" />
									  		<a class="removeimg2" href="javascript:" ></a>
									  	</div>
									 	<div id="boxchoice2">
									  		<a href="javascript:" class="choicefile2"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Upload Image</a>
									  		<p style="clear:both"></p>
									 	</div>
									  	<label class="filename2"></label>
			  						</div>
			  					</div>
			  				</div>
		  				</div>
		  				<div>
		  					<div class="field">
								<label for="">Project Icon *</label>
								<span class="label-desc">This image shows up in a smaller project details dialog. A size of 150 x 150 is preferred.</span>
								<div class="file-upload">
			  						<div class="upload-bg">
				  						<div id="myfileupload3">
									   		<input type="file" id="uploadfile3" name="proj_icon" onchange="readURL2(this);" />	  
									 	</div>
									 	<div id="thumbbox3">
									 		<img height="100" width="100" alt="Thumb image" id="thumbimage3" style="display: none" />
									  		<a class="removeimg3" href="javascript:" ></a>
									  	</div>
									 	<div id="boxchoice3">
									  		<a href="javascript:" class="choicefile3"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Upload Image</a>
									  		<p style="clear:both"></p>
									 	</div>
									  	<label class="filename3"></label>
			  						</div>
			  					</div>
			  				</div>
		  				</div>
		  				<div class="field clearfix">
		  					<label for="">Your Institution *</label>
							<span class="label-desc">Choose the institution where you are running this project from.</span>
			  				<div class="field">
			  					<div class="field-select">
									<select name="college" id="">
										<option value="">Select an Institution</option>
										<option value="1">Amherst College</option>
										<option value="2">Hampshire College</option>
										<option value="3">Mount Holyoke College</option>
										<option value="4">Smith College</option>
										<option value="5">University of Massachusetts, Amherst</option>
									</select>
								</div>
			  				</div>
						</div>
						<div class="field">
							<label for="">Project Category *</label>
							<span class="label-desc">To help potential team members find your project, select a broad category that best represents your project.</span>
							<div class="field-select">
								<select name="cat" id="">
									<option value="">Select a Category</option>
									<option value="1">Design &amp; Art</option>
									<option value="2">Film &amp; Video</option>
									<option value="3">Book</option>
									<option value="4">Performances</option>
									<option value="5">Crafts</option>
									<option value="6">Technology</option>
									<option value="7">Food</option>
									<option value="8">Game</option>
								</select>
							</div>
		  				</div>
		  				<div class="field">
							<label for="title">Tags *</label>
							<span class="label-desc">Enter up to five keywords that best describe your project. Separate each tag with a comma.</span>
		  					<input type="text" value="" name="tags" placeholder="Plants, Leaves, Green, Environment, Rain" />
		  				</div>
		  				<button name="addp" type="submit" value="Save & Launch" class="btn-primary">Create Project</button>
					</form>
				</div>
			</div><!-- .campaign-form -->
		</main><!-- .site-main -->

		<footer id="footer" class="site-footer">
			<div class="footer-menu">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-sm-4 col-4">
							<div class="footer-menu-item">
								<h3>Company</h3>
								<ul>
									<li><a href="about_us.html">About</a></li>
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
    <script type="text/javascript" src="libs/owl-carousel/carousel.min.js"></script>
    <script type="text/javascript" src="libs/jquery.countdown/jquery.countdown.min.js"></script>
    <script type="text/javascript" src="libs/wow/wow.min.js"></script>
    <script type="text/javascript" src="libs/isotope/isotope.pkgd.min.js"></script>
    <script type="text/javascript" src="libs/bxslider/jquery.bxslider.min.js"></script>
    <!-- orther script -->
    <script  type="text/javascript" src="js/main.js"></script>
</body>
</html>