<?php
	include("dbconnect.php");
	include("upload_photo.php");
	session_start();

	date_default_timezone_set('US/Eastern');
	
	if(empty($_POST)){
		header("Location:library.php");
	}
	else{
		$fname=$_POST['firstname'];
		$lname=$_POST['lastname'];
		$pitch=$_POST['pitch'];

		$old_pass=sha1($_POST['old_pass']);
		$new_pass=sha1($_POST['pass_signup']);
		$new_pass_verify=sha1($_POST['pass_signup_verify']);

		$date=date('Y-m-d H:i:s:u');

		$id=$_SESSION['usr'];

		$profilepic=$_FILES['profilepic'];

		$pass_sql="SELECT * FROM users WHERE usrID=".$id;
		$pass_qry=mysqli_query($dbconnect, $pass_sql);
		$pass_res=mysqli_fetch_assoc($pass_qry);

		$varbool=empty($fname) || empty($lname) || empty($pitch);

		if($varbool==False){
			error_log($profilepic['tmp_name']);
			$prof_sql="UPDATE users SET 
			firstname='".mysqli_real_escape_string($dbconnect, $fname)."',
			lastname='".mysqli_real_escape_string($dbconnect, $lname)."',
			pitch='".mysqli_real_escape_string($dbconnect, $pitch)."'
			 WHERE usrID=".mysqli_real_escape_string($dbconnect, $id);		
			$prof_qry=mysqli_query($dbconnect, $prof_sql);

			if(is_uploaded_file($profilepic['tmp_name'])==true){

				$profilepic_name=$lname.$date;
				img_uploader($profilepic, "profilepic", $profilepic_name);

				$im_sql="UPDATE users SET
				profilepic='".mysqli_real_escape_string($dbconnect, $profilepic_name)."'
				 WHERE usrID=".mysqli_real_escape_string($dbconnect, $id);
				$im_qry=mysqli_query($dbconnect,$im_sql);

			}
			if($old_pass===$pass_res['password']){
				if($new_pass===$new_pass_verify){
					error_log("pass_leak");
					$passSQL="UPDATE users SET
					password='".mysqli_real_escape_string($dbconnect, $new_pass)."'
					 WHERE usrID=".mysqli_real_escape_string($dbconnect, $id);
					$passqry=mysqli_query($dbconnect, $passSQL);



				}
			
			}


		}
		header("Location:library.php");
		unset($_POST['prof_set']); 



	}



?>