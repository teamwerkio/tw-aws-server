<?php
	session_start();
	include("dbconnect.php");
	if(isset($_GET['action'])) {
		if ($_GET['action']=="logout") {
			unset($_SESSION['usr']);
		}
	}

	if(isset($_POST['login'])) {
		$login_sql = "SELECT * FROM users WHERE email='".$_POST['email']."' AND password='".sha1($_POST['pass'])."'";
		if($login_query=mysqli_query($dbconnect, $login_sql)) {
			$login_rs=mysqli_fetch_assoc($login_query);
			$_SESSION['usr']=$login_rs['usrID'];

			
		} 

	  
		
	} elseif (isset($_POST['signup'])) {
		include("register_form.php");
	}

	if(!isset($_SESSION['usr'])) {
		include("login.php");
	} else{
		header("Location:library.php");
		exit;
	}
?>