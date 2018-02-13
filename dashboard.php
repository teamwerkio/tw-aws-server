<?php
	include("dbconnect.php");
	session_start();
	include("img_url.php");

	function timedifference($time){
		date_default_timezone_set('US/Eastern');
		$currtime=date('Y-m-d H:i:s:u');
		$currtime=strtotime($currtime);
		$time=strtotime($time);
		$diff=$currtime-$time;
		return $diff;
	}


	if(!isset($_SESSION['usr'])){
		header("Location:library.php");
	}
	else{
		$dash_sql = "SELECT * FROM users WHERE usrID='".$_SESSION['usr']."'";
		$dash_qry = mysqli_query($dbconnect, $dash_sql);
		$dash_res = mysqli_fetch_assoc($dash_qry);


		$proj_sql = "SELECT * FROM project WHERE usrID='".$_SESSION['usr']."'";
		$proj_qry=mysqli_query($dbconnect, $proj_sql);
		$proj_res=mysqli_fetch_assoc($proj_qry);
		$timediff=array();
		$times=array();

		do{
			$timediff[]=timedifference($proj_res['dt']);
			$times[]=$proj_res['dt'];
		} while($proj_res=mysqli_fetch_assoc($proj_qry));
		
		$min_times=array();
		while(count($timediff)!=0){
			if(count($min_times)==2){
				break;
			}
			else{
				$min_times[]=$times[array_search(min($timediff), $timediff)];
				unset($timediff[array_search(min($timediff), $timediff)]);
			}
		}

		
		

	}


?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard | Teamwerk</title>

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
					<a href="index.php"><img src="../images/assets/logo.png" style="width: 205px; height: 40px;" alt=""></a>
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
								<a href="#"><?php echo $dash_res['firstname']; ?><i class="fa fa-caret-down" aria-hidden="true"></i></a>
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
<!-- 			<div class="page-title background-page">
				<div class="container">
					<h1>Dashboard</h1>
					<div class="breadcrumbs">
						<ul>
							<li><a href="index.html">Home</a><span>/</span></li>
							<li>Dashboard</li>
						</ul>
					</div>
				</div>
			</div> -->
			<div style="margin-top: 20px;"></div><!-- .page-title -->
			<div class="account-wrapper">
				<div class="container">
					<div class="row">
						<div class="col-lg-3">
							<nav class="account-bar">
								<ul>
									<li class="active"><a href="dashboard.php">Dashboard</a></li>
									<li><a href="profile.php">Profile</a></li>
									<li><a href="ongoing_projects.php">Ongoing Projects</a></li>
									<li><a href="past_projects.php">Past Projects</a></li>
									<li><a href="my_projects.php">My Projects</a></li>
								</ul>
							</nav>
						</div>
						<div class="col-lg-9">
							<div class="account-content dashboard">
								<h3 class="account-title">Dashboard</h3>
								<div class="account-main">
									<div class="author clearfix">
										<a class="author-avatar" href="#">
											<?php echo '<img src="'.getimgURL($dash_res['profilepic'], "profilepic").'"/>'; ?>
										</a>
										<div class="author-content">
											<div class="author-title"><h3><a href="#"><?php echo $dash_res['firstname'].' '.$dash_res['lastname']; ?></a></h3><a class="edit-profile" href="#">Edit Profile</a></div>
											<div class="author-info">
												<p><?php echo $dash_res['email']; ?></p>
												<p>Talk to me about <?php echo $dash_res['pitch']; ?></p>
											</div>
										</div>
									</div>
									<div class="dashboard-latest" style="margin-bottom: 1px;">
										<h3>Most Recent Projects</h3>
										<ul>
											<?php
												$proj_sql = "SELECT * FROM project WHERE usrID='".$_SESSION['usr']."'";
												$proj_qry=mysqli_query($dbconnect, $proj_sql);
												$proj_res=mysqli_fetch_assoc($proj_qry);
												function returnCat($table, $col, $idx, $dbconnect){
													$cat_sql="SELECT ".$col." FROM ".$table." WHERE catID='".$idx."'";
													$cat_qry=mysqli_query($dbconnect, $cat_sql);
													$cat_res=mysqli_fetch_assoc($cat_qry);
													return $cat_res[$col];
												}
												
												$count=0;

												
												foreach ($min_times as &$time) {

													do{
														if(strcmp($proj_res['projName'], "")!==0 && $proj_res['dt']===$time && $count<2){
															$count=$count+1;
															
															?>
																<li>
																	<a href="project.php?projID=<?php echo $proj_res['projID']; ?>">
																		<?php echo '<img src="'.getimgURL($proj_res['proj_icon'], "proj_icon").'" style="height: 70px; width: 70px;" />'; ?>
																	</a>
																	<div class="dashboard-latest-box">
																		<div class="category"><a href="#"><?php echo returnCat('proj_categories', 'catName', $proj_res['catID'], $dbconnect); ?></a></div>
																		<h4><a href="project.php?projID=<?php echo $proj_res['projID']; ?>"><?php echo $proj_res['projName']; ?></a></h4>
																	</div>
																</li>

															<?php
														}


													} while($proj_res=mysqli_fetch_assoc($proj_qry));
												}

											?>
										</ul>
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