<?php
	include("dbconnect.php");
	include("upload_photo.php");
	session_start();

	if(!isset($_SESSION['usr'])){
		header("Location:library.php");
	}
	else{
	
		$usr_sql = "SELECT * FROM users WHERE usrID=".$_SESSION['usr'];
		$usr_qry = mysqli_query($dbconnect, $usr_sql);
		$usr_res = mysqli_fetch_assoc($usr_qry);
		
	}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile | Teamwerk</title>

	<!-- Style CSS -->
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />
    <link rel="icon" href="../images/favicon.png" type="image/x-icon"/>

    <!-- bootstrap wrappable css to avoid conflicts -->
  	<link rel="stylesheet" href="https://formden.com/static/assets/demos/bootstrap-iso/bootstrap-iso/bootstrap-iso.css">
  	<link rel="stylesheet" href="https://formden.com/static/assets/demos/bootstrap-iso/bootstrap-iso/bootstrap-iso.css">

  	<!-- sweetalerts -->
  	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <style type="text/css">
		/* Create two equal columns that floats next to each other */
		.column {
			float: left;
			width: 50%;
			padding: 10px;
		}

		.row:after {
			content: "";
			display: table;
			clear: both;
		}
	</style>
</head>

<body>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId=1841177166173972&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>	

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
							<div class="search-icon">
								<a href="#" class="ion-ios-search-strong"></a>
								<div class="form-search"></div>
								<form action="#" method="POST" id="searchForm">
							  		<input type="text" value="" name="search" placeholder="Search..." />
							    	<button type="submit" value=""><span class="ion-ios-search-strong"></span></button>
							  	</form>
							</div>	
							<li>
								<a href="library.php">Library<i class="fa fa-caret-down" aria-hidden="true"></i></a>
							</li>
							<li>
								<a href="my_projects.php">My Projects<i class="fa fa-caret-down" aria-hidden="true"></i></a>
							</li>
							<li>
								<a href="profile.php"><?php echo $usr_res['firstname']; ?><i class="fa fa-caret-down" aria-hidden="true"></i></a>
								<ul class="sub-menu">
									<li><a href="profile.php">Profile</a></li>
									<li><a href="my_projects.php">My Projects</a></li>
									<li><a href="profile_settings.php">Profile Settings</a></li>
									<li><a href="usr.php?action=logout">Log Out</a></li>
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
			<div class="account-wrapper">
				<div class="container">
					<div class="row">

						<div class="col-lg-3">
							<nav class="account-bar">
								<ul>
									<!-- <li><a href="dashboard.php">Dashboard</a></li> -->
									<li><a href="profile.php">Profile</a></li>
									<!-- <li><a href="ongoing_projects.php">Ongoing Projects</a></li>
									<li><a href="past_projects.php">Past Projects</a></li> -->
									<li><a href="my_projects.php">My Projects</a></li>
									<li class="active"><a href="profile_settings.php">Profile Settings</a></li>
								</ul>
							</nav>
						</div>

						<div class="col-lg-9">
							<div class="account-content profile">
								<h3 class="account-title">Profile Settings</h3>
								<div class="account-main">

									<h3 style="margin-bottom: 20px;">Basic Information</h3>
									<form name="prof_set" onsubmit="return validateProf()" action="profile_settings_submit.php" method="post" enctype="multipart/form-data">
						  				<div class="field">
						  					<input name="firstname" type="text" value="<?php echo $usr_res['firstname'];?>" name="s" placeholder="First Name" />
						  				</div>
						  				<div class="field">
						  					<input name="lastname" type="text" value="<?php echo $usr_res['lastname'];?>" name="s" placeholder="Last Name" />
						  				</div>
						  				<div class="field">
						  					<input name="pitch" type="text" value="<?php echo $usr_res['pitch'];?>" name="s" placeholder="Talk to me about ..." />
						  				</div>
						  				<div class="field" style="margin-bottom: 0px; margin-top: 10px;">
						  					<p><b>Upload a New Profile Picture</b></p>
						  					<p><i>A size of 120 x 120 is preferred</i></p>

							  					<div class="file-upload">
							  						<div class="upload-bg">
								  						<div id="myfileupload">
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
						  				<h3 style="margin-bottom: 20px; margin-top: 20px;">Reset Password</h3>
						  				<div class="field">
						  					<input name="old_pass" type="password" value="" name="s" placeholder="Old Password" />
						  				</div>
						  				<div class="field">
						  					<input name="pass_signup" type="password" value="" name="s" placeholder="New Password" />
						  				</div>
						  				<div class="field">
						  					<input name="pass_signup_verify" type="password" value="" name="s" placeholder="Verify New Password" />
						  				</div>	
						  				<button name="prof_set" class="btn-primary" type="submit" style="cursor: pointer; margin-top: 5px; background-color: #73b941; padding-left: 8px; padding-right: 8px;">Save and Apply settings</button>
						  			</form>

<!-- 						  			<h3 style="margin-bottom: 20px; margin-top: 20px;">Connect with Facebook</h3>
						  			<div id="fbcenter" style="margin-bottom: 20px;">
										<div class="fb-login-button" data-max-rows="1" data-size="medium" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>
									</div> -->
								</div>
							</div>
						</div>
					</div>
				</div><!-- .container -->
			</div><!-- .account-content -->
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
    <!-- orther script -->
    <script  type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript">
    	function validateProf(){
    		var firstname = document.forms["prof_set"]["firstname"].value;
    		var lastname = document.forms["prof_set"]["lastname"].value;
    		var image=document.getElementById("uploadfile1");

    		var oldPass = document.forms["prof_set"]["old_pass"].value;
    		var newPass = document.forms["prof_set"]["pass_signup"].value;
    		var passVer = document.forms["prof_set"]["pass_signup_verify"].value;

    		if (firstname == "") {
				swal("Missing field", "Please enter your First Name", "warning");
				return false;
			}
			if (lastname == "") {
				swal("Missing field", "Please enter your Last Name", "warning");
				return false;
			}

			if(image.files.length!=0){
				console.log("imgae is there");
				var img2=image.files[0]['type'];
				if(img2.split('/')[0]!='image'){
					swal("The image filetype is not supported", "", "error");
					return false;
				}
			}
			$.ajax({
					url: 'update_server.php',
					type: 'POST',
					data: {
						'pass_chk': 1,
						'oldPass': oldPass,
					},
					success: function(data){
						
						if(Number(data)==0){
							if(newPass=="" && passVer==""){
								document.forms["prof_set"].submit();
								return true;
							}
							else{
								swal("Password Error", "Please enter your old password", "error");
								return false;
							}
						}
						else if(Number(data)==-1){
							swal("Password Error", "Incorrect old password", "error");
							return false;
						}
						else if(Number(data)==1){
							if(newPass!=passVer){
								swal("Password Error", "New passwords do not match", "error");
								return false;
							}
							else{
								document.forms["prof_set"].submit();
								return true;
							}
						}
						
					},
					error: function(jqXHR,error, errorThrown){
					
						console.log("status2: "+jqXHR.status);
						return false;
					}	


			});
			return false;


    	}

    </script>
</body>
</html>