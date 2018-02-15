<?php
	include("dbconnect.php");
	include("img_url.php");
	session_start();
	if(!isset($_POST['load'])){
		header("Location:library.php");
	}
	else{
		$finID=$_POST['finID'];
		$trend=$_POST['trend'];

		$load_sql="SELECT * FROM project WHERE projID>".$finID;
		$load_qry=mysqli_query($dbconnect, $load_sql);
		$num_rows=mysqli_num_rows($load_qry);

		if($num_rows!=0){
			$load_res=mysqli_fetch_assoc($load_qry);
			$output='';
			$count=0;
			$final_id=0;
			function returnCat($table, $col, $idx, $dbconnect, $idtype){
				$cat_sql="SELECT ".$col." FROM ".$table." WHERE ".$idtype."='".$idx."'";
				$cat_qry=mysqli_query($dbconnect, $cat_sql);
				$cat_res=mysqli_fetch_assoc($cat_qry);
				return $cat_res[$col];
			}

			do{
				if($load_res['projID']!==$trend && $count<6){
					$count+=1;
					$cat=returnCat('proj_categories', 'catName', $load_res['catID'], $dbconnect, 'catID');
					$owner_f=returnCat('users', 'firstname', $load_res['usrID'], $dbconnect, 'usrID');
					$owner_p=returnCat('users', 'profilepic', $load_res['usrID'], $dbconnect, 'usrID');

					$json=$load_res['subs'];
					$json=json_decode($json, true);
					$size_id=$load_res['tsizeID'];
					$inv_id=$load_res['commID'];

					$output.='
					<div class="col-lg-4 col-sm-6 col-6">
						<div class="campaign-item wow fadeInUp" data-wow-delay=".1s">
							<a class="overlay" style="height: 240px;" href="project.php?projID='.$load_res['projID'].'">
								<img src="'.getimgURL($load_res['small_ban'], "banner_small").'" style="height: 240px;" />
								<span class="ion-paper-airplane"></span>
							</a>
							<div class="campaign-box">
								<a href="#" class="category"><?php echo $cat; ?></a>
								<h3><a href="project.php?projID='.$load_res['projID'].'">'.$load_res['projName'].'</a></h3>
								<div class="campaign-description">'.$load_res['sm_desc'].'</div>
								<div class="campaign-author"><a class="author-icon" href="profile.php?other_usr='.$load_res['usrID'].'">
									<img src="'.getimgURL($owner_p, "profilepic").'" /></a>by <a class="author-name" href="profile.php?other_usr='.$load_res['usrID'].'">'.$owner_f.'		
								</a></div>
								<div class="process">
									<div class="raised"><span style="width: '.$load_res['progress'].'%;"></span></div>
									<div class="process-info">
										<div class="process-pledged"><span>'.count($json['subs']).'</span>interest</div>';
					if($size_id==1){
						$output.='
						<div class="process-pledged"><span>
							<a data-tooltip="Small team">
							<i class="fa fa-user"></i>
							<i class="fa fa-user"></i></a>
						</span>team size</div>';
					}
					elseif ($size_id==2) {
						$output.='
						<div class="process-pledged"><span>
							<a data-tooltip="Medium team">
							<i class="fa fa-user"></i>
							<i class="fa fa-user"></i>
							<i class="fa fa-user"></i></a>
						</span>team size</div>';
					}
					elseif ($size_id==3) {
						$output.='
						<div class="process-pledged"><span>
							<a data-tooltip="Large team">
							<i class="fa fa-user"></i>
							<i class="fa fa-user"></i>
							<i class="fa fa-user"></i>
							<i class="fa fa-user"></i></a>
						</span>team size</div>';
					}
					elseif ($size_id==4) {
						$output.='
						<div class="process-pledged"><span>
							<a data-tooltip="Extra large team">
							<i class="fa fa-user"></i>
							<i class="fa fa-user"></i>
							<i class="fa fa-user"></i>
							<i class="fa fa-user-plus"></i></a>
						</span>team size</div>';
					}

					if($inv_id==1){
						$output.='
						<div class="process-time"><span>
							<a data-tooltip="< 10 hrs/week (approx.)">
							<i class="fa fa-clock-o"></i></a>
						</span>involvement</div>';

					}
					elseif ($inv_id==2) {
						$output.='
						<div class="process-time"><span>
							<a data-tooltip="11 to 20 hrs/week (approx.)">
							<i class="fa fa-clock-o"></i>
							<i class="fa fa-clock-o"></i></a>
						</span>involvement</div>';
					}
				elseif ($inv_id==3) {
					$output.='
					<div class="process-time"><span>
						<a data-tooltip="21 to 30 hrs/week (approx.)">
						<i class="fa fa-clock-o"></i>
						<i class="fa fa-clock-o"></i>
						<i class="fa fa-clock-o"></i></a>
					</span>involvement</div>';
				}
				elseif ($inv_id==4) {
					$output.='
					<div class="process-time"><span>
						<a data-tooltip="> 31 hrs/week (approx.)">
						<i class="fa fa-clock-o"></i>
						<i class="fa fa-clock-o"></i>
						<i class="fa fa-clock-o"></i>
						<i class="fa fa-clock-o"></i></a>
					</span>involvement</div>';
				}									
					$output.='
				</div>
			</div>
		</div>
	</div>
</div>';
			$final_id=$load_res['projID'];

			}}while($load_res=mysqli_fetch_assoc($load_qry));
			$out=new \stdClass();
			$out->html=$output;
			$out->final=$final_id;
			$out->count=$num_rows;
			echo json_encode($out);
		}
		else{
			echo mysqli_num_rows($load_qry);
		}
	}
