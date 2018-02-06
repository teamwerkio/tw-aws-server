<?php
	include("dbconnect.php");
	session_start();
	if(!isset($_POST['proj_set'])){
		header("Location:project.php?projID=".$_GET['projID']);
	}
	else{
		$size=$_POST['teamsize'];
		$commit=$_POST['commit'];
		$prog=$_POST['progress'];

		$id=$_GET['projID'];

		$set_sql="UPDATE project SET tsizeID=".mysqli_real_escape_string($dbconnect, $size).", commID=".mysqli_real_escape_string($dbconnect, $commit).", progress=".mysqli_real_escape_string($dbconnect, $prog)." WHERE projID=".mysqli_real_escape_string($dbconnect, $id);
		$set_qry=mysqli_query($dbconnect, $set_sql);

		unset($_POST['proj_set']);
		header("Location:project.php?projID=".$_GET['projID']);
	}
?>