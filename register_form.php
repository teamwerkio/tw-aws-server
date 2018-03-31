<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'on');
	include("dbconnect.php");
	include("upload_photo.php");
	error_log("here ".$_FILES['profilepic']['error']);


	date_default_timezone_set('US/Eastern');
	$name_f=$_POST['firstname'];
	$name_l=$_POST['lastname'];
	$email=$_POST['email_signup'];
	
	$pitch=$_POST['pitch'];
	$pass=sha1($_POST['pass_signup']);
	$pass_v=sha1($_POST['pass_signup_verify']);
	$avatar="";
	if(isset($_POST['avatar'])){
		$avatar=$_POST['avatar'];
	}
	
	$date=date('Y-m-d H:i:s:u');

	$int_sql="SELECT * FROM proj_categories";
	$int_qry=mysqli_query($dbconnect, $int_sql);
	$int_res=mysqli_fetch_assoc($int_qry);
	$int_array=array();
	do{
		if(isset($_POST['chk_'.$int_res['catID']])){
			array_push($int_array, $int_res['catID']);
			error_log("pushing");
		}
	}while($int_res=mysqli_fetch_assoc($int_qry));

	// $json_status="0";
	// if($json_usr_data!=""){
	// 	$json_status="1";
	// }
	$fieldbool=$name_f=="" || $name_l=="" || $email=="" || $pass=="" || empty($int_array) || $pass!=$pass_v;




	if($fieldbool) {
	?>
	<div class="alert alert-warning">
		<strong>One or more fields are empty.</strong>
	</div>

	<?php
	}

	if($fieldbool==False) {
		
		if(is_uploaded_file($_FILES['profilepic']['tmp_name'])==False){
			error_log("Showing false image");
			error_log($_FILES["profilepic"]["tmp_name"]);
			$signup_sql = "INSERT INTO users (firstname, lastname, email, pitch, password, profilepic, dt) VALUES ('".mysqli_real_escape_string($dbconnect, $name_f)."', '".
			mysqli_real_escape_string($dbconnect, $name_l)."', '".
			mysqli_real_escape_string($dbconnect, $email)."', '".
			mysqli_real_escape_string($dbconnect, $pitch)."', '".
			mysqli_real_escape_string($dbconnect, $pass)."', '".
			mysqli_real_escape_string($dbconnect, $avatar)."', '".
			mysqli_real_escape_string($dbconnect, $date)."')";
			
		}
		else{
			$new_name=$name_l.$date;
			img_uploader($_FILES['profilepic'], "profilepic", $new_name);
			

			$new_json=new \stdClass();
			$new_json->prefs=$int_array;
			$new_json_str=json_encode($new_json);
			
			// $img_name=$name_l.$date.'.'.end(explode(".", $_FILES['profilepic']['name']));
			// $target_dir="../img_assets/profilepic/";
			// move_uploaded_file($_FILES['profilepic']['tmp_name'], $target_dir.$img_name);
			$signup_sql = "INSERT INTO users (firstname, lastname, email, pitch, password, profilepic, prefs, dt) VALUES ('".mysqli_real_escape_string($dbconnect, $name_f)."', '".
			mysqli_real_escape_string($dbconnect, $name_l)."', '".
			mysqli_real_escape_string($dbconnect, $email)."', '".
			mysqli_real_escape_string($dbconnect, $pitch)."', '".
			mysqli_real_escape_string($dbconnect, $pass)."', '".
			mysqli_real_escape_string($dbconnect, $new_name)."', '".
			mysqli_real_escape_string($dbconnect, $new_json_str)."', '".
			mysqli_real_escape_string($dbconnect, $date)."')";

		}

		$signup_qry = mysqli_query($dbconnect, $signup_sql);

		$signup2_qry=mysqli_query($dbconnect, "SELECT * FROM users WHERE email='".$email."'");
		$signup2_res=mysqli_fetch_assoc($signup2_qry);

		$_SESSION['usr']=$signup2_res['usrID'];
		$_SESSION['fb']="fb";
		// if($json_usr_data!=""){
		// 	$tmpFile=tmpfile();
		// 	fwrite($tmpFile, $json_usr_data);
		// 	fseek($tmpFile,0);
		// 	$tmp_dir=stream_get_meta_data($tmpFile)['uri'];
		// 	$new_name=$_SESSION['usr']."_fb_data";
		// 	json_uploader($tmp_dir, $new_name);
		// 	fclose($tmpFile);

			
		// }
		error_log("session: ".$_SESSION['usr']);
		

		

	}

	// unset($_POST['signup']);
	


?>
