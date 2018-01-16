<?php
	include("dbconnect.php");
	session_start();
	if(!isset($_POST['edit_update'])){
		header("Location:project.php?projID=".$_GET['projID']);
	}
	else{
		
		$projID=$_GET['projID'];
		$title=$_POST['title'];
		$desc=$_POST['desc'];		
		$fieldbool=$title=="" || $desc=="";

		if($fieldbool==False){

			$up_sql="UPDATE proj_updates SET 
			title='".mysqli_real_escape_string($dbconnect, $title)."',
			details='".mysqli_real_escape_string($dbconnect, $desc)."' WHERE upID=".$_GET['upID'];
			$up_qry=mysqli_query($dbconnect, $up_sql);

			unset($_POST['edit_update']);
			echo "<script>window.opener.location.reload(); window.close();</script>";
			// header("Location:project.php?projID=".$_GET['projID']);
		}
	}
?>