<?php
	include("dbconnect.php");
	include("upload_photo.php");
	date_default_timezone_set('US/Eastern');
	session_start();
	if(!isset($_POST['proj_set'])){
		header("Location:project.php?projID=".$_GET['projID']);
	}
	else{
		$size=$_POST['teamsize'];
		$commit=$_POST['commit'];
		$prog=$_POST['progress'];
		$name=$_POST['projname'];
		$tagline=$_POST['projtagl'];
		$sh_desc=$_POST['proj_sh_desc'];
		$lg_desc=$_POST['proj_lg_desc'];
		$cID=$_POST['college'];
		$catID=$_POST['cat'];
		$tags=$_POST['tags'];

		$big_ban=$_FILES['big_ban'];
		$sm_ban=$_FILES['sm_ban'];
		$proj_icon=$_FILES['proj_icon'];

		$date=date('Y-m-d H:i:s:u');

		$id=$_GET['projID'];

		$varbool=empty($size) || empty($commit) || empty($prog) || empty($name) || empty($tagline) || empty($sh_desc) || empty($lg_desc) || empty($college) || empty($category) || empty($tags);

		if($varbool==False){
			$tag_arr=explode(',', $tags);

			$tag_final=array('ongoing' => true, 'tags' => $tag_arr);
			$tag_final=json_encode($tag_final);


			$set_sql="UPDATE project SET 
			tsizeID=".mysqli_real_escape_string($dbconnect, $size).",
			commID=".mysqli_real_escape_string($dbconnect, $commit).",
			progress=".mysqli_real_escape_string($dbconnect, $prog).",
			projName=".mysqli_real_escape_string($dbconnect, $name).",
			tagline=".mysqli_real_escape_string($dbconnect, $tagline).",
			sm_desc=".mysqli_real_escape_string($dbconnect, $sh_desc).",
			lg_desc=".mysqli_real_escape_string($dbconnect, $lg_desc).",
			colID=".mysqli_real_escape_string($dbconnect, $cID).",
			catID=".mysqli_real_escape_string($dbconnect, $catID).",
			tags=".mysqli_real_escape_string($dbconnect, $tag_final)."
			 WHERE projID=".mysqli_real_escape_string($dbconnect, $id);
			$set_qry=mysqli_query($dbconnect, $set_sql);


			if(getimagesize($big_ban['tmp_name'])==true){
				$big_ban_name=$id."big_ban".$date;
				img_uploader($big_ban, "banner_big", $big_ban_name);

				$im_sql="UPDATE project SET
				big_ban=".mysqli_real_escape_string($dbconnect, $big_ban_name)."
				 WHERE projID=".mysqli_real_escape_string($dbconnect, $id);
				$im_qry=mysqli_query($dbconnect,$im_sql);

			}

			if(getimagesize($sm_ban['tmp_name'])==true){
				$sm_ban_name=$id."sm_ban".$date;
				img_uploader($sm_ban, "banner_small", $sm_ban_name);

				$im_sql="UPDATE project SET
				small_ban=".mysqli_real_escape_string($dbconnect, $sm_ban_name)."
				 WHERE projID=".mysqli_real_escape_string($dbconnect, $id);
				$im_qry=mysqli_query($dbconnect,$im_sql);

			}
			if(getimagesize($proj_icon['tmp_name'])==true){
				$icon_name=$id."icon".$date;
				img_uploader($proj_icon, "proj_icon", $icon_name);

				$im_sql="UPDATE project SET
				proj_icon=".mysqli_real_escape_string($dbconnect, $icon_name)."
				 WHERE projID=".mysqli_real_escape_string($dbconnect, $id);
				$im_qry=mysqli_query($dbconnect,$im_sql);

			}

		}




		



		unset($_POST['proj_set']);
		header("Location:project.php?projID=".$_GET['projID']);
	}
?>