<?php
	include("dbconnect.php");
	include("img_url.php");
	session_start();
	function returnCat($table, $col, $idx, $dbconnect, $idtype){
		$cat_sql="SELECT ".$col." FROM ".$table." WHERE ".$idtype."='".$idx."'";
		$cat_qry=mysqli_query($dbconnect, $cat_sql);
		$cat_res=mysqli_fetch_assoc($cat_qry);
		return $cat_res[$col];
	}

	if(!isset($_SESSION['usr'])){
		header("Location:library.php");
	}
	else{
		$proj_sql = "SELECT * FROM project WHERE usrID=".$_SESSION['usr'];
		$proj_qry = mysqli_query($dbconnect, $proj_sql);
		$proj_res = mysqli_fetch_assoc($proj_qry);

		$prof_sql = "SELECT * FROM users WHERE usrID=".$_SESSION['usr'];
		$prof_qry = mysqli_query($dbconnect, $prof_sql);
		$prof_res = mysqli_fetch_assoc($prof_qry);

		
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Projects | Teamwerk</title>

	<!-- Style CSS -->
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />
    <link rel="icon" href="../images/favicon.png" type="image/x-icon"/>

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
								<a href="profile.php"><?php echo $prof_res['firstname']; ?><i class="fa fa-caret-down" aria-hidden="true"></i></a>
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
									<li class="active"><a href="my_projects.php">My Projects</a></li>
									<li><a href="profile_settings.php">Profile Settings</a></li>
								</ul>
							</nav>
						</div>

						<div class="col-lg-9">
							<div class="account-content profile">
								<h3 class="account-title">My Projects</h3>
								<div class="account-main">
									<div class="author clearfix">
										<a class="author-avatar" href="#">
											<?php echo '<img src="'.getimgURL($prof_res['profilepic'], 'profilepic').'"/>'; ?></a>
										<div class="author-content">
											<div class="author-title">
												<h3 style="margin-bottom: 0px;"><a style="font-size: 25px; margin-top: 30px; margin-bottom: 0px;"><?php echo $prof_res['firstname'];?> <?php echo $prof_res['lastname']; ?></a></h3>
											</div>

											<div class="author-info">
												<p><i><a href="mailto:<?php echo $prof_res['email']; ?>"><?php echo $prof_res['email']; ?></a></i></p>
												<p>Talk to me about <b><?php echo $prof_res['pitch']; ?></b></p>
											</div>
										</div>
									</div>

									<!-- my projects -->
									<div class="dashboard-latest" style="margin-bottom: 1px;">
										<h3 style="margin-bottom: 20px;">Projects started by <?php echo $prof_res['firstname'];?></h3>
										<div class="row" style="margin-left: 1px;">
											<div class="coloumn">
												<ul>

													<?php
														$half=ceil(mysqli_num_rows($proj_qry)/2);
														$count=0;
														do{
															$count+=1;
															if($count<=$half){


															?>
																<li>
																	<a href="project.php?projID=<?php echo $proj_res['projID'];?>"><img src="<?php echo getimgURL($proj_res['proj_icon'], "proj_icon");?>" style="width: 70px; height: 70px;" alt=""></a>
																	<div class="dashboard-latest-box">
																		<div class="category"><a href="#"><?php echo returnCat('proj_categories', 'catName', $proj_res['catID'], $dbconnect, 'catID');?></a></div>
																		<h4><a href="project.php?projID=<?php echo $proj_res['projID'];?>"><?php echo $proj_res['projName'];?></a></h4>
																	</div>
																</li>
															<?php

														}
														else{
															break;
														}
													}while($proj_res = mysqli_fetch_assoc($proj_qry));
													?>
<!-- 													<li>
														<a href="#"><img src="../images/placeholder/70x70.png" style="width: 70px; height: 70px;" alt=""></a>
														<div class="dashboard-latest-box">
															<div class="category"><a href="#">Film & Video</a></div>
															<h4><a href="#">Space Odyssey - The Video Game</a></h4>
														</div>
													</li>
													<li>
														<a href="#"><img src="../images/placeholder/70x70.png" style="width: 70px; height: 70px;" alt=""></a>
														<div class="dashboard-latest-box">
															<div class="category"><a href="#">Box</a></div>
															<h4><a href="#">Unbuonded: A Feature Documentary</a></h4>
														</div>
													</li>
													<li>
														<a href="#"><img src="../images/placeholder/70x70.png" style="width: 70px; height: 70px;" alt=""></a>
														<div class="dashboard-latest-box">
															<div class="category"><a href="#">Box</a></div>
															<h4><a href="#">Unbuonded: A Feature Documentary</a></h4>
														</div>
													</li>
													<li>
														<a href="#"><img src="../images/placeholder/70x70.png" style="width: 70px; height: 70px;" alt=""></a>
														<div class="dashboard-latest-box">
															<div class="category"><a href="#">Box</a></div>
															<h4><a href="#">Unbuonded: A Feature Documentary</a></h4>
														</div>
													</li> -->
												</ul>
											</div>
											<div class="coloumn" style="margin-left: 20px;">
												<ul>
													<?php
														do{
															?>
																<li>
																	<a href="project.php?projID=<?php echo $proj_res['projID'];?>"><img src="<?php echo getimgURL($proj_res['proj_icon'], "proj_icon");?>" style="width: 70px; height: 70px;" alt=""></a>
																	<div class="dashboard-latest-box">
																		<div class="category"><a href="#"><?php echo returnCat('proj_categories', 'catName', $proj_res['catID'], $dbconnect, 'catID');?></a></div>
																		<h4><a href="project.php?projID=<?php echo $proj_res['projID'];?>"><?php echo $proj_res['projName'];?></a></h4>
																	</div>
																</li>
															<?php

														}while($proj_res = mysqli_fetch_assoc($proj_qry));
													?>
													<!-- <li>
														<a href="#"><img src="../images/placeholder/70x70.png" style="width: 70px; height: 70px;" alt=""></a>
														<div class="dashboard-latest-box">
															<div class="category"><a href="#">Film & Video</a></div>
															<h4><a href="#">Space Odyssey - The Video Game</a></h4>
														</div>
													</li>
													<li>
														<a href="#"><img src="../images/placeholder/70x70.png" style="width: 70px; height: 70px;" alt=""></a>
														<div class="dashboard-latest-box">
															<div class="category"><a href="#">Box</a></div>
															<h4><a href="#">Unbuonded: A Feature Documentary</a></h4>
														</div>
													</li>
													<li>
														<a href="#"><img src="../images/placeholder/70x70.png" style="width: 70px; height: 70px;" alt=""></a>
														<div class="dashboard-latest-box">
															<div class="category"><a href="#">Box</a></div>
															<h4><a href="#">Unbuonded: A Feature Documentary</a></h4>
														</div>
													</li>
													<li>
														<a href="#"><img src="../images/placeholder/70x70.png" style="width: 70px; height: 70px;" alt=""></a>
														<div class="dashboard-latest-box">
															<div class="category"><a href="#">Box</a></div>
															<h4><a href="#">Unbuonded: A Feature Documentary</a></h4>
														</div>
													</li> -->
												</ul>
											</div>
										</div>
									</div>
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
</body>
</html>