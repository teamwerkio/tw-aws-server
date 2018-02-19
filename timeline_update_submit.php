<?php
	include("dbconnect.php");
	session_start();
	
	if(empty($_POST)){
		header("Location:project.php?projID=".$_GET['projID']);
		
	}
	else{
		error_log("timeline");
		$projID=$_GET['projID'];
		$title=$_POST['title'];
		$desc=$_POST['desc'];		
		$fieldbool=$title=="" || $desc=="";

		if($fieldbool==False){
			
			$up_sql="UPDATE proj_updates SET
			title='".mysqli_real_escape_string($dbconnect, $title)."',
			details='".mysqli_real_escape_string($dbconnect, $desc)."' WHERE upID=".$_GET['upID'];
			error_log($up_sql);
			$up_qry=mysqli_query($dbconnect, $up_sql);

			unset($_POST['edit_update']);
			// echo "<script>window.opener.location.reload(); window.close();</script>";
			// header("Location:project.php?projID=".$_GET['projID']);
		}
	}
?>