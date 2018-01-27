<?php
	include("dbconnect.php");
	session_start();
	if(!isset($_POST['add_update'])){
		header("Location:project.php?projID=".$_GET['projID']);
	}
	else{
		date_default_timezone_set('US/Eastern');
		$projID=$_GET['projID'];
		$title=$_POST['title'];
		$desc=$_POST['desc'];
		$date=date('Y-m-d H:i:s:u');

		$fieldbool=$title=="" || $desc=="";
		if($fieldbool==false){
			$up_sql="INSERT INTO proj_updates (projID, title, details, dt) VALUES ('".mysqli_real_escape_string($dbconnect, $projID)."', '".
			mysqli_real_escape_string($dbconnect, $title)."', '".
			mysqli_real_escape_string($dbconnect, $desc)."', '".
			mysqli_real_escape_string($dbconnect, $date)."')";

			$up_qry=mysqli_query($dbconnect, $up_sql);

			unset($_POST['add_update']);
			echo "<script>window.opener.location.reload(); window.close();</script>";
		}
	}
?>