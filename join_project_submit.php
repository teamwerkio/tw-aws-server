<?php
	include("dbconnect.php");
	
	session_start();
	if(empty($_POST)){
		header("Location:project.php?projID=".$_GET['projID']);
	}
	else{
		date_default_timezone_set('US/Eastern');
		$projID=$_GET['projID'];
		$usrID=$_SESSION['usr'];
		$roleID=$_POST['j_role'];
		$reason=$_POST['j_reason'];
		$email="";
		if($_POST['e_select']==="1"){
			$email=$_POST['other_email'];
		}else{
			$email=$_POST['e_select'];
		}
		$date=date('Y-m-d H:i:s:u');

		$fieldbool=$reason=="" || $email=="" || $roleID=="";

		if($fieldbool==False){
			$req_sql="INSERT INTO join_req (projID, usrID, roleID, reason, email_pref, dt) VALUES ('".
			mysqli_real_escape_string($dbconnect, $projID)."', '".
			mysqli_real_escape_string($dbconnect, $usrID)."', '".
			mysqli_real_escape_string($dbconnect, $roleID)."', '".
			mysqli_real_escape_string($dbconnect, $reason)."', '".
			mysqli_real_escape_string($dbconnect, $email)."', '".
			mysqli_real_escape_string($dbconnect, $date)."')";

			$req_qry=mysqli_query($dbconnect, $req_sql);
			// header("Location:project.php?projID=".$_GET['projID']);
			include("noreply_join_email.php");
			unset($_POST['join_proj']);
			
		}
	}
?>