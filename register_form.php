<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'on');
	include("dbconnect.php");
	include("upload_photo.php");
	error_log("here");


	$parsed_ini=parse_ini_file("../../fb.ini", true);
	$app_id=$parsed_ini['FB']['app_id'];
	$app_secret=$parsed_ini['FB']['app_secret'];



	# /js-login.php
	$fb = new Facebook\Facebook([
	  'app_id' => $app_id,
	  'app_secret' => $app_secret,
	  'default_graph_version' => 'v2.2',
	  ]);

	$helper = $fb->getJavaScriptHelper();

	try {
	  $accessToken = $helper->getAccessToken();
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
	  // When Graph returns an error
	  echo 'Graph returned an error: ' . $e->getMessage();
	  
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
	  // When validation fails or other local issues
	  echo 'Facebook SDK returned an error: ' . $e->getMessage();
	  
	}
	$json_usr_data="";
	if (isset($accessToken)) {
		$fb->setDefaultAccessToken($accessToken);
		try {
		  $response = $fb->get('/me?fields=name,posts,likes,education,work');
		  $json_arr=$response->getDecodedBody();
		  $json_usr_data=json_encode($json_arr);
		}catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  
		}
	}



	date_default_timezone_set('US/Eastern');
	$name_f=$_POST['firstname'];
	$name_l=$_POST['lastname'];
	$email=$_POST['email_signup'].'@'.$_POST['em_ext'];
	
	$pitch=$_POST['pitch'];
	$pass=sha1($_POST['pass_signup']);
	$pass_v=sha1($_POST['pass_signup_verify']);
	
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
	error_log($pass!=$pass_v);

	$json_status="0";
	if($json_usr_data!=""){
		$json_status="1";
	}
	$fieldbool=$name_f=="" || $name_l=="" || $email=="" || $pass=="" || $pitch=="" || empty($int_array) || $pass!=$pass_v;




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
			$signup_sql = "INSERT INTO users (firstname, lastname, email, pitch, password, fb_data_status, dt) VALUES ('".mysqli_real_escape_string($dbconnect, $name_f)."', '".
			mysqli_real_escape_string($dbconnect, $name_l)."', '".
			mysqli_real_escape_string($dbconnect, $email)."', '".
			mysqli_real_escape_string($dbconnect, $pitch)."', '".
			mysqli_real_escape_string($dbconnect, $pass)."', '".
			mysqli_real_escape_string($dbconnect, $json_status)."', '".
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
			$signup_sql = "INSERT INTO users (firstname, lastname, email, pitch, password, profilepic, prefs, fb_data_status, dt) VALUES ('".mysqli_real_escape_string($dbconnect, $name_f)."', '".
			mysqli_real_escape_string($dbconnect, $name_l)."', '".
			mysqli_real_escape_string($dbconnect, $email)."', '".
			mysqli_real_escape_string($dbconnect, $pitch)."', '".
			mysqli_real_escape_string($dbconnect, $pass)."', '".
			mysqli_real_escape_string($dbconnect, $new_name)."', '".
			mysqli_real_escape_string($dbconnect, $new_json_str)."', '".
			mysqli_real_escape_string($dbconnect, $json_status)."', '".
			mysqli_real_escape_string($dbconnect, $date)."')";

		}

		$signup_qry = mysqli_query($dbconnect, $signup_sql);

		$signup2_qry=mysqli_query($dbconnect, "SELECT * FROM users WHERE email='".$email."'");
		$signup2_res=mysqli_fetch_assoc($signup2_qry);

		$_SESSION['usr']=$signup2_res['usrID'];
		if($json_usr_data!=""){
			$tmpFile=tmpfile();
			fwrite($tmpFile, $json_usr_data);
			fseek($tmpFile,0);
			$tmp_dir=stream_get_meta_data($tmpFile)['uri'];
			$new_name=$_SESSION['usr']."_fb_data";
			json_uploader($tmp_dir, $new_name);
			fclose($tmpFile);

			
		}
		error_log("session: ".$_SESSION['usr']);
		

		

	}

	// unset($_POST['signup']);
	


?>
