<?php
	include("dbconnect.php");
	session_start();
	if(!isset($_POST['proj_role'])){
		header("Location:project.php?projID=".$_GET['projID']);
	}
	else{
		date_default_timezone_set('US/Eastern');
		$projID=$_GET['projID'];
		$title=$_POST['title'];
		$desc=$_POST['desc'];
		$time=$_POST['time'];
		$freq=$_POST['freq'];
		$loc=$_POST['location'];
		$colID=$_POST['college'];
		$date=date('Y-m-d H:i:s:u');
		$fieldbool=$title=="" || $desc=="";

		if($fieldbool==False){

			$role_sql="INSERT INTO team_roles (projID, title, description, meet_time, meet_freq, location, colID, dt) VALUES ('".mysqli_real_escape_string($dbconnect, $projID)."', '".
			mysqli_real_escape_string($dbconnect, $title)."', '".
			mysqli_real_escape_string($dbconnect, $desc)."', '".
			mysqli_real_escape_string($dbconnect, $time)."', '".
			mysqli_real_escape_string($dbconnect, $freq)."', '".
			mysqli_real_escape_string($dbconnect, $loc)."', '".
			mysqli_real_escape_string($dbconnect, $colID)."', '".
			mysqli_real_escape_string($dbconnect, $date)."')";
			$role_qry=mysqli_query($dbconnect, $role_sql);

			unset($_POST['proj_role']);
			echo "<script>window.opener.location.reload(); window.close();</script>";
			// header("Location:project.php?projID=".$_GET['projID']);
		}
	}
?>