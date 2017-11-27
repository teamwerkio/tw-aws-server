<?php
	include("dbconnect.php");
	session_start();
	include("img_url.php");
	$proj_sql = "SELECT * FROM project WHERE projID > ".$_POST['last_video_id']." LIMIT 10";
	$proj_qry=mysqli_query($dbconnect, $proj_sql);
	$proj_res=mysqli_fetch_assoc($proj_qry);
	$count=0;

	do{
		if($proj_res['projID']!==$_POST['trend'] && $count<=9){
			$count+=1;
			$cat=returnCat('proj_categories', 'catName', $proj_res['catID'], $dbconnect, 'catID');
			$owner_f=returnCat('users', 'firstname', $proj_res['usrID'], $dbconnect, 'usrID');
			$owner_p=returnCat('users', 'profilepic', $proj_res['usrID'], $dbconnect, 'usrID');
			
			$output .=	'<div class="col-lg-4 col-sm-6 col-6">
							<div class="campaign-item wow fadeInUp" data-wow-delay=".1s">
								<a class="overlay" style="height: 240px;" href="project.php?projID='.$proj_res['projID'].'">
									<img src="'.getimgURL($proj_res['small_ban'], "banner_small").'" style="height: 240px;" />
									<span class="ion-paper-airplane"></span>
								</a>
								<div class="campaign-box">
									<a href="#" class="category">'.$cat.'</a>
									<h3><a href="project.php?projID='.$proj_res['projID'].'">'.$proj_res['projName'].'</a></h3>
									<div class="campaign-description">'.$proj_res['sm_desc'].'</div>
									<div class="campaign-author"><a class="author-icon" href="#">
										<img src="'.getimgURL($owner_p, "profilepic").'" /></a>by <a class="author-name" href="#">'.$owner_f.'</a></div>
									<div class="process">
										<div class="raised"><span style="width: 10%;"></span></div>
										<div class="process-info">
											<div class="process-pledged"><span>'.$proj_res['upvote'].'</span>upvotes</div>
											<div class="process-funded"><span>'.$proj_res['interest'].'%</span>interest</div>
											<div class="process-time"><span style="color: red;">'.$proj_res['virality'].'%</span>virality</div>
										</div>
									</div>
								</div>
							</div>
						</div>';
			
			$final_id=$proj_res['projID'];

	}}while($proj_res=mysqli_fetch_assoc($proj_qry));
	echo $output;
?>