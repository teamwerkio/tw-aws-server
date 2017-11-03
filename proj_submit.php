<?php
	include("dbconnect.php");
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
			$big_ban_dir="../img_assets/banner_big/";
			$big_ban_name=$usrID."big_ban".$date.'.'.end(explode('.', $big_ban['name']));
			move_uploaded_file($big_ban['tmp_name'], $big_ban_dir.$big_ban_name);


			$sm_ban_dir="../img_assets/banner_small/";
			$sm_ban_name=$usrID."sm_ban".$date.'.'.end(explode('.', $sm_ban['name']));
			move_uploaded_file($sm_ban['tmp_name'], $sm_ban_dir.$sm_ban_name);


			$icon_dir="../img_assets/proj_icon/";
			$icon_name=$usrID."icon".$date.'.'.end(explode('.', $proj_icon['name']));
			move_uploaded_file($proj_icon['tmp_name'], $icon_dir.$icon_name);


			$tag_arr=explode(',', $tags);

			$tag_final=array('ongoing' => true, 'tags' => $tag_arr);
			$tag_final=json_encode($tag_final);




			$proj_sql="INSERT INTO project (usrID, projName, tagline, lg_desc, sm_desc, big_ban, small_ban, proj_icon, colID, catID, tags, dt) VALUES ('".mysqli_real_escape_string($dbconnect, $usrID)."',
				'".mysqli_real_escape_string($dbconnect, $projName)."',
				'".mysqli_real_escape_string($dbconnect, $tagline)."',
				'".mysqli_real_escape_string($dbconnect, $lg_desc)."',
				'".mysqli_real_escape_string($dbconnect, $sh_desc)."',
				'".mysqli_real_escape_string($dbconnect, $big_ban_name)."',
				'".mysqli_real_escape_string($dbconnect, $sm_ban_name)."',
				'".mysqli_real_escape_string($dbconnect, $icon_name)."',
				'".mysqli_real_escape_string($dbconnect, $college)."',
				'".mysqli_real_escape_string($dbconnect, $category)."',
				'".mysqli_real_escape_string($dbconnect, $tag_final)."',
				'".mysqli_real_escape_string($dbconnect, $date).
				"')";
			$proj_query=mysqli_query($dbconnect, $proj_sql);


		}
		unset($_POST['addp']);
		header("Location:library.php"); 
	}
?>