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

<script>window.fbAsyncInit = function() {
    FB.init({
      appId      : "1841177166173972",
      xfbml      : true,
      version    : 'v2.12'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));</script>		


		<main id="main" class="site-main" style="margin-bottom: 0px; padding-bottom: 0px;">
			<div class="container">
				<div class="main-content">
					<div class="form-login form-register">
						<h2 align="center">Connect with Facebook</h2>
						<p align="center">Connect your Teamwerk account with Facebook so we can find you the top projects that would interest you the most.</p>
						
						<div id="fbcenter" style="margin-top: 25px;">
							<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
</body>
</html>
