<?php
	include("dbconnect.php");
	session_start();
	include("upload_photo.php");

	$parsed_ini=parse_ini_file("../../fb.ini", true);
	$app_id=$parsed_ini['FB']['app_id'];
	$app_secret=$parsed_ini['FB']['app_secret'];



	
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

	$json_status="0";
	if($json_usr_data!=""){
		$json_status="1";
		error_log($json_usr_data);
	}

	$fbSQL="UPDATE users SET 
	fb_data_status='".mysqli_real_escape_string($dbconnect, $json_status)."' WHERE usrID=".mysqli_real_escape_string($dbconnect, $_SESSION['usr']);
	$fbQRY=mysqli_query($dbconnect, $fbSQL);

	error_log($fbQRY);
	if($json_usr_data!=""){
		$tmpFile=tmpfile();
		fwrite($tmpFile, $json_usr_data);
		fseek($tmpFile,0);
		$tmp_dir=stream_get_meta_data($tmpFile)['uri'];
		$new_name=$_SESSION['usr']."_fb_data";
		json_uploader($tmp_dir, $new_name);
		fclose($tmpFile);

		
	}
	
?>