<?php
	$parsed_ini=parse_ini_file("../../fb.ini", true);
	$app_id=$parsed_ini['FB']['app_id'];
	$app_secret=$parsed_ini['FB']['app_secret'];
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Social Connect | Teamwerk</title>

    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />
    <link rel="icon" href="images/favicon.png" type="image/x-icon"/>

    <style type="text/css">
    	#fbcenter {
			margin: 0 auto;
			text-align: center;
		}
    </style>

</head>

<body class="campaign-detail">

<div id="fb-root"></div>

<script>

  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else {
      // The person is not logged into your app or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    }
  }


  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId: <?php echo $app_id;?>,
      autoLogAppEvents : true,
      xfbml            : true,
      cookie: true, // This is important, it's not enabled by default
      version: 'v2.2'
    });


    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });


  };


  (function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
    });
  }



</script>		


		<main id="main" class="site-main" style="margin-bottom: 0px; padding-bottom: 0px;">
			<div class="container">
				<div class="main-content">
					<div class="form-login form-register">
						<h2 align="center">Connect with Facebook</h2>
						<p align="center">Connect your Teamwerk account with Facebook so we can find you the top projects that would interest you the most.</p>
						
						<div id="fbcenter" style="margin-top: 25px;">
							<fb:login-button size="xlarge" scope="public_profile,email" onlogin="checkLoginState();">Continue with Facebook
							</fb:login-button>
              

							<!-- <div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"> --></div>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
</body>
</html>
