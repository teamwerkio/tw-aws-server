<?php
	include("dbconnect.php");
	session_start();
	error_log("logging update");
	if(empty($_POST)){
		header("Location:project.php?projID=".$_GET['projID']);
		
	}
	else{
		
		$projID=$_GET['projID'];
		$title=$_POST['title'];
		$desc=$_POST['desc'];
		$time=$_POST['time'];
		$freq=$_POST['freq'];
		$loc=$_POST['location'];
		$colID=$_POST['college'];
		
		$fieldbool=$title=="" || $desc=="";

		if($fieldbool==False){

			$role_sql="UPDATE team_roles SET 
			title='".mysqli_real_escape_string($dbconnect, $title)."',
			description='".mysqli_real_escape_string($dbconnect, $desc)."',
			meet_time='".mysqli_real_escape_string($dbconnect, $time)."',
			meet_freq='".mysqli_real_escape_string($dbconnect, $freq)."',
			location='".mysqli_real_escape_string($dbconnect, $loc)."',
			colID='".mysqli_real_escape_string($dbconnect, $colID)."' WHERE roleID=".$_GET['roleID'];
			$role_qry=mysqli_query($dbconnect, $role_sql);

			unset($_POST['edit_role']);
			
			// header("Location:project.php?projID=".$_GET['projID']);
		}
	}
?>