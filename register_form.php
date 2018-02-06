<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'on');
	include("dbconnect.php");
	include("upload_photo.php");

	date_default_timezone_set('US/Eastern');
	$name_f=$_POST['firstname'];
	$name_l=$_POST['lastname'];
	$email=$_POST['email_signup'];
	$pitch=$_POST['pitch'];
	$pass=sha1($_POST['pass_signup']);
	$date=date('Y-m-d H:i:s:u');
	$fieldbool=$name_f=="" || $name_l=="" || $email=="" || $pass=="" || $pitch=="";




	if($fieldbool) {
	?>
	<div class="alert alert-warning">
		<strong>One or more fields are empty.</strong>
	</div>

	<?php
	}

	if($fieldbool==False) {
		
		if(getimagesize($_FILES['profilepic']['tmp_name'])==False){
			$signup_sql = "INSERT INTO users (firstname, lastname, email, pitch, password, dt) VALUES ('".mysqli_real_escape_string($dbconnect, $name_f)."', '".
			mysqli_real_escape_string($dbconnect, $name_l)."', '".
			mysqli_real_escape_string($dbconnect, $email)."', '".
			mysqli_real_escape_string($dbconnect, $pitch)."', '".
			mysqli_real_escape_string($dbconnect, $pass)."', '".
			mysqli_real_escape_string($dbconnect, $date)."')";
		}
		else{
			$new_name=$name_l.$date;
			img_uploader($_FILES['profilepic'], "profilepic", $new_name);


			
			// $img_name=$name_l.$date.'.'.end(explode(".", $_FILES['profilepic']['name']));
			// $target_dir="../img_assets/profilepic/";
			// move_uploaded_file($_FILES['profilepic']['tmp_name'], $target_dir.$img_name);
			$signup_sql = "INSERT INTO users (firstname, lastname, email, pitch, password, profilepic, dt) VALUES ('".mysqli_real_escape_string($dbconnect, $name_f)."', '".
			mysqli_real_escape_string($dbconnect, $name_l)."', '".
			mysqli_real_escape_string($dbconnect, $email)."', '".
			mysqli_real_escape_string($dbconnect, $pitch)."', '".
			mysqli_real_escape_string($dbconnect, $pass)."', '".
			mysqli_real_escape_string($dbconnect, $new_name)."', '".
			mysqli_real_escape_string($dbconnect, $date)."')";

		}

		$signup_qry = mysqli_query($dbconnect, $signup_sql);

		$signup2_qry=mysqli_query($dbconnect, "SELECT * FROM users WHERE email='".$email."'");
		$signup2_res=mysqli_fetch_assoc($signup2_qry);

		$_SESSION['usr']=$signup2_res['usrID'];

	}

	unset($_POST['signup']);
	


?>
