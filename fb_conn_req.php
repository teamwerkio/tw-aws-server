<?php
	require_once __DIR__ . '../vendor/autoload.php'; // change path as needed
	$parsed_ini=parse_ini_file("../../fb.ini", true);
	$app_id=$parsed_ini['FB']['app_id'];
	$app_secret=$parsed_ini['FB']['app_secret'];

	$fb = new \Facebook\Facebook([
	  'app_id' => $app_id,
	  'app_secret' => $app_secret,
	  'default_graph_version' => 'v2.12',
	  //'default_access_token' => '{access-token}', // optional
	]);

	$redirect="login.php";
	// Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
	$helper = $fb->getRedirectLoginHelper();

	//   $helper = $fb->getJavaScriptHelper();
	//   $helper = $fb->getCanvasHelper();
	//   $helper = $fb->getPageTabHelper();

	try {
	  // Get the \Facebook\GraphNodes\GraphUser object for the current user.
	  // If you provided a 'default_access_token', the '{access-token}' is optional.
	  // $response = $fb->get('/me', '{access-token}');
		$access_token=$helper->getAccessToken();
	} catch(\Facebook\Exceptions\FacebookResponseException $e) {
	  // When Graph returns an error
	  echo 'Graph returned an error: ' . $e->getMessage();
	  exit;
	} catch(\Facebook\Exceptions\FacebookSDKException $e) {
	  // When validation fails or other local issues
	  echo 'Facebook SDK returned an error: ' . $e->getMessage();
	  exit;
	}
	if(!isset($access_token)){
		$permission=['email'];
		$loginurl=$helper->getLoginUrl($redirect, $permission);
	}
	else{
		$fb->setDefaultAccessToken($access_token);
		try {
		  $response = $fb->get('/me?fields=email,name');
		  $userNode = $response->getGraphUser();
		}catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}
		error_log('Name '.$userNode->getName());
		error_log('Email '.$userNode->getProperty('email'));
		error_log('uID '.$userNode->getId());

		
	}

?>