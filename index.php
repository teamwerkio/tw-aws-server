<?php
	include("dbconnect.php");
	include("img_url.php");
	@session_start();
	if(isset($_SESSION['usr'])){
		header("Location:library.php");
	}

	function returnCat($table, $col, $idx, $dbconnect, $idtype){
		$cat_sql="SELECT ".$col." FROM ".$table." WHERE ".$idtype."='".$idx."'";
		$cat_qry=mysqli_query($dbconnect, $cat_sql);
		$cat_res=mysqli_fetch_assoc($cat_qry);
		return $cat_res[$col];
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Teamwerk | Build a team, find a team.</title>

	<!-- Style CSS -->
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />
    <link rel="icon" href="../images/favicon.png" type="image/x-icon"/>
</head>

<body class="home">
	<div id="wrapper">
		<header id="header" class="site-header">
			<div class="content-header">
				<div class="container">
					<div class="site-brand">
						<a href="index.php"><img src="../images/assets/logo.png" style="width: 205px; height: 40px;" alt=""></a>
					</div><!-- .site-brand -->
					<div class="right-header">					
						<nav class="main-menu">
						<!-- 	<button class="c-hamburger c-hamburger--htx"><span></span></button>
							<ul>
								<li>
									<a href="#">Home<i class="fa fa-caret-down" aria-hidden="true"></i></a>
									<ul class="sub-menu">
										<li><a href="index_v2.html">Home v2</a></li>
									</ul>
								</li>
								<li>
									<a href="#">Home<i class="fa fa-caret-down" aria-hidden="true"></i></a>
								</li>
							</ul> -->
						</nav>
						<div class="login login-button" style="margin-left: 35px;">
							<a href="login.php" class="btn-secb" style="height: 38px; margin-right: 5px; line-height: 34px; border-radius: 2px;">Log in</a>
						</div><!-- .login -->
						<!-- <div class="login login-button" style="margin-left: 0px;">
							<a href="#" class="btn-primary">Sign up</a>
						</div> -->
					</div><!--. right-header -->
				</div><!-- .container -->
			</div>
		</header><!-- .site-header -->

		<main id="main" class="site-main">
			<div class="sideshow">
				<div class="container">
					<div class="sideshow-content">
						<h1 class="wow fadeInUp" data-wow-delay=".1s">Share your project idea. Build a team, join a team.</h1>
						<div class="sideshow-description wow fadeInUp" data-wow-delay=".1s">Find student collaborators, makers and co-founders from your college, who can help you build your next big project.</div>
						<div data-wow-delay="0.3s">
							<!-- <a href="#" class="btn-secondary">See Campaign</a> -->
							<a href="register.php" class="btn-primary">Create an account</a>
						</div>
					</div><!-- .sideshow-content -->
				</div>
			</div><!-- .sideshow -->
			<div class="how-it-work" style="margin-top: 0px;">
				<div class="container">
					<h2 class="title">What is Teamwerk?</h2>
					<div class="description">Have a project idea? Don't know where to find people to help you?<br>Teamwerk is a team building platform for your college community that gives you a place to team up and launch projects.</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="item-work wow fadeInUp" data-wow-delay=".1s">
								<div class="item-icon"><span>01</span><i class="fa fa-rocket" aria-hidden="true"></i></div>
								<div class="item-content">
									<h3 class="item-title">Build a team</h3>
									<div class="item-desc" style="font-size: 90%"><p>Share your project idea, list your project needs (e.g. designers, programmers, actors, etc.) and find other students who can help!</p></div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="item-work wow fadeInUp" data-wow-delay=".1s">
								<div class="item-icon"><span>02</span><i class="fa fa-search" aria-hidden="true"></i></div>
								<div class="item-content">
									<h3 class="item-title">Join a team</h3>
									<div class="item-desc" style="font-size: 90%;"><p>Find and join new projects from your and nearby colleges. Get experience working with other students and build a solid resume.</p></div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="item-work wow fadeInUp" data-wow-delay=".1s">
								<div class="item-icon"><span>03</span><i class="fa fa-dollar" aria-hidden="true"></i></div>
								<div class="item-content">
									<h3 class="item-title">Get funded</h3>
									<div class="item-desc" style="font-size: 89%"><p>By posting your project on Teamwerk, you can find funding too! We work with grant providers and investors to help them find your project.</p></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div><!-- .how-it-work -->
			<div class="latest campaign">
				<div class="container">
					<h2 class="title" data-wow-delay=".1s">Discover Projects</h2>
<!-- 					<div class="campaign-tabs filter-theme" data-wow-delay=".1s">
						<button class="button is-checked" data-filter=".filterinteresting">Featured</button>
						<button class="button" data-filter=".filtersuccessful">Technology</button>
						<button class="button" data-filter=".filterpopular">Performing Arts</button>
						<button class="button" data-filter=".filterlatest">Film and Video</button>
					</div> -->
					<div class="campaign-content grid">
						<div class="row">

							<?php
								$feat_sql="SELECT * FROM project";
								$feat_qry=mysqli_query($dbconnect, $feat_sql);
								$feat_res=mysqli_fetch_assoc($feat_qry);
								$feat_array=array();
								do{
									$curr_json=json_decode($feat_res['subs'], true);
									$sub_size=count($curr_json["subs"]);
									$curr_arr=array('id' => $feat_res['projID'], 'count'=>$sub_size);
									if(empty($feat_array)){array_push($feat_array, $curr_arr);}
									elseif ($feat_array[0]['count']<=$curr_arr['count']) {
										array_unshift($feat_array, $curr_arr);
									}
									else{
										array_push($feat_array, $curr_arr);
									}

								}while($feat_res=mysqli_fetch_assoc($feat_qry));

								$feat_count=0;

								foreach ($feat_array as $feat) {
									$item_sql="SELECT * FROM project WHERE projID=".$feat['id'];
									$item_qry=mysqli_query($dbconnect, $item_sql);
									$item_res=mysqli_fetch_assoc($item_qry);
									if($feat_count<6){
										$feat_count+=1;


									?>
										<div class="col-lg-4 col-md-6 col-sm-6 col-6 filterinteresting filterpopular filterlatest">
											<div class="campaign-item wow fadeInUp" data-wow-delay=".1s">
												<a class="overlay" href="projectOffline.php?projID=<?php echo $feat['id'];?>&viewOff=true">
													<img src="<?php echo getimgURL($item_res['small_ban'], "banner_small");?>" alt="">
													<span class="ion-paper-airplane"></span>
												</a>
												<div class="campaign-box">
													<a href="#" class="category"><?php echo returnCat('proj_categories', 'catName', $item_res['catID'], $dbconnect, 'catID');?></a>
													<h3><a href="projectOffline.php?projID=<?php echo $feat['id'];?>&viewOff=true"><?php echo $item_res['projName'];?></a></h3>
													<div class="campaign-description"><?php echo $item_res['sm_desc'];?></div>
													<div class="campaign-author"><a class="author-icon" href="#"><img src="<?php echo getimgURL(returnCat('users', 'profilepic', $item_res['usrID'], $dbconnect, 'usrID'), "profilepic");?>" alt=""></a>by <a class="author-name" href="#"><?php echo returnCat('users', 'firstname', $item_res['usrID'], $dbconnect, 'usrID');?></a></div>
													<div class="process">
														<div class="raised"><span style="width: <?php echo $item_res['progress'];?>%;"></span></div>
														<div class="process-info">

															<div class="process-pledged"><span><?php
																		$json=$item_res['subs'];
																		$json=json_decode($json, true);
																		echo count($json['subs']);?></span>interest</div>

																	<?php
																		$size_id=$item_res['tsizeID'];
																		if($size_id==1){
																			?>
																			<!-- Small Team -->
																			<div class="process-pledged"><span>
																				<a data-tooltip="Small team">
																				<i class="fa fa-user"></i>
																				<i class="fa fa-user"></i></a>
																			</span>team size</div>
																			<?php
																		}
																		elseif ($size_id==2) {
																			?>
																			<!-- Medium Team -->
																			<div class="process-pledged"><span>
																				<a data-tooltip="Medium team">
																				<i class="fa fa-user"></i>
																				<i class="fa fa-user"></i>
																				<i class="fa fa-user"></i></a>
																			</span>team size</div>
																			<?php
																		}
																		elseif ($size_id==3) {
																			?>
																			<!-- Large Team -->
																			<div class="process-pledged"><span>
																				<a data-tooltip="Large team">
																				<i class="fa fa-user"></i>
																				<i class="fa fa-user"></i>
																				<i class="fa fa-user"></i>
																				<i class="fa fa-user"></i></a>
																			</span>team size</div>
																			<?php
																		}
																		elseif ($size_id==4) {
																			?>
																			<!-- Extra Large Team -->
																			<div class="process-pledged"><span>
																				<a data-tooltip="Extra large team">
																				<i class="fa fa-user"></i>
																				<i class="fa fa-user"></i>
																				<i class="fa fa-user"></i>
																				<i class="fa fa-user-plus"></i></a>
																			</span>team size</div>
																			<?php
																		}
																	?>
																	<?php
																		$inv_id=$item_res['commID'];
																		if($inv_id==1){
																			?>
																			<!-- < 10 hrs/week -->
																			<div class="process-time"><span>
																				<a data-tooltip="< 10 hrs/week (approx.)">
																				<i class="fa fa-clock-o"></i></a>
																			</span>involvement</div>
																			<?php
																		}
																		elseif ($inv_id==2) {
																			?>
																			<!-- 11 to 20 hrs/week -->
																			<div class="process-time"><span>
																				<a data-tooltip="11 to 20 hrs/week (approx.)">
																				<i class="fa fa-clock-o"></i>
																				<i class="fa fa-clock-o"></i></a>
																			</span>involvement</div>
																			<?php
																		}
																		elseif ($inv_id==3) {
																			?>
																			<!-- 21 to 30 hrs/week -->
																			<div class="process-time"><span>
																				<a data-tooltip="21 to 30 hrs/week (approx.)">
																				<i class="fa fa-clock-o"></i>
																				<i class="fa fa-clock-o"></i>
																				<i class="fa fa-clock-o"></i></a>
																			</span>involvement</div>
																			<?php
																		}
																		elseif ($inv_id==4) {
																			?>
																			<!-- > 31 hrs/week -->
																			<div class="process-time"><span>
																				<a data-tooltip="> 31 hrs/week (approx.)">
																				<i class="fa fa-clock-o"></i>
																				<i class="fa fa-clock-o"></i>
																				<i class="fa fa-clock-o"></i>
																				<i class="fa fa-clock-o"></i></a>
																			</span>involvement</div>
																			<?php
																		}
																	?>
<!-- 															<div class="process-pledged"><span>$630</span>interest</div>
															<div class="process-funded"><span>26%</span>teamsize</div>
															<div class="process-time"><span>2</span>involvement</div> -->
														</div>
													</div>
												</div>
											</div>
										</div>
									<?php
								}}



							?>
<!-- 							<div class="col-lg-4 col-md-6 col-sm-6 col-6 filterinteresting filterpopular filterlatest">
								<div class="campaign-item wow fadeInUp" data-wow-delay=".1s">
									<a class="overlay" href="campaign_detail.html">
										<img src="../images/placeholder/370x240.png" alt="">
										<span class="ion-paper-airplane"></span>
									</a>
									<div class="campaign-box">
										<a href="#" class="category">Crafts</a>
										<h3><a href="campaign_detail.html">The Oreous Pillow</a></h3>
										<div class="campaign-description">A watch designed to be an heirloom to be passed down to the next generation.</div>
										<div class="campaign-author"><a class="author-icon" href="#"><img src="../images/placeholder/35x35.png" alt=""></a>by <a class="author-name" href="#">Sabato Alterio</a></div>
										<div class="process">
											<div class="raised"><span></span></div>
											<div class="process-info">
												<div class="process-pledged"><span>$630</span>interest</div>
												<div class="process-funded"><span>26%</span>teamsize</div>
												<div class="process-time"><span>2</span>involvement</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-6 col-sm-6 col-6 filterinteresting filterlatest">
								<div class="campaign-item wow fadeInUp" data-wow-delay=".1s">
									<a class="overlay" href="campaign_detail.html">
										<img src="../images/placeholder/370x240.png" alt="">
										<span class="ion-paper-airplane"></span>
									</a>
									<div class="campaign-box">
										<a href="#" class="category">Crafts</a>
										<h3><a href="campaign_detail.html">The Oreous Pillow</a></h3>
										<div class="campaign-description">A watch designed to be an heirloom to be passed down to the next generation.</div>
										<div class="campaign-author"><a class="author-icon" href="#"><img src="../images/placeholder/35x35.png" alt=""></a>by <a class="author-name" href="#">Sabato Alterio</a></div>
										<div class="process">
											<div class="raised"><span></span></div>
											<div class="process-info">
												<div class="process-pledged"><span>$630</span>interest</div>
												<div class="process-funded"><span>26%</span>teamsize</div>
												<div class="process-time"><span>2</span>involvement</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-6 col-sm-6 col-6 filterinteresting filterpopular">
								<div class="campaign-item wow fadeInUp" data-wow-delay=".1s">
									<a class="overlay" href="campaign_detail.html">
										<img src="../images/placeholder/370x240.png" alt="">
										<span class="ion-paper-airplane"></span>
									</a>
									<div class="campaign-box">
										<a href="#" class="category">Crafts</a>
										<h3><a href="campaign_detail.html">The Oreous Pillow</a></h3>
										<div class="campaign-description">A watch designed to be an heirloom to be passed down to the next generation.</div>
										<div class="campaign-author"><a class="author-icon" href="#"><img src="../images/placeholder/35x35.png" alt=""></a>by <a class="author-name" href="#">Sabato Alterio</a></div>
										<div class="process">
											<div class="raised"><span></span></div>
											<div class="process-info">
												<div class="process-pledged"><span>$630</span>interest</div>
												<div class="process-funded"><span>26%</span>teamsize</div>
												<div class="process-time"><span>2</span>involvement</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-6 col-sm-6 col-6 filterinteresting filterlatest">
								<div class="campaign-item wow fadeInUp" data-wow-delay=".1s">
									<a class="overlay" href="campaign_detail.html">
										<img src="../images/placeholder/370x240.png" alt="">
										<span class="ion-paper-airplane"></span>
									</a>
									<div class="campaign-box">
										<a href="#" class="category">Crafts</a>
										<h3><a href="campaign_detail.html">The Oreous Pillow</a></h3>
										<div class="campaign-description">A watch designed to be an heirloom to be passed down to the next generation.</div>
										<div class="campaign-author"><a class="author-icon" href="#"><img src="../images/placeholder/35x35.png" alt=""></a>by <a class="author-name" href="#">Sabato Alterio</a></div>
										<div class="process">
											<div class="raised"><span></span></div>
											<div class="process-info">
												<div class="process-pledged"><span>$630</span>interest</div>
												<div class="process-funded"><span>26%</span>teamsize</div>
												<div class="process-time"><span>2</span>involvement</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-6 col-sm-6 col-6 filterinteresting">
								<div class="campaign-item wow fadeInUp" data-wow-delay=".1s">
									<a class="overlay" href="campaign_detail.html">
										<img src="../images/placeholder/370x240.png" alt="">
										<span class="ion-paper-airplane"></span>
									</a>
									<div class="campaign-box">
										<a href="#" class="category">Crafts</a>
										<h3><a href="campaign_detail.html">The Oreous Pillow</a></h3>
										<div class="campaign-description">A watch designed to be an heirloom to be passed down to the next generation.</div>
										<div class="campaign-author"><a class="author-icon" href="#"><img src="../images/placeholder/35x35.png" alt=""></a>by <a class="author-name" href="#">Sabato Alterio</a></div>
										<div class="process">
											<div class="raised"><span></span></div>
											<div class="process-info">
												<div class="process-pledged"><span>$630</span>interest</div>
												<div class="process-funded"><span>26%</span>teamsize</div>
												<div class="process-time"><span>2</span>involvement</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-6 col-sm-6 col-6 filterinteresting filterpopular">
								<div class="campaign-item wow fadeInUp" data-wow-delay=".1s">
									<a class="overlay" href="campaign_detail.html">
										<img src="../images/placeholder/370x240.png" alt="">
										<span class="ion-paper-airplane"></span>
									</a>
									<div class="campaign-box">
										<a href="#" class="category">Crafts</a>
										<h3><a href="campaign_detail.html">The Oreous Pillow</a></h3>
										<div class="campaign-description">A watch designed to be an heirloom to be passed down to the next generation.</div>
										<div class="campaign-author"><a class="author-icon" href="#"><img src="../images/placeholder/35x35.png" alt=""></a>by <a class="author-name" href="#">Sabato Alterio</a></div>
										<div class="process">
											<div class="raised"><span></span></div>
											<div class="process-info">
												<div class="process-pledged"><span>$630</span>interest</div>
												<div class="process-funded"><span>26%</span>teamsize</div>
												<div class="process-time"><span>2</span>involvement</div>
											</div>
										</div>
									</div>
								</div>
							</div> -->
						</div>
					</div>
					<div class="latest-button"><a href="login.php" class="btn-primary">View all projects</a></div>
				</div>
			</div><!-- .latest -->
			<!-- <div class="story">
				<div class="container">
					<h2 class="title wow fadeInUp" data-wow-delay=".1s">Project Creators Who Love Us</h2>
					<div class="description wow fadeInUp" data-wow-delay=".1s">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</div>
					<div class="story-content">
						<div class="story-slider">
							<div class="story-item wow fadeInUp" data-wow-delay=".1s">
								<div class="story-thumb">
									<div class="thumb-image"><img src="../images/placeholder/370x220.png" alt=""></div>
									<h3 class="story-title"><a href="#">The Oreous Pillow</a></h3>
								</div>
								<div class="story-info">
									<div class="author-avatar"><img src="../images/placeholder/70x70.png" alt=""></div>
									<a href="#" class="author-name">Samino</a>
									<div class="story-desc"><p>We've tried it both ways—doing it by hand for our first campaign, and using Ideabox for our second. Omnicos directe al desirabilite de un nov lingua franca</p></div>
									<a href="#" class="read-more">Read the Story</a>
								</div>
							</div>
							<div class="story-item wow fadeInUp" data-wow-delay=".1s">
								<div class="story-thumb">
									<div class="thumb-image"><img src="../images/placeholder/370x220.png" alt=""></div>
									<h3 class="story-title"><a href="#">Learning 4 Kids Early Childhood</a></h3>
								</div>
								<div class="story-info">
									<div class="author-avatar"><img src="../images/placeholder/70x70.png" alt=""></div>
									<a href="#" class="author-name">Andrew</a>
									<div class="story-desc"><p>A un Angleso it va semblar un simplificat Angles, quam un skeptic Cambridge amico dit me que Occidental es. Li Europan lingues es membres del sam familie.</p></div>
									<a href="#" class="read-more">Read the Story</a>
								</div>
							</div>
							<div class="story-item wow fadeInUp" data-wow-delay=".1s">
								<div class="story-thumb">
									<div class="thumb-image"><img src="../images/placeholder/370x220.png" alt=""></div>
									<h3 class="story-title"><a href="#">Digital Comics for Mobile</a></h3>
								</div>
								<div class="story-info">
									<div class="author-avatar"><img src="../images/placeholder/70x70.png" alt=""></div>
									<a href="#" class="author-name">Andy Yuri</a>
									<div class="story-desc"><p>Lor separat existentie es un myth. Por scientie, musica, sport etc, litot Europa usa li sam vocabular. Li lingues differe solmen in li grammatica, li pronunciation e li plu commun vocabules.</p></div>
									<a href="#" class="read-more">Read the Story</a>
								</div>
							</div>
							<div class="story-item wow fadeInUp" data-wow-delay=".1s">
								<div class="story-thumb">
									<div class="thumb-image"><img src="../images/placeholder/370x220.png" alt=""></div>
									<h3 class="story-title"><a href="#">Digital Comics for Mobile</a></h3>
								</div>
								<div class="story-info">
									<div class="author-avatar"><img src="../images/placeholder/70x70.png" alt=""></div>
									<a href="#" class="author-name">Andy Yuri</a>
									<div class="story-desc"><p>Lor separat existentie es un myth. Por scientie, musica, sport etc, litot Europa usa li sam vocabular. Li lingues differe solmen in li grammatica, li pronunciation e li plu commun vocabules.</p></div>
									<a href="#" class="read-more">Read the Story</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> --><!-- .story -->
			<!-- <div class="partners">
				<div class="container">
					<div class="partners-slider">
						<div><a href="#"><img src="../images/partner-01.png" alt=""></a></div>
						<div><a href="#"><img src="../images/partner-02.png" alt=""></a></div>
						<div><a href="#"><img src="../images/partner-03.png" alt=""></a></div>
						<div><a href="#"><img src="../images/partner-04.png" alt=""></a></div>
						<div><a href="#"><img src="../images/partner-05.png" alt=""></a></div>
						<div><a href="#"><img src="../images/partner-06.png" alt=""></a></div>
					</div>
				</div>
			</div> -->
			<!-- .partners -->
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