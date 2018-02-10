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

			$user_sql="SELECT * FROM users WHERE usrID=".$_SESSION['usr'];
			$user_qry=mysqli_query($dbconnect, $user_sql);
			$user_res=mysqli_fetch_assoc($user_qry);

			function returnCat($table, $col, $idx, $dbconnect, $idtype){
				$cat_sql="SELECT ".$col." FROM ".$table." WHERE ".$idtype."='".$idx."'";
				$cat_qry=mysqli_query($dbconnect, $cat_sql);
				$cat_res=mysqli_fetch_assoc($cat_qry);
				return $cat_res[$col];
			}

			$teamLID=returnCat('project', 'usrID', $projID, $dbconnect, 'projID');
			
			$lsql="SELECT * FROM users WHERE usrID=".$teamLID;
			$lqry=mysqli_query($dbconnect, $lsql);
			$lres=mysqli_fetch_assoc($lqry);

			userEmail($email, $user_res['firstname'], $lres['email'], $lres['firstname']);
			leaderEmail($lres['email'], $lres['firstname'], $email, $user_res['firstname']);
			unset($_POST['join_proj']);
			
		}
	}
?>