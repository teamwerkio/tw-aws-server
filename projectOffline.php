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
	$viewOff=false;

	if(!isset($_SESSION['usr']) && !isset($_GET['viewOff'])){
		header("Location:usr.php");
	}
	else{
		if(isset($_GET['viewOff'])){
			$viewOff=true;
			$sess_ID=rand(1000000,1000000000);
		}
		else{
			$usr_sql="SELECT * FROM users WHERE usrID='".$_SESSION['usr']."'";
			$usr_qry=mysqli_query($dbconnect, $usr_sql);
			$usr_res=mysqli_fetch_assoc($usr_qry);

			$sess_ID=$_SESSION['usr'];
		}



		$id=$_GET['projID'];
		$p_sql="SELECT * FROM project WHERE projID='".$id."'";
		$p_qry=mysqli_query($dbconnect, $p_sql);
		$p_res=mysqli_fetch_assoc($p_qry);

		$cat=returnCat('proj_categories', 'catName', $p_res['catID'], $dbconnect, 'catID');
		$owner_f=returnCat('users', 'firstname', $p_res['usrID'], $dbconnect, 'usrID');
		$owner_l=returnCat('users', 'lastname', $p_res['usrID'], $dbconnect, 'usrID');
		$owner_p=returnCat('users', 'profilepic', $p_res['usrID'], $dbconnect, 'usrID');
		$proj_col=returnCat('colleges', 'colName', $p_res['colID'], $dbconnect, 'colID');
		$owner_ID=$p_res['usrID'];

		
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $p_res['projName']; ?> | Teamwerk</title>

	<!-- Style CSS -->
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />
    <link rel="icon" href="../images/favicon.png" type="image/x-icon"/>
    <!-- bootstrap wrappable css to avoid conflicts -->
  	<link rel="stylesheet" href="https://formden.com/static/assets/demos/bootstrap-iso/bootstrap-iso/bootstrap-iso.css">
  	<link rel="stylesheet" href="https://formden.com/static/assets/demos/bootstrap-iso/bootstrap-iso/bootstrap-iso.css">
  	<!-- sweet alerts -->
  	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- 	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script> -->
</head>

<body class="campaign-detail">
	<div id="wrapper">
		<header id="header" class="site-header">
			<div class="container">
				<div class="site-brand">
					<a href="library.php"><img src="../images/assets/logo.png" style="width: 205px; height: 40px;" alt=""></a>
				</div><!-- .site-brand -->
				<div class="right-header">					
					<nav class="main-menu">
						<button class="c-hamburger c-hamburger--htx"><span></span></button>
						<?php
							if(!$viewOff){
								?>
									<ul>
										<li>
											<a href="library.php">Library<i class="fa fa-caret-down" aria-hidden="true"></i></a>
										</li>
										<li>
											<a href="my_projects.php">My Projects<i class="fa fa-caret-down" aria-hidden="true"></i></a>
										</li>
										<li>
											<a href="#"><?php echo $usr_res['firstname']; ?><i class="fa fa-caret-down" aria-hidden="true"></i></a>
											<ul class="sub-menu">
												<li><a href="dashboard.php">Dashboard</a></li>
												<li><a href="profile.php">Profile</a></li>
												<li><a href="ongoing_projects.php">Ongoing Projects</a></li>
												<li><a href="past_projects.php">Past Projects</a></li>
												<li><a href="usr.php?action=logout">Log Out</a></li>
											</ul>
										</li>
									</ul>
								<?php
							}
						?>

					</nav><!-- .main-menu -->
					<!-- <div class="search-icon">
						<a href="#" class="ion-ios-search-strong"></a>
						<div class="form-search"></div>
						<form action="#" method="POST" id="searchForm">
					  		<input type="text" value="" name="search" placeholder="Search..." />
					    	<button type="submit" value=""><span class="ion-ios-search-strong"></span></button>
					  	</form>
					</div> -->	

					<div class="login login-button">
						<?php
							if($viewOff){
								?>
								<a href="login.php" class="btn-primary">Login</a>
								<?php
							}
							else{
								?>
								<a href="add_project.php" class="btn-primary">+ Project</a>
								<?php
							}
						?>
						
					</div><!-- .login -->
				</div><!--. right-header -->
			</div><!-- .container -->
		</header><!-- .site-header -->

		<main id="main" class="site-main">
			<!-- <div class="page-title background-campaign">
				<div class="container">
					<h1>The Oreous Pillow</h1>
					<div class="breadcrumbs">
						<ul>
							<li><a href="index.html">Home</a><span>/</span></li>
							<li>The Oreous Pillow</li>
						</ul>
					</div>
				</div>
			</div> -->
			<div style="margin-top: 20px;"></div><!-- .page-title -->
			<div class="campaign-content">
				<div class="container">
					<div class="campaign">
						<div class="campaign-item clearfix">
							<div class="campaign-image">
								<div id="owl-campaign" class="campaign-slider">
									<div class="item"><img src="<?php echo getimgURL($p_res['big_ban'], "banner_big"); ?>" alt=""></div>
								</div>
							</div>
							<div class="campaign-box">
								<a href="#" class="category"><?php echo $cat; ?></a>
								<h3><?php echo $p_res['projName']; ?>
									
									<!-- BADGES FOR FUTURE VERSIONS -->
									<!-- <div style="float: right;">
										<i id="circle" style="font-size: 15px; color: white; background-color: #555555; border-color: #555555;" class="fa fa-book"></i>

										<i id="circle" style="font-size: 15px; color: white; background-color: #555555; border-color: #555555;" class="fa fa-dollar"></i>

										<i id="circle" style="font-size: 15px; color: white; background-color: #555555; border-color: #555555;" class="fa fa-rocket"></i>
									</div> -->

								</h3>
								<div class="campaign-description"><p><?php echo $p_res['sm_desc']; ?></p></div>
								<div class="campaign-author clearfix">
									<div class="author-profile">
										<a class="author-icon" href="profile.php?other_usr=<?php echo $p_res['usrID']; ?>"><?php echo '<img src="'.getProfURL($owner_p).'" />'; ?></a>by <a class="author-name" href="profile.php?other_usr=<?php echo $p_res['usrID']; ?>"><?php echo $owner_f; ?> <?php echo $owner_l; ?></a>
									</div>
									<div class="author-address"><span class="ion-location"></span><?php echo $proj_col; ?>, Amherst, MA</div>
								</div>
								<div class="process">
									<div class="raised"><span style="width: <?php echo $p_res
											['progress']; ?>%;"></span></div>
									<div class="process-info">

										<!-- INTEREST -->

										<div class="process-funded"><span>
										<a id="interest" data-tooltip="">
											
										</a>
										</span>interest</div>

										<!-- =============== -->

										<!-- TEAM SIZE -->
										<?php
											$size_id=$p_res['tsizeID'];
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
										<!-- Small Team -->
										<!-- <div class="process-pledged"><span>
											<a data-tooltip="Small team">
											<i class="fa fa-user"></i>
											<i class="fa fa-user"></i></a>
										</span>team size</div> -->

										<!-- Medium Team -->
										<!-- <div class="process-pledged"><span>
											<a data-tooltip="Medium team">
											<i class="fa fa-user"></i>
											<i class="fa fa-user"></i>
											<i class="fa fa-user"></i></a>
										</span>team size</div> -->

										<!-- Large Team -->
										<!-- <div class="process-pledged"><span>
											<a data-tooltip="Large team">
											<i class="fa fa-user"></i>
											<i class="fa fa-user"></i>
											<i class="fa fa-user"></i>
											<i class="fa fa-user"></i></a>
										</span>team size</div> -->

										<!-- Extra Large Team -->
										<!-- <div class="process-pledged"><span>
											<a data-tooltip="Extra large team">
											<i class="fa fa-user"></i>
											<i class="fa fa-user"></i>
											<i class="fa fa-user"></i>
											<i class="fa fa-user-plus"></i></a>
										</span>team size</div> -->

										<!-- =============== -->
										<?php
											$inv_id=$p_res['commID'];
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
										<!-- INVOLVEMENT -->

										<!-- < 10 hrs/week -->
										<!-- <div class="process-time"><span>
											<a data-tooltip="< 10 hrs/week (approx.)">
											<i class="fa fa-clock-o"></i></a>
										</span>involvement</div> -->

										<!-- 11 to 20 hrs/week -->
										<!-- <div class="process-time"><span>
											<a data-tooltip="11 to 20 hrs/week (approx.)">
											<i class="fa fa-clock-o"></i>
											<i class="fa fa-clock-o"></i></a>
										</span>involvement</div> -->

										<!-- 21 to 30 hrs/week -->
										<!-- <div class="process-time"><span>
											<a data-tooltip="21 to 30 hrs/week (approx.)">
											<i class="fa fa-clock-o"></i>
											<i class="fa fa-clock-o"></i>
											<i class="fa fa-clock-o"></i></a>
										</span>involvement</div> -->

										<!-- > 31 hrs/week -->
										<!-- <div class="process-time"><span>
											<a data-tooltip="> 31 hrs/week (approx.)">
											<i class="fa fa-clock-o"></i>
											<i class="fa fa-clock-o"></i>
											<i class="fa fa-clock-o"></i>
											<i class="fa fa-clock-o"></i></a>
										</span>involvement</div> -->

										<!-- =============== -->

										<!-- DAYS AGO -->

										<div class="process-time"><span>
										<a data-tooltip="Project started <?php echo timedifference_d($p_res['dt']);?> days ago">
											<?php echo timedifference_d($p_res['dt']);?>
										</a>
										</span>days ago</div>

										<!-- =============== -->
									</div>
								</div>
								<button id="join_dummy" class="btn-primary" type="button" data-toggle="modal" data-target="#modal-33" style="cursor: pointer;">Join this project</button>
								<?php 
									$role_sql="SELECT * FROM team_roles WHERE (projID=".$p_res['projID'].") AND (status=0)";
									$role_qry=mysqli_query($dbconnect,$role_sql);
									if(!$viewOff && $_SESSION['usr']!=$owner_ID){

								?>
								<div class="button">
									<?php
										if(mysqli_num_rows($role_qry)!=0){
									?>
<!-- 									<form action="" id="priceForm" class="campaign-price quantity">
										
										<div class="bootstrap-iso">
										  <div class="modal fade" id="modal-33">
										    <div class="modal-dialog modal-33g">
										      <div class="modal-content" style="height: 700px; width: 500px;">
										         <div class="modal-body">

										          <iframe id="if_join" src="join_project.php?projID=<?php echo $id;?>" style="width: 100%; overflow: scroll;" height="550" frameborder="0">

										          </iframe>
										         </div>
										         <div class="modal-footer">
										          <button class="btn-mainb cl" data-dismiss="modal" style="cursor: pointer; width: 100px; color: white;">Close</button>

										          <button id="join_proj" name="projID" value=<?php echo $id;?> type="submit" class="btn-mainb" style="cursor: pointer; width: 100px; color: white;">Join</button>

										         </div>
										      </div>
										    </div>
										  </div>
										</div>
									</form> -->

									<?php
										}
									?>

									
								</div>
								<?php
								} ?>
								<a href="login.php" class="btn-secondary" style="background-color: #73b941; border-color: #73b941;"><i class="fa fa-hand-o-up" aria-hidden="true"></i>Keep me posted</a>
								<!-- <div class="share" style="margin-top: 42px;">
									<p style="margin-bottom: 5px;">Share this project</p>
									<ul>
										<li class="share-facebook"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
										<li class="share-twitter"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
										<li class="share-code"><a href="#"><i class="fa fa-code" aria-hidden="true"></i></a></li>
									</ul>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</div><!-- .campaign-content -->
			<div class="campaign-history">
				<div class="container">
					<div class="row">
						<div class="col-lg-8">
							<div class="campaign-tabs">
								<ul class="tabs-controls">
									<li class="active" data-tab="campaign"><a href="#">Team</a></li>
									<!-- <li data-tab="backer"><a href="#">Backer List</a></li> -->
									<li data-tab="story"><a href="#">Story</a></li>
									<!-- <li data-tab="faq"><a href="#">Details</a></li> -->
									<?php
										if(!$viewOff && $_SESSION['usr']==$p_res['usrID']){
									?>
									<li data-tab="settings"><a href="#">Settings</a></li>
									<?php
										}
									?>
									<!-- <li data-tab="requests" style="float: right;"><a href="#">Requests</a></li> -->
									<!-- <li data-tab="comment"><a href="#">Comments</a></li> -->
								</ul>
								<div class="campaign-content">
									<div id="campaign" class="tabs active">
									<div class="col-lg-15" style="margin-top: 0px;">
									<div class="support support-campaign" style="margin-top: 41px;">

										<div id="teamprof" class="team" style="margin-top: 0px; margin-bottom: 0px;">
											<?php
												$team_json=json_decode($p_res['team'],true);
												$admin_arr=$team_json["admin"];
												$mem_arr=$team_json["member"];
												
											?>
											<img src="<?php echo getProfURL($owner_p);?>">
											<?php
												foreach ($admin_arr as $admin) {
													$ad_sql="SELECT * FROM users WHERE usrID=".$admin["id"];
													$ad_qry=mysqli_query($dbconnect, $ad_sql);
													$ad_res=mysqli_fetch_assoc($ad_qry);
													?>
													<img src="<?php echo getProfURL($ad_res['profilepic']);?>">
													<?php
													
												}
											?>
											<?php
												foreach ($mem_arr as $mem) {
													$mem_sql="SELECT * FROM users WHERE usrID=".$mem["id"];
													$mem_qry=mysqli_query($dbconnect, $mem_sql);
													$mem_res=mysqli_fetch_assoc($mem_qry);
													?>
													<img src="<?php echo getProfURL($mem_res['profilepic']);?>">
													<?php
													
												}
											?>

										</div>

										<!-- <h1 style="margin-bottom: 3px; font-weight: 500; font-size: 20px;">Open</h1> -->
										<?php


											if(mysqli_num_rows($role_qry)!=0){


											$role_res=mysqli_fetch_assoc($role_qry);

											do{
												?>

													<div class="plan" style="margin-bottom: 15px;">
														<a href="login.php">
															
																		
															<h4><?php echo $role_res['title'];
																
																	if(!$viewOff && $sess_ID==$owner_ID){


																?>
																<p2 style="float: right;">
																	<a-remove>
																		<i data-id="<?php echo $role_res['roleID'];?>" data-id2="<?php echo $role_res['projID'];?>" class="fa fa-times remove-role"></i>
																	</a-remove>
																</p2>
																
																<!-- Pencil Edit Icon-->
																<p2 style="margin-right: 5px; float: right;">
																	<a-edit-black>
																		<div class="bootstrap-iso">
																		<i class="fa fa-pencil edit-role" data-roleID="<?php echo $role_res['roleID'];?>" data-toggle="modal" data-target="#modal-3"></i>
																		  <div class="modal fade" id="modal-3">
																		    <div class="modal-dialog modal-3g" >
																		      <div class="modal-content" style="height: 550px;">
																		         <div class="modal-body">
																		          <!-- <iframe id="if_role_e" src="role_update.php?edit=1&roleID=<?php echo $role_res['roleID'];?>&projID=<?php echo $p_res['projID'];?>" style="width: 100%;" height="400" frameborder="0">
																		          </iframe> -->
																		         </div>
																		         <div class="modal-footer">
																		          <button class="btn-mainb cl" data-dismiss="modal" style="cursor: pointer; width: 100px;">Close</button>
																		          <button id="update_role" name="" type="submit" value="Save & Launch" class="btn-mainb" style="cursor: pointer; width: 200px;">Edit Role</button>
																		         </div>
																		      </div>
																		    </div>
																		  </div>
																		</div>
																		<!--<i data-id="<?php echo $role_res['roleID'];?>" data-id2="<?php echo $role_res['projID'];?>" class="fa fa-pencil edit-role" onclick="MyWindow=window.open('role_update.php?edit=1&roleID=<?php echo $role_res['roleID'];?>&projID=<?php echo $p_res['projID'];?>','MyWindow',width=450,height=300)"></i>-->
																	</a-edit-black>
																</p2>
																<!-- <p2 style="margin-right: 5px; float: right;">
																	<a-edit-black>
																		<i data-id="<?php echo $role_res['roleID'];?>" data-id2="<?php echo $role_res['projID'];?>" class="fa fa-check check-role"></i>
																		</script>
																	</a-edit-black>
																</p2> -->
																<?php
																	}
																?>
															</h4>
															<div class="plan-desc"><p><?php echo $role_res['description'];?></p></div>
															<!-- <div class="plan-author">End    : 15 November 2018</div> -->
															<div class="backer"><?php echo $role_res['meet_time'];?><i>(<?php if($role_res['meet_freq']==1){
																echo "Weekly";
															}
															elseif ($role_res['meet_freq']==2) {
																echo "Bi-Weekly";
															}
															else{
																echo "Monthly";
															}
															?>)</i><br>
																<?php echo returnCat('colleges', 'colName', $role_res['colID'], $dbconnect, 'colID'); ?>, <?php echo $role_res['location']; ?><br>
															</div>
														</a>
													</div>


												<?php

											}while($role_res=mysqli_fetch_assoc($role_qry));
										}
										else{
											echo "No roles available at this moment.";
										}
										?>
										<p id="no-roles"></p>
										<!-- <div class="plan" style="margin-bottom: 15px;">
											<a href="javascript:void(0)">
												<h4>Backend Developer
													<?php
														if($sess_ID==$owner_ID){


													?>
													<p2 style="float: right;">
														<a-remove>
															<i class="fa fa-times"></i>
														</a-remove>
													</p2>
													<p2 style="margin-right: 5px; float: right;">
														<a-edit-black>
															<i class="fa fa-pencil"></i>
														</a-edit-black>
													</p2>
													<p2 style="margin-right: 5px; float: right;">
														<a-edit-black>
															<i class="fa fa-check"></i>
														</a-edit-black>
													</p2>
													<?php
														}
													?>
												</h4>
												<div class="plan-desc"><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master builder of human happiness.</p></div>
												<!-- <div class="plan-author">End    : 15 November 2018</div> -->
												<!-- <div class="backer">
													TTH 7:00PM to 8:00PM <i>(weekly)</i><br>
													Hampshire College, ASH 221<br>
												</div>
											</a>
										</div>

										<div class="plan" style="margin-bottom: 15px;">
											<a href="javascript:void(0)">
												<h4>Content Writer
													<?php
														if($sess_ID==$owner_ID){


													?>
													<p2 style="float: right;">
														<a-remove>
															<i class="fa fa-times"></i>
														</a-remove>
													</p2>
													<p2 style="margin-right: 5px; float: right;">
														<a-edit-black>
															<i class="fa fa-pencil"></i>
														</a-edit-black>
													</p2>
													<p2 style="margin-right: 5px; float: right;">
														<a-edit-black>
															<i class="fa fa-check"></i>
														</a-edit-black>
													</p2>
													<?php
														}
													?>
												</h4>
												<div class="plan-desc"><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master builder of human happiness.</p></div>
												<div class="backer">
													TTH 7:00PM to 7:30PM <i>(weekly)</i><br>
													Hampshire College, ASH 221<br>
												</div>
											</a>
										</div>

										<div class="plan" style="margin-bottom: 15px;">
											<a href="javascript:void(0)">
												<h4>Statistical Analyzer
													<?php
														if($sess_ID==$owner_ID){


													?>
													<p2 style="float: right;">
														<a-remove>
															<i class="fa fa-times"></i>
														</a-remove>
													</p2>
													<p2 style="margin-right: 5px; float: right;">
														<a-edit-black>
															<i class="fa fa-pencil"></i>
														</a-edit-black>
													</p2>
													<p2 style="margin-right: 5px; float: right;">
														<a-edit-black>
															<i class="fa fa-check"></i>
														</a-edit-black>
													</p2>
													<?php
														}
													?>													
												</h4>
												<div class="plan-desc"><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master builder of human happiness.</p></div>
												<div class="backer">
													TTH 5:00PM to 6:00PM <i>(bi-weekly)</i><br>
													Hampshire College, FPH 108<br>
												</div>
											</a>
										</div> --> 
										<?php
											if(!$viewOff && $owner_ID==$sess_ID){
												?>
												<div class="bootstrap-iso">
												<button id="addRole" type="button" data-toggle="modal" data-target="#modal-2">+ Role</button>
												  <div class="modal fade" id="modal-2">
												    <div class="modal-dialog modal-lg">
												      <div class="modal-content" style="height: 600px;">
												         <div class="modal-body">
												          <iframe id="if_role" src="add_role.php?projID=<?php echo $id;?>" style="width: 100%; overflow: scroll;" height="400" frameborder="0">
												          </iframe>
												         </div>
												         <div class="modal-footer">
												          <button class="btn-mainb cl" data-dismiss="modal" style="cursor: pointer; width: 100px;">Close</button>
												          <button id="role_button" name="add_role" type="submit" value="Save & Launch" class="btn-mainb" style="cursor: pointer; width: 200px;">Add Role</button>
												         </div>
												      </div>
												    </div>
												  </div>
												</div>
												<?php
											}

										?>

									</div></div>
									</div>
									<div id="story" class="tabs">
										<img src="<?php echo getimgURL($p_res['big_ban'], "banner_big"); ?>" alt="">
										<h4 style="margin-bottom: 8px;">Our story from start to now!
											<?php
												if(!$viewOff && $sess_ID==$owner_ID){
											?>
										<p2 style="float: right;">
											<a-remove>
												<i class="fa fa-times"></i>
											</a-remove>
										</p2>
										<p2 style="margin-right: 5px; float: right;">
											<a-edit>
												<i class="fa fa-pencil"></i>
											</a-edit>
										</p2>
										<!-- <p2 style="margin-right: 5px; float: right;">
											<a-edit>
												<i class="fa fa-check"></i>
											</a-edit>
										</p2> -->
										<?php
											}
										?>
										</h4>						
										<p><?php echo $p_res['lg_desc'] ?></p>
									</div>
									<div id="faq" class="tabs">
										<h2>Frequently Asked Questions</h2>
										<p>Looks like there aren't any frequently asked questions yet. Ask the project creator directly.</p>
										<a href="#" class="btn-primary">Ask a question</a>
									</div>
									<div id="settings" class="tabs">
										<h2 style="margin-bottom: 10px;">Settings</h2>
										<p>Use the settings below to change items displayed on this project.</p>

										<h3 style="margin-bottom: 10px; margin-top: 30px;">Team details</h3>
										<form name="proj_set" action="proj_set_submit.php?projID=<?php echo $_GET['projID'];?>" method="post" enctype="multipart/form-data">
											<div class="field clearfix">
							  					<label for="">Team size *</label>
								  				<div class="field">
								  					<div class="field-select">
														<select name="teamsize" id="">
															<?php
																$tsize_sql="SELECT * from teamsize";
																$tsize_qry=mysqli_query($dbconnect, $tsize_sql);
																$tsize_res=mysqli_fetch_assoc($tsize_qry);
																do{
																	if($p_res['tsizeID']==$tsize_res['tsizeID']){
																		?>
																		<option value="<?php echo $tsize_res['tsizeID'];?>" selected><?php echo $tsize_res['Description']; ?></option>
																		<?php
																	}
																	else{
																		?>
																		<option value="<?php echo $tsize_res['tsizeID'];?>"><?php echo $tsize_res['Description']; ?></option>
																		<?php
																	}


																} while($tsize_res=mysqli_fetch_assoc($tsize_qry));
															?>
															<!-- <option value="1">Medium</option>
															<option value="2">Small</option>
															<option value="3">Large</option>
															<option value="4">Extra Large</option> -->
														</select>
													</div>
								  				</div>
											</div>
											<div class="field clearfix" style="margin-top: 10px; margin-bottom: 30px;">
							  					<label for="">Approx. time commitment needed from each member *</label>
								  				<div class="field">
								  					<div class="field-select">
														<select name="commit" id="">
															<?php
																$comm_sql="SELECT * from commitment";
																$comm_qry=mysqli_query($dbconnect, $comm_sql);
																$comm_res=mysqli_fetch_assoc($comm_qry);
																do{
																	if($p_res['commID']==$comm_res['cID']){
																		?>
																		<option value="<?php echo $comm_res['cID'];?>" selected><?php echo $comm_res['Description']; ?></option>
																		<?php
																	}
																	else{
																		?>
																		<option value="<?php echo $comm_res['cID'];?>"><?php echo $comm_res['Description']; ?></option>
																		<?php
																	}


																} while($comm_res=mysqli_fetch_assoc($comm_qry));
															?>
															<!-- <option value="1">Less than 10 hrs/week</option>
															<option value="2" selected>11 to 20 hrs/week</option>
															<option value="3">21 to 30 hrs/week</option>
															<option value="4">More than 31 hrs/week</option> -->
														</select>
													</div>
								  				</div>
											</div>

											<h3 style="margin-bottom: 10px;">Project details</h3>
						  					<label style="margin-bottom: 2px;">How far is this project from completion? *</label><br>
							  				<input name="progress" type="range" value="<?php echo $p_res['progress'];?>" id="projectProgress"></input>
							  				<p>This project is <strong><span id="progressOutput"></span>%</strong> complete</p>
											<button name="proj_set" class="btn-primary" type="submit" style="cursor: pointer; margin-top: 5px; background-color: #73b941; padding-left: 8px; padding-right: 8px;">Save and Apply settings</button>
							  				<!-- <a href="#" class="btn-primary" style="margin-top: 5px;">Save and Apply settings</a> -->
							  			</form>
									</div>

									<!--Requests Tab HTML THIS IS IN THE WRONG PLACE-->
									<!-- <div class="support-campaign">
										<div id="requests" class="plan" style="border: 2px solid #ededed; border-radius: 2px; margin-bottom: 30px; overflow: hidden;">
											
											<a href="javascript:void(0)">
												<h4 style="float: left;">Statistical Analyzer</h4>	
													<div style="overflow: auto; border-style: solid; float: right; height: 30px;">
															<table style="width: 200px;">
																	<tr style="overflow-y: scroll; height: 30px;">
																		<td style="border-bottom: 1px solid #ccc;">Nirman Dave</td>
																		<td style="border-bottom: 1px solid #ccc;">
																			<a-remove>
																				<i class="fa fa-times"></i>
																			</a-remove>
																		</td>
																		<td style="border-bottom: 1px solid #ccc;">
																			<a-edit-black>
																				<i class="fa fa-check"></i>
																			</a-edit-black>
																		</td>
																	</tr>
																	<tr style="overflow-y: scroll; height: 30px;">
																		<td style="border-bottom: 1px solid #ccc;">Hunter Golden</td>
																		<td style="border-bottom: 1px solid #ccc;">
																			<a-remove>
																				<i class="fa fa-times"></i>
																			</a-remove>
																		</td>
																		<td style="border-bottom: 1px solid #ccc;">
																			<a-edit-black>
																				<i class="fa fa-check"></i>
																			</a-edit-black>
																		</td>
																	</tr>
																	<tr style="overflow-y: scroll; height: 30px;">
																		<td style="border-bottom: 1px solid #ccc;">Tapu Lastname</td>
																		<td style="border-bottom: 1px solid #ccc;">
																			<a-remove>
																				<i class="fa fa-times"></i>
																			</a-remove>
																		</td>
																		<td style="border-bottom: 1px solid #ccc;">
																			<a-edit-black>
																				<i class="fa fa-check"></i>
																			</a-edit-black>
																		</td>
																	</tr>
																</table>
													</div>
											</a>
										 </div>
									</div> -->
									<!--END OF REQUESTS TAB, PLEASE MOVE THIS TO THE RIGHT PLACE, CURRENTLY SHOWING UP IN ROLES TAB AS WELL-->
									
									<div id="updates" class="tabs">
										<ul>
											<li>
												<p class="date"> 31-05-2018
													<p2>
														<a-remove>
															<i class="fa fa-times"></i>
														</a-remove>
													</p2>
													<p2 style="margin-right: 5px;" onclick="turnEditable('updateTitle1', 'updateDesc1');">
														<a-edit>
															<i class="fa fa-pencil"></i>
														</a-edit>
													</p2>
													<!-- <p2 style="margin-right: 5px;" onclick="turnUneditable('updateTitle1', 'updateDesc1');">
														<a-edit>
															<i class="fa fa-check"></i>
														</a-edit>
													</p2> -->
												</p>
												<h3 id="updateTitle1">Our Employee Reach 100 Person</h3>
												<div class="desc" id="updateDesc1"><p>Sed cursus hendrerit odio, at aliquet leo hendrerit a. Nulla ultricies sagittis dolor, quis maximus magna consectetur eu. Cras pharetra aliquam fringilla. Integer placerat sapien dapibus varius luctus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in aliquam urna, ultrices lobortis lacus. Praesent mi enim, congue semper volutpat ut, bibendum tempor arcu.</p></div>
											</li>
											<li>
												<p class="date"> 31-05-2018
													<p2>
														<a-remove>
															<i class="fa fa-times"></i>
														</a-remove>
													</p2>
													<p2 style="margin-right: 5px;" onclick="turnEditable('updateTitle2', 'updateDesc2');">
														<a-edit>
															<i class="fa fa-pencil"></i>
														</a-edit>
													</p2>
													<p2 style="margin-right: 5px;" onclick="turnUneditable('updateTitle2', 'updateDesc2');">
														<a-edit>
															<i class="fa fa-check"></i>
														</a-edit>
													</p2>
												</p>
												<h3 id="updateTitle2">Our Employee Reach 100 Person</h3>
												<div class="desc" id="updateDesc2"><p>Sed cursus hendrerit odio, at aliquet leo hendrerit a. Nulla ultricies sagittis dolor, quis maximus magna consectetur eu. Cras pharetra aliquam fringilla. Integer placerat sapien dapibus varius luctus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in aliquam urna, ultrices lobortis lacus. Praesent mi enim, congue semper volutpat ut, bibendum tempor arcu.</p></div>
											</li>
											<li>
												<p class="date"> 31-05-2018
													<p2>
														<a-remove>
															<i class="fa fa-times"></i>
														</a-remove>
													</p2>
													<p2 style="margin-right: 5px;" onclick="turnEditable('updateTitle3', 'updateDesc3');">
														<a-edit>
															<i class="fa fa-pencil"></i>
														</a-edit>
													</p2>
													<p2 style="margin-right: 5px;" onclick="turnUneditable('updateTitle3', 'updateDesc3');">
														<a-edit>
															<i class="fa fa-check"></i>
														</a-edit>
													</p2>
												</p>
												<h3 id="updateTitle3">Our Employee Reach 100 Person</h3>
												<div class="desc" id="updateDesc3"><p>Sed cursus hendrerit odio, at aliquet leo hendrerit a. Nulla ultricies sagittis dolor, quis maximus magna consectetur eu. Cras pharetra aliquam fringilla. Integer placerat sapien dapibus varius luctus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in aliquam urna, ultrices lobortis lacus. Praesent mi enim, congue semper volutpat ut, bibendum tempor arcu.</p></div>
											</li>
											<li>
												<p class="date"> 31-05-2018
													<p2>
														<a-remove>
															<i class="fa fa-times"></i>
														</a-remove>
													</p2>
													<p2 style="margin-right: 5px;" onclick="turnEditable('updateTitle4', 'updateDesc4');">
														<a-edit>
															<i class="fa fa-pencil"></i>
														</a-edit>
													</p2>
													<p2 style="margin-right: 5px;" onclick="turnUneditable('updateTitle4', 'updateDesc4');">
														<a-edit>
															<i class="fa fa-check"></i>
														</a-edit>
													</p2>
												</p>
												<h3 id="updateTitle4">Our Employee Reach 100 Person</h3>
												<div class="desc" id="updateDesc4"><p>Sed cursus hendrerit odio, at aliquet leo hendrerit a. Nulla ultricies sagittis dolor, quis maximus magna consectetur eu. Cras pharetra aliquam fringilla. Integer placerat sapien dapibus varius luctus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in aliquam urna, ultrices lobortis lacus. Praesent mi enim, congue semper volutpat ut, bibendum tempor arcu.</p></div>
											</li>
										</ul>
<!-- 										<button id="addUpdate">+ Update</button>
											<div id="updateModal" class="modal">
												<div class="modal-content" scrolling="no">
													<span class="close">&times;</span>
													<iframe src="add_update.php" height="650" scrolling="no"></iframe>
												</div>
											</div> -->
									</div>
									<div id="comment" class="tabs comment-area">
										<h3 class="comments-title">1 Comment</h3>
										<ol class="comments-list">
											<li class="comment clearfix"> 
												<div class="comment-body">
													<div class="comment-avatar"><img src="../images/placeholder/70x70.png" alt=""></div>
													<div class="comment-info">
														<header class="comment-meta"></header>
														<cite class="comment-author">Jordan B. Goodale</cite>
														<div class="comment-inline">
															<span class="comment-date">2 days ago</span>
															<a href="#" class="comment-reply">Reply</a>
														</div>
														<div class="comment-content"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Equidem e Cn. Sequitur disserendi ratio cognitioque naturae; Nunc vides, quid faciat. Duo Reges: constructio interrete. Memini vero, inquam; Quis Aristidem non mortuum diligit?</p></div>
													</div>
												</div>
											</li>
										</ol>
										<div id="respond" class="comment-respond">
											<h3 id="reply-title" class="comment-reply-title">Leave A Comment?</h3>
											<form action="" id="commentForm">
												<div class="field-textarea">
								  					<textarea rows="8" placeholder="Your Comment"></textarea>
								  				</div>
												<div class="row">
									  				<div class="col-md-4 field">
									  					<input type="text" value="" name="s" placeholder="Your Name" />
									  				</div>
									  				<div class="col-md-4 field">
									  					<input type="text" value="" name="s" placeholder="Your Email" />
									  				</div>
									  				<div class="col-md-4 field">
									  					<input type="text" value="" name="s" placeholder="Website" />
									  				</div>
								  				</div>
											  	<button type="submit" value="Send Messager" class="btn-primary">Post Comment</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div><!-- .main-content -->
						<div class="col-lg-4">
							<div class="support support-campaign" style="margin-top: 5.5px;">
								<h3 class="support-campaign-title">Timeline</h3>
									<div id="updates" class="tabs">
										<p id="no-updates"></p>
										<ul>
											<?php
												$up_sql="SELECT * FROM proj_updates WHERE (projID=".$id.") AND (status=0)";
												$up_qry=mysqli_query($dbconnect, $up_sql);
												if(mysqli_num_rows($up_qry)==0){
													echo "No updates available.";
												}
												else{

													$up_res=mysqli_fetch_assoc($up_qry);

													do{
														?>
															<li>
																<p class="date"><?php echo date( 'Y-m-d', strtotime($up_res['dt']));?>
																	<?php
																		if($owner_ID==$sess_ID){
																	?>

																	<p2>
																		<a-remove>
																			<i data-id="<?php echo $up_res['upID'];?>" data-id2="<?php echo $up_res['projID'];?>" class="fa fa-times del-up"></i>
																		</a-remove>
																	</p2>
																	<!-- Nirman Pencil Alignment issue -->
																	<p2 style="margin-right: 0px;">
																	<a-edit-black>
																		<div class="bootstrap-iso">
																		<i class="fa fa-pencil edit-role" data-toggle="modal" data-target="#modal-4"></i>
																		  <div class="modal fade" id="modal-4">
																		    <div class="modal-dialog modal-4g" >
																		      <div class="modal-content" style="height: 550px;">
																		         <div class="modal-body">
																		          <iframe src="timeline_update.php?edit=1&upID=<?php echo $up_res['upID'];?>&projID=<?php echo $p_res['projID'];?>" style="width: 100%;" height="400" frameborder="0">
																		          </iframe>
																		         </div>
																		         <div class="modal-footer">
																		          <button class="btn-mainb cl" data-dismiss="modal" style="cursor: pointer; width: 100px;">Close</button>
																		          <button name="" type="submit" value="Save & Launch" class="btn-mainb" style="cursor: pointer; width: 200px;">Edit Role</button>
																		         </div>
																		      </div>
																		    </div>
																		  </div>
																		</div>
																		<!--<i data-id="<?php echo $role_res['roleID'];?>" data-id2="<?php echo $role_res['projID'];?>" class="fa fa-pencil edit-role" onclick="MyWindow=window.open('role_update.php?edit=1&roleID=<?php echo $role_res['roleID'];?>&projID=<?php echo $p_res['projID'];?>','MyWindow',width=450,height=300)"></i>-->
																	</a-edit-black>
																</p2>
																	<!--<p2  style ="margin-right: 5px;" onclick="turnEditable('updateTitle1', 'updateDesc1');">-->
																		<!-- <a-edit-black>
																			<div class="bootstrap-iso">
																			
																			<i class="fa fa-pencil edit-up" data-toggle="modal" data-target="#modal-4"></i>
																			  <div class="modal fade" id="modal-4">
																			    <div class="modal-dialog modal-4g" >
																			      <div class="modal-content" style="height: 550px;">
																			         <div class="modal-body">
																			          <iframe src="timeline_update.php?edit=1&upID=<?php echo $up_res['upID'];?>&projID=<?php echo $p_res['projID'];?>" style="width: 100%;" height="400" frameborder="0">
																			          </iframe>
																			         </div>
																			         <div class="modal-footer">
																			          <button class="btn-mainb" data-dismiss="modal" style="cursor: pointer; width: 100px;">Close</button>
																			          <button name="Edit Update" type="submit" value="Save & Launch" class="btn-mainb" style="cursor: pointer; width: 200px;">Edit Update</button>
																			         </div>
																			      </div>
																			    </div>
																			  </div>
																			</div> -->
																			<!--<i onclick="MyWindow=window.open('timeline_update.php?edit=1&upID=<?php echo $up_res['upID'];?>&projID=<?php echo $p_res['projID'];?>','MyWindow',width=450,height=300)" class="fa fa-pencil edit-up"></i>-->
																		<!--</a-edit-black> -->
																	<!--</p2>-->
																	<!-- <p2 style="margin-right: 5px;" onclick="turnUneditable('updateTitle1', 'updateDesc1');">
																		<a-edit>
																			<i data-id="<?php echo $up_res['upID'];?>" data-id2="<?php echo $up_res['projID'];?>" class="fa fa-check check-up"></i>
																		</a-edit>
																	</p2> -->
																	<?php
																		}
																	?>
																</p>
																<h3 id="updateTitle1"><?php echo $up_res['title'];?></h3>
																<div class="desc" id="updateDesc1"><p><?php echo $up_res['details'];?></p></div>
															</li>

														<?php

													}while($up_res=mysqli_fetch_assoc($up_qry));
												}

											?>
											<!-- <li>
												<p class="date"> 11-05-2018
													<?php
														if($owner_ID==$sess_ID){
													?>
													<p2>
														<a-remove>
															<i class="fa fa-times"></i>
														</a-remove>
													</p2>
													<p2 style="margin-right: 5px;" onclick="turnEditable('updateTitle1', 'updateDesc1');">
														<a-edit>
															<i class="fa fa-pencil"></i>
														</a-edit>
													</p2>
													<p2 style="margin-right: 5px;" onclick="turnUneditable('updateTitle1', 'updateDesc1');">
														<a-edit>
															<i class="fa fa-check"></i>
														</a-edit>
													</p2>
													<?php
														}
													?>
												</p>
												<h3 id="updateTitle1">100 students joined our group!</h3>
												<div class="desc" id="updateDesc1"><p>Sed cursus hendrerit odio, at aliquet leo hendrerit a. Nulla ultricies sagittis dolor, quis maximus magna consectetur eu.</p></div>
											</li>
											<li>
												<p class="date"> 28-04-2018
													<?php
														if($owner_ID==$sess_ID){
													?>
													<p2>
														<a-remove>
															<i class="fa fa-times"></i>
														</a-remove>
													</p2>
													<p2 style="margin-right: 5px;" onclick="turnEditable('updateTitle1', 'updateDesc1');">
														<a-edit>
															<i class="fa fa-pencil"></i>
														</a-edit>
													</p2>
													<p2 style="margin-right: 5px;" onclick="turnUneditable('updateTitle1', 'updateDesc1');">
														<a-edit>
															<i class="fa fa-check"></i>
														</a-edit>
													</p2>
													<?php
														}
													?>
												</p>
												<h3 id="updateTitle2">Created a student group</h3>
												<div class="desc" id="updateDesc2"><p>Sed cursus hendrerit odio, at aliquet leo hendrerit a. Nulla ultricies sagittis dolor, quis maximus magna consectetur eu.</p></div>
											</li>
											<li>
												<p class="date"> 30-03-2018
													<?php
														if($owner_ID==$sess_ID){
													?>
													<p2>
														<a-remove>
															<i class="fa fa-times"></i>
														</a-remove>
													</p2>
													<p2 style="margin-right: 5px;" onclick="turnEditable('updateTitle1', 'updateDesc1');">
														<a-edit>
															<i class="fa fa-pencil"></i>
														</a-edit>
													</p2>
													<p2 style="margin-right: 5px;" onclick="turnUneditable('updateTitle1', 'updateDesc1');">
														<a-edit>
															<i class="fa fa-check"></i>
														</a-edit>
													</p2>
													<?php
														}
													?>
												</p>
												<h3 id="updateTitle3">We found some traction</h3>
												<div class="desc" id="updateDesc3"><p>Sed cursus hendrerit odio, at aliquet leo hendrerit a. Nulla ultricies sagittis dolor, quis maximus magna consectetur eu.</p></div>
											</li>
											<li>
												<p class="date"> 12-02-2018
													<?php
														if($owner_ID==$sess_ID){
													?>
													<p2>
														<a-remove>
															<i class="fa fa-times"></i>
														</a-remove>
													</p2>
													<p2 style="margin-right: 5px;" onclick="turnEditable('updateTitle1', 'updateDesc1');">
														<a-edit>
															<i class="fa fa-pencil"></i>
														</a-edit>
													</p2>
													<p2 style="margin-right: 5px;" onclick="turnUneditable('updateTitle1', 'updateDesc1');">
														<a-edit>
															<i class="fa fa-check"></i>
														</a-edit>
													</p2>
													<?php
														}
													?>
												</p>
												<h3 id="updateTitle4">We started the project</h3>
												<div class="desc" id="updateDesc4"><p>Sed cursus hendrerit odio, at aliquet leo hendrerit a. Nulla ultricies sagittis dolor, quis maximus magna consectetur eu.</p></div>
											</li> -->
										</ul>
										<!-- modal for hunter -->
										<?php
											if(!$viewOff && $owner_ID==$sess_ID){
												?>
													<div class="bootstrap-iso">
													<button id="addUpdate" type="button" data-toggle="modal" data-target="#modal-1">+ Update</button>
													  <div class="modal fade" id="modal-1">
													    <div class="modal-dialog modal-lg" >
													      <div class="modal-content" style="height: 550px;">
													         <div class="modal-body">
													          <iframe id="if_update" src="add_update.php?projID=<?php echo $id?>" style="width: 100%;" height="400" frameborder="0">
													          </iframe>
													         </div>
													         <div class="modal-footer">
													          <button class="btn-mainb cl" data-dismiss="modal" style="cursor: pointer; width: 100px;">Close</button>
													          <button name="add_update" id="update_button" type="submit" value="Save & Launch" class="btn-mainb" style="cursor: pointer; width: 200px;">Add Update</button>
													         </div>
													      </div>
													    </div>
													  </div>
													</div>
												<?php												
											}
										?>

									</div>
							</div>
							<?php
								if(!$viewOff){
									?>
								<div class="support support-campaign" style="margin-top: 5.5px;">
								<h3 class="support-campaign-title" style="margin-top: 35px; margin-bottom: 15px;">Share this project</h3>
									<div id="updates" class="tabs">
										<a class="fa fa-facebook-square" style="font-size: 35px; margin-left: 5px;" href=""></a>
										<a class="fa fa-twitter-square" style="font-size: 35px; margin-left: 10px;" href=""></a>
										<a class="fa fa-google-plus-square" style="font-size: 35px; margin-left: 10px;" href=""></a>
										<a class="fa fa-clone" style="font-size: 30px; margin-left: 10px;" href=""></a>
										
									</div>
								</div>

									<?php
								}
							?>


						</div><!-- .sidebar -->
					</div>
				</div>
			</div><!-- .campaign-history -->
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
    <script type="text/javascript" src="js/range.js"></script>
    <script  type="text/javascript" src="js/main.js"></script>
<!--     <script type="text/javascript" src="js/changes.js"></script>
    <script type="text/javascript" src="js/popup.js"></script> -->
    <script type="text/javascript">
    	var usr_id="<?php echo $sess_ID?>";
		var proj_id="<?php echo $id?>";
		$(document).ready(function(){

			$("#update_button").click(function(){
				$("#if_update").contents().find("#update_add").submit();
				$('.modal').modal('hide');
				location.reload();

			});

			$("#role_button").click(function(){
				$("#if_role").contents().find("#role_add").submit();
				$(".modal").modal('hide');
				location.reload();
			});


			$("#join_proj").click(function(){
				$("#if_join").contents().find("#proj_join").submit();
				$(".modal").modal('hide');
				
			});

			// $(".cl").click(function(){
			// 	$("#if_role_e").contents().find("#role_edit")[0].reset();
			// });

			$("#update_role").click(function(){
				$("#if_role_e").contents().find("#role_edit").submit();
				$(".modal").modal('hide');
				location.reload();
			});

			$(".edit-role").click(function(){
				$(".modal-body").html("Loading...");
				var button=$(this);
				var roleID=button.attr('data-roleID');
				var iFrame='<iframe id="if_role_e" src="role_update.php?edit=1&roleID='+roleID+'&projID='+proj_id+'" style="width: 100%;" height="400" frameborder="0"></iframe>';
				$(".modal-body").html(iFrame);
			});
			$('.fa-clone').click(function(){
				
				var url=window.location.href+"&viewOff=true";
				console.log(url);
			    var dummy = document.createElement("textarea");
			    document.body.appendChild(dummy);
			    dummy.value = url;
			    dummy.select();
			    document.execCommand("copy");
			    document.body.removeChild(dummy);

				


			});
			$('#join_dummy').click(function(){
				window.location.href='login.php';
			});


		});
    </script>
    <script type="text/javascript" src="js/upvotes.js"></script>
    <script type="text/javascript" src="js/update.js"></script>
    <!-- for stuff -->
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>