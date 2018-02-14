<?php
	include("dbconnect.php");
	session_start();
	include("img_url.php");


	function timedifference_d($time){
		date_default_timezone_set('US/Eastern');
		$currtime=new DateTime();
		$time=new DateTime($time);
		$interval=$currtime->diff($time);
		return $interval->format('%a');
	}


	function returnCat($table, $col, $idx, $dbconnect, $idtype){
		$cat_sql="SELECT ".$col." FROM ".$table." WHERE ".$idtype."='".$idx."'";
		$cat_qry=mysqli_query($dbconnect, $cat_sql);
		$cat_res=mysqli_fetch_assoc($cat_qry);
		return $cat_res[$col];
	}
	
	if(!isset($_SESSION['usr'])){
		header("Location:usr.php");
	}
	else{
		$home_sql = "SELECT * FROM users WHERE usrID='".$_SESSION['usr']."'";
		$home_qry = mysqli_query($dbconnect, $home_sql);
		$home_res = mysqli_fetch_assoc($home_qry);
		$tab_disp=$home_res['firstname'];
	}
	$proj_sql = "SELECT * FROM project";
	$proj_qry=mysqli_query($dbconnect, $proj_sql);
	$proj_res=mysqli_fetch_assoc($proj_qry);

	$trending_proj_id=0;
	do{
		$json_dec=json_decode($proj_res['tags'], true);
		if(@$json_dec["trending"]==true){
			$trending_proj_id=$proj_res['projID'];
		}
	}while($proj_res=mysqli_fetch_assoc($proj_qry));
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Library | Teamwerk</title>

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
					<h1>Discover projects</h1>
					<div class="breadcrumbs">
						<ul>
							<li><a href="index.html">Home</a><span>/</span></li>
							<li>Layout</li>
						</ul>
					</div>
				</div>
			</div> -->
			<div style="margin-top: 20px;"></div><!-- .page-title -->
			<!-- <div class="campaigns-action clearfix">
				<div class="container">
					<div class="sort">
						<span>Sort by:</span>
						<ul>
							<li class="active"><a href="#">Recent Project</a></li>
							<li><a href="#">Most Project</a></li>
						</ul>	
					</div>
					<div class="filter">
						<span>Filter by:</span>
						<form action="">
							<div class="field-select">
								<select name="" id="">
									<option value="">All Stages</option>
									<option value="">Pending</option>
									<option value="">Cancel</option>
									<option value="">Completed</option>
								</select>
							</div>
							<div class="field-select">
								<select name="" id="">
									<option value="">All Category</option>
									<option value="">Design & Art</option>
									<option value="">Book</option>
									<option value="">Perfomances</option>
									<option value="">Technology</option>
								</select>
							</div>
						</form>
					</div>
				</div>
			</div> --><!-- .campaigns-action -->
			<div class="campaigns">
				<div class="container">
					<div class="campaign-content">
						<div class="row" id="lib-pg">
							<?php
								$trend_sql="SELECT * FROM project where projID='".$trending_proj_id."'";
								$trend_qry=mysqli_query($dbconnect, $trend_sql);
								$trend_res=mysqli_fetch_assoc($trend_qry);

								$days_elapsed=timedifference_d($trend_res['dt']);
								$cat=returnCat('proj_categories', 'catName', $trend_res['catID'], $dbconnect, 'catID');
								$owner_f=returnCat('users', 'firstname', $trend_res['usrID'], $dbconnect, 'usrID');
								$owner_l=returnCat('users', 'lastname', $trend_res['usrID'], $dbconnect, 'usrID');
								$owner_p=returnCat('users', 'profilepic', $trend_res['usrID'], $dbconnect, 'usrID');
								$proj_col=returnCat('colleges', 'colName', $trend_res['colID'], $dbconnect, 'colID');
							?>
							<div class="col-lg-12">
								<div class="campaign-big-item clearfix wow fadeInUp" data-id="<?php echo $trending_proj_id;?>">
									<a  href="project.php?projID=<?php echo $trending_proj_id;?>" class="trend campaign-big-image" style="height: 350px; width: 570px;">
										<?php echo '<img src="'.getimgURL($trend_res['big_ban'], "banner_big").'" style="height: 350px; width: 570px;" />'; ?>		
									</a>
									<div class="campaign-big-box wow fadeInUp" data-wow-delay=".1s">
										<a href="#" class="category"><?php echo $cat; ?></a>
										<h3><a class="trend" href="project.php?projID=<?php echo $trending_proj_id;?>"><?php echo $trend_res['projName']; ?></a></h3>
										<div class="campaign-description"><?php echo $trend_res['sm_desc']; ?></div>
										<div class="staff-picks-author">
											<div class="author-profile">
												<a class="author-avatar" href="profile.php?other_usr=<?php echo $trend_res['usrID']; ?>"><?php echo '<img src="'.getimgURL($owner_p, "profilepic").'" />'; ?></a>by <a class="author-name" href="profile.php?other_usr=<?php echo $trend_res['usrID']; ?>"><?php echo $owner_f.' '.$owner_l; ?></a>
											</div>
											<div class="author-address"><span class="ion-location"></span><?php echo $proj_col; ?>, Amherst, MA</div>
										</div>
										<div class="process">
											<div class="raised"><span style="width: <?php echo $trend_res
											['progress']; ?>%;"></span></div>
											<div class="process-info">
												<div class="process-pledged"><span><?php
																		$json=$trend_res['subs'];
																		$json=json_decode($json, true);
																		echo count($json['subs']);?></span>interest</div>
													<?php
														$size_id=$trend_res['tsizeID'];
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
														$inv_id=$trend_res['commID'];
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
												<!-- <div class="process-time"><span style="color: green;"><?php echo $trend_res['virality']; ?>%</span>involvement</div> -->
												<div class="process-time"><span>
												<a data-tooltip="Project started <?php echo timedifference_d($trend_res['dt']);?> days ago">
													<?php echo timedifference_d($trend_res['dt']);?>
												</a>
												</span>days ago</div>
											</div>
										</div>
									</div>
								</div>
							</div>


							<?php

								$proj_sql = "SELECT * FROM project LIMIT 10";
								$proj_qry=mysqli_query($dbconnect, $proj_sql);
								$proj_res=mysqli_fetch_assoc($proj_qry);
								$count=0;
								$final_id=0;

								do{
									if($proj_res['projID']!==$trending_proj_id && $count<9){
										$count+=1;
										$cat=returnCat('proj_categories', 'catName', $proj_res['catID'], $dbconnect, 'catID');
										$owner_f=returnCat('users', 'firstname', $proj_res['usrID'], $dbconnect, 'usrID');
										$owner_p=returnCat('users', 'profilepic', $proj_res['usrID'], $dbconnect, 'usrID');
										?>
											<div class="col-lg-4 col-sm-6 col-6" data-id2="<?php echo $proj_res['projID']; ?>">
												<div class="campaign-item wow fadeInUp" data-wow-delay=".1s">
													<a class="overlay content" style="height: 240px;" href="project.php?projID=<?php echo $proj_res['projID']; ?>">
														<?php echo '<img src="'.getimgURL($proj_res['small_ban'], "banner_small").'" style="height: 240px;" />'; ?>
														<span class="ion-paper-airplane"></span>
													</a>
													<div class="campaign-box">
														<a href="#" class="category"><?php echo $cat; ?></a>
														<h3><a class="content" href="project.php?projID=<?php echo $proj_res['projID']; ?>"><?php echo $proj_res['projName']; ?></a></h3>
														<div class="campaign-description"><?php echo $proj_res['sm_desc']; ?></div>
														<div class="campaign-author"><a class="author-icon" href="profile.php?other_usr=<?php echo $proj_res['usrID']; ?>">
															<?php echo '<img src="'.getimgURL($owner_p, "profilepic").'" />'; ?></a>by <a class="author-name" href="profile.php?other_usr=<?php echo $proj_res['usrID']; ?>"><?php echo $owner_f; ?>		
														</a></div>
														<div class="process">
															<div class="raised"><span style="width: <?php echo $proj_res['progress'];?>%;"></span></div>
															<div class="process-info">
																<div class="process-pledged"><span><?php
																		$json=$proj_res['subs'];
																		$json=json_decode($json, true);
																		echo count($json['subs']);?></span>interest</div>
<!-- 																<div class="process-funded"><span>
																	<?php
																		$json=$proj_res['subs'];
																		$json=json_decode($json, true);
																		echo count($json['subs']);?></span>teamsize</div> -->

																	<?php
																		$size_id=$proj_res['tsizeID'];
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
																		$inv_id=$proj_res['commID'];
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
															</div>
														</div>
													</div>
												</div>
											</div>
										<?php
										$final_id=$proj_res['projID'];

								}}while($proj_res=mysqli_fetch_assoc($proj_qry));

							?>											
							<!-- <div class="col-lg-4 col-sm-6 col-6">
								<div class="campaign-item wow fadeInUp" data-wow-delay=".1s">
									<a class="overlay" href="project.php">
										<img src="../images/placeholder/370x240.png" alt="">
										<span class="ion-ios-search-strong"></span>
									</a>
									<div class="campaign-box">
										<a href="#" class="category">Book</a>
										<h3><a href="project.php">The Everlast Notebook</a></h3>
										<div class="campaign-description">One smart, reusable notebook to last the rest of your life? That's not magic, that's the Everlast.</div>
										<div class="campaign-author"><a class="author-icon" href="#"><img src="../images/placeholder/35x35.png" alt=""></a>by <a class="author-name" href="#">Samino</a></div>
										<div class="process">
											<div class="raised"><span style="width: 40%;"></span></div>
											<div class="process-info">
												<div class="process-pledged"><span>280</span>upvotes</div>
												<div class="process-funded"><span>26%</span>interest</div>
												<div class="process-time"><span style="color: green;">23%</span>virality</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-6 col-6">
								<div class="campaign-item wow fadeInUp" data-wow-delay=".1s">
									<a class="overlay" href="project.php">
										<img src="../images/placeholder/370x240.png" alt="">
										<span class="ion-ios-search-strong"></span>
									</a>
									<div class="campaign-box">
										<a href="#" class="category">Perfomances</a>
										<h3><a href="project.php">Uncompromising Ski Gear</a></h3>
										<div class="campaign-description">The Orsden Slope Pants don't compromise delivering performance, fit, and value directly to you</div>
										<div class="campaign-author"><a class="author-icon" href="#"><img src="../images/placeholder/35x35.png" alt=""></a>by <a class="author-name" href="#">Andrew Noah</a></div>
										<div class="process">
											<div class="raised"><span style="width: 21%;"></span></div>
											<div class="process-info">
												<div class="process-pledged"><span>280</span>upvotes</div>
												<div class="process-funded"><span>26%</span>interest</div>
												<div class="process-time"><span style="color: red;">19%</span>virality</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-6 col-6">
								<div class="campaign-item wow fadeInUp" data-wow-delay=".1s">
									<a class="overlay" href="project.php">
										<img src="../images/placeholder/370x240.png" alt="">
										<span class="ion-ios-search-strong"></span>
									</a>
									<div class="campaign-box">
										<a href="#" class="category">Technology</a>
										<h3><a href="project.php">Smart Wallet with Solar Charge</a></h3>
										<div class="campaign-description">A wonderful serenity has taken possession of my entire soul, like these sweet mornings.</div>
										<div class="campaign-author"><a class="author-icon" href="#"><img src="../images/placeholder/35x35.png" alt=""></a>by <a class="author-name" href="#">Andrew Noah</a></div>
										<div class="process">
											<div class="raised"><span style="width: 56%;"></span></div>
											<div class="process-info">
												<div class="process-pledged"><span>280</span>upvotes</div>
												<div class="process-funded"><span>26%</span>interest</div>
												<div class="process-time"><span style="color: red;">19%</span>virality</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-6 col-6">
								<div class="campaign-item wow fadeInUp" data-wow-delay=".1s">
									<a class="overlay" href="project.php">
										<img src="../images/placeholder/370x240.png" alt="">
										<span class="ion-ios-search-strong"></span>
									</a>
									<div class="campaign-box">
										<a href="#" class="category">Technology</a>
										<h3><a href="project.php">Redefine Your VR Experience</a></h3>
										<div class="campaign-description">I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot.</div>
										<div class="campaign-author"><a class="author-icon" href="#"><img src="../images/placeholder/35x35.png" alt=""></a>by <a class="author-name" href="#">Sabato Alterio</a></div>
										<div class="process">
											<div class="raised"><span style="width: 89%;"></span></div>
											<div class="process-info">
												<div class="process-pledged"><span>280</span>upvotes</div>
												<div class="process-funded"><span>26%</span>interest</div>
												<div class="process-time"><span style="color: red;">19%</span>virality</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-6 col-6">
								<div class="campaign-item wow fadeInUp" data-wow-delay=".1s">
									<a class="overlay" href="project.php">
										<img src="../images/placeholder/370x240.png" alt="">
										<span class="ion-ios-search-strong"></span>
									</a>
									<div class="campaign-box">
										<a href="#" class="category">Design &amp; Art</a>
										<h3><a href="project.php">Bring back Fun House</a></h3>
										<div class="campaign-description">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</div>
										<div class="campaign-author"><a class="author-icon" href="#"><img src="../images/placeholder/35x35.png" alt=""></a>by <a class="author-name" href="#">Samino</a></div>
										<div class="process">
											<div class="raised"><span style="width: 91%;"></span></div>
											<div class="process-info">
												<div class="process-pledged"><span>280</span>upvotes</div>
												<div class="process-funded"><span>26%</span>interest</div>
												<div class="process-time"><span style="color: red;">19%</span>virality</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-6 col-6">
								<div class="campaign-item wow fadeInUp" data-wow-delay=".1s">
									<a class="overlay" href="project.php">
										<img src="../images/placeholder/370x240.png" alt="">
										<span class="ion-ios-search-strong"></span>
									</a>
									<div class="campaign-box">
										<a href="#" class="category">Technology</a>
										<h3><a href="project.php">Smart Wallet with Solar Charge</a></h3>
										<div class="campaign-description">A wonderful serenity has taken possession of my entire soul, like these sweet mornings.</div>
										<div class="campaign-author"><a class="author-icon" href="#"><img src="../images/placeholder/35x35.png" alt=""></a>by <a class="author-name" href="#">Andrew Noah</a></div>
										<div class="process">
											<div class="raised"><span style="width: 29%;"></span></div>
											<div class="process-info">
												<div class="process-pledged"><span>280</span>upvotes</div>
												<div class="process-funded"><span>26%</span>interest</div>
												<div class="process-time"><span style="color: red;">19%</span>virality</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-6 col-6">
								<div class="campaign-item wow fadeInUp" data-wow-delay=".1s">
									<a class="overlay" href="project.php">
										<img src="../images/placeholder/370x240.png" alt="">
										<span class="ion-ios-search-strong"></span>
									</a>
									<div class="campaign-box">
										<a href="#" class="category">Technology</a>
										<h3><a href="project.php">Redefine Your VR Experience</a></h3>
										<div class="campaign-description">I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot.</div>
										<div class="campaign-author"><a class="author-icon" href="#"><img src="../images/placeholder/35x35.png" alt=""></a>by <a class="author-name" href="#">Sabato Alterio</a></div>
										<div class="process">
											<div class="raised"><span style="width: 44%;"></span></div>
											<div class="process-info">
												<div class="process-pledged"><span>280</span>upvotes</div>
												<div class="process-funded"><span>26%</span>interest</div>
												<div class="process-time"><span style="color: red;">19%</span>virality</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-6 col-6">
								<div class="campaign-item wow fadeInUp" data-wow-delay=".1s">
									<a class="overlay" href="project.php">
										<img src="../images/placeholder/370x240.png" alt="">
										<span class="ion-ios-search-strong"></span>
									</a>
									<div class="campaign-box">
										<a href="#" class="category">Design &amp; Art</a>
										<h3><a href="project.php">Bring back Fun House</a></h3>
										<div class="campaign-description">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</div>
										<div class="campaign-author"><a class="author-icon" href="#"><img src="../images/placeholder/35x35.png" alt=""></a>by <a class="author-name" href="#">Samino</a></div>
										<div class="process">
											<div class="raised"><span style="width: 48%;"></span></div>
											<div class="process-info">
												<div class="process-pledged"><span>280</span>upvotes</div>
												<div class="process-funded"><span>26%</span>interest</div>
												<div class="process-time"><span style="color: red;">19%</span>virality</div>
											</div>
										</div>
									</div>
								</div>
							</div> -->
						</div>
					</div>
					
					<div class="latest-button wow fadeInUp" name="loading" data-wow-delay=".1s" ><a data-finalID="<?php echo $final_id;?>" id="load_more" href="#" class="btn-primary">Load more</a></div>

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
    <!-- orther script -->
    <script  type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript">
    	var trend=<?php echo $trending_proj_id;?>;


    	$(document).ready(function(){
    		$(".trend").click(function(){
    			var button=$(this);
    			
    			$.ajax({
    				url: 'update_server.php',
    				type: 'POST',
    				data: {
    					'clicked': 1,
    					'projID': button.closest('.clearfix').data("id"),
    					'usrID': <?php echo $_SESSION['usr'];?>,
    				},
    				success: function(data){
    					
    				}
    			});
    		});
    		$(".content").click(function(){
    			var button=$(this);
 				
    			$.ajax({
    				url: 'update_server.php',
    				type: 'POST',
    				data: {
    					'clicked': 1,
    					'projID': button.closest('.col-sm-6').data("id2"),
    					'usrID': <?php echo $_SESSION['usr'];?>,
    				},
    				success: function(data){

    				}
    			});
    			
    		});
    	});


    	$(document).on('click', '#load_more', function(){
    		var button=$(this);
    		var finID=button.attr("data-finalID");
    		button.html("Loading...");
    		$.ajax({
    			url: 'load_more_req.php',
    			type: 'POST',
    			data: {
    				'load': 1,
    				'finID': finID,
    				'trend': trend,
    			},
    			success: function(data){
    				if(data==="0"){
    					button.html("All showing");

    				}
    				else{
    					var json=JSON.parse(data);
    					
    					$("#lib-pg").append(json.html);
    					if(json.count==="0"){
    						button.html("All showing");
    					}
    					else{
    						$("#load_more").attr("data-finalID",json.final);

    						button.html("Load more");
    					}
    					
    				}
    			}
    		});
    	});
    </script>
    
</body>
</html>
