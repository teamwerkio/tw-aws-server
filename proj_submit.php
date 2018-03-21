<?php
	include("dbconnect.php");
	include("upload_photo.php");
	session_start();
	date_default_timezone_set('US/Eastern');
	if(!isset($_POST['addp'])){
		header("Location:library.php");
	}
	else {
		$projName=$_POST['projname'];
		$tagline=$_POST['projtagl'];
		$sh_desc=$_POST['proj_sh_desc'];
		$lg_desc=$_POST['proj_lg_desc'];
		$big_ban=$_FILES['big_ban'];
		$sm_ban=$_FILES['sm_ban'];
		$proj_icon=$_FILES['proj_icon'];
		$college=$_POST['college'];
		$category=$_POST['cat'];
		$tags=$_POST['tags'];
		$date=date('Y-m-d H:i:s:u');

		$varbool=empty($projName) || empty($tagline) || empty($sh_desc) || empty($lg_desc) || empty($big_ban) || empty($sm_ban) || empty($proj_icon) || empty($college) || empty($category) || empty($tags);


		$usrID=$_SESSION['usr'];




		if($varbool==False){

			if(is_uploaded_file($big_ban['tmp_name'])==true){
				$big_ban_name=$usrID."big_ban".$date;
				img_uploader($big_ban, "banner_big", $big_ban_name);
			}
			else{
				$big_ban_name="";
			}
			


			if(is_uploaded_file($sm_ban['tmp_name'])==true){
				$sm_ban_name=$usrID."sm_ban".$date;
				img_uploader($sm_ban, "banner_small", $sm_ban_name);
			}
			else{
				$sm_ban_name="";
			}
			

			if(is_uploaded_file($proj_icon['tmp_name'])==true){
				$icon_name=$usrID."icon".$date;
				img_uploader($proj_icon, "proj_icon", $icon_name);
			}
			else{
				$icon_name="";
			}


			$tag_arr=explode(',', $tags);

			$tag_final=array('ongoing' => true, 'tags' => $tag_arr);
			$tag_final=json_encode($tag_final);

			$member=array('owner' =>array('id' => $usrID,'pos'=>"A"), 'member'=>array(), 'admin'=>array());
			$member_json=json_encode($member);

			$proj_sql = "INSERT INTO project (usrID, projName, tagline, lg_desc, sm_desc, big_ban, small_ban, proj_icon, colID, catID, tags, team, dt) VALUES ('".mysqli_real_escape_string($dbconnect, $_SESSION['usr'])."', '".
			mysqli_real_escape_string($dbconnect, $projName)."', '".
			mysqli_real_escape_string($dbconnect, $tagline)."', '".
			mysqli_real_escape_string($dbconnect, $lg_desc)."', '".
			mysqli_real_escape_string($dbconnect, $sh_desc)."', '".
			mysqli_real_escape_string($dbconnect, $big_ban_name)."', '".
			mysqli_real_escape_string($dbconnect, $sm_ban_name)."', '".
			mysqli_real_escape_string($dbconnect, $icon_name)."', '".
			mysqli_real_escape_string($dbconnect, $college)."', '".
			mysqli_real_escape_string($dbconnect, $category)."', '".
			mysqli_real_escape_string($dbconnect, $tag_final)."', '".
			mysqli_real_escape_string($dbconnect, $member_json)."', '".
			mysqli_real_escape_string($dbconnect, $date)."')";

			
			$proj_query=mysqli_query($dbconnect, $proj_sql);

			$highest_id = mysqli_fetch_row(mysqli_query($dbconnect, "SELECT MAX(projID) FROM project"))[0];

			$defUpSQL1="INSERT INTO proj_updates(projID, title, dt) VALUES ('".
			mysqli_real_escape_string($dbconnect, $highest_id)."', '".
			mysqli_real_escape_string($dbconnect, "Project started")."', '".
			mysqli_real_escape_string($dbconnect, $date)."')";

			$defUpSQL2="INSERT INTO proj_updates(projID, title, dt) VALUES ('".
			mysqli_real_escape_string($dbconnect, $highest_id)."', '".
			mysqli_real_escape_string($dbconnect, "Going live soon!")."', '".
			mysqli_real_escape_string($dbconnect, $date)."')";

			mysqli_query($dbconnect, $defUpSQL1);
			mysqli_query($dbconnect, $defUpSQL2);

			unset($_POST['addp']);
			header("Location:project.php?projID=".$highest_id);

		}
		else{
			header("Location:library.php");
		}

	}
?>