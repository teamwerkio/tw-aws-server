<?php

	session_start();
	include("dbconnect.php");
	if(isset($_GET['action'])) {
		if ($_GET['action']=="logout") {
			unset($_SESSION['usr']);
		}
	}

	if(isset($_POST['login'])) {
		$login_sql = "SELECT * FROM users WHERE email='".$_POST['email']."'";
		

		if($login_qry=mysqli_query($dbconnect, $login_sql)){
			$login_res=mysqli_fetch_assoc($login_qry);
			if(strlen($login_res['password'])==40 && hash('sha1', $_POST['pass'])===$login_res['password']){
				$up_sql="UPDATE users SET password='".hash('sha3-512', $_POST['pass'])."' WHERE email='".$_POST['email']."'";
				$up_qry=mysqli_query($dbconnect, $up_sql);
				if(!$up_qry){error_log("error in pass update");}
				$_SESSION['usr']=$login_res['usrID'];
			}
			elseif(hash('sha512', $_POST['pass'])===$login_res['password']){
				$up_sql="UPDATE users SET password='".hash('sha3-512', $_POST['pass'])."' WHERE email='".$_POST['email']."'";
				$up_qry=mysqli_query($dbconnect, $up_sql);
				if(!$up_qry){error_log("error in pass update");}
				$_SESSION['usr']=$login_res['usrID'];
			}
			elseif(hash('sha3-512', $_POST['pass'])===$login_res['password']){

				$_SESSION['usr']=$login_res['usrID'];
			}
		}	
	} elseif (isset($_POST['pass_signup_verify'])) {
		include("register_form.php");
	}

	if(isset($_SESSION['fb'])){
		header("Location:social_connect.php");
		exit;
	}
	elseif(!isset($_SESSION['usr'])) {
		include("login.php");
	} else{
		header("Location:library.php");
		exit;
	}
?>