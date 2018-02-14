<?php
	include("dbconnect.php");
	@session_start();
	if(isset($_SESSION['usr'])){
		header("Location:library.php");
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign up for Teamwerk | Teamwerk</title>

	<!-- Style CSS -->
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />
    <link rel="icon" href="../images/favicon.png" type="image/x-icon"/>

    <!-- bootstrap wrappable css to avoid conflicts -->
  	<link rel="stylesheet" href="https://formden.com/static/assets/demos/bootstrap-iso/bootstrap-iso/bootstrap-iso.css">
  	<link rel="stylesheet" href="https://formden.com/static/assets/demos/bootstrap-iso/bootstrap-iso/bootstrap-iso.css">

    <style type="text/css">
		/* Create two equal columns that floats next to each other */
		.column {
			float: left;
			width: 50%;
			padding: 10px;
		}

		.row:after {
			content: "";
			display: table;
			clear: both;
		}
		#fbcenter {
			margin: 0 auto;
			text-align: center;
		}
    </style>
</head>

<body>

<!-- <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId=111072682828913&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script> -->

	<div id="wrapper">
		<header id="header" class="site-header">
			<div class="container">
				<div class="site-brand">
					<a href="landing.php"><img src="../images/assets/logo.png" style="width: 205px; height: 40px;" alt=""></a>
				</div><!-- .site-brand -->
				<div class="right-header">					
					<div class="login login-button">
						<a href="login.php" class="btn-primary">Log In</a>
					</div><!-- .login -->
				</div><!--. right-header -->
			</div><!-- .container -->
		</header><!-- .site-header -->
		<main id="main" class="site-main">
			<div class="page-title background-page">
				<div class="container">
					<h1>Sign Up</h1>
					<div class="breadcrumbs">
						<ul>
							<li><a href="http://www.teamwerk.io">Home</a><span>/</span></li>
							<li>Sign Up</li>
						</ul>
					</div>
				</div>
			</div> <!-- .page-title -->
			<div class="container">
				<div class="main-content">
					<div class="form-login form-register">
						<!-- <h2 align="center">Sign up with Facebook</h2>
						<hr>
						<div id="fbcenter">
							<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true"></div>
						</div> -->

						<!-- <h2 align="center" style="margin-top: 35px;">Create an account</h2>
						<hr> -->
						<h2>Create an account</h2>
						<form id="reg_form" name="signup" action="usr.php" method="post" enctype="multipart/form-data" id="registerForm" class="clearfix">
			  				<div class="field">
			  					<input name="firstname" type="text" value="" name="s" placeholder="First Name" />
			  				</div>
			  				<div class="field">
			  					<input name="lastname" type="text" value="" name="s" placeholder="Last Name" />
			  				</div>
			  				<div class="field">
			  					<input name="pitch" type="text" value="" name="s" placeholder="Talk to me about ..." />
			  				</div>
			  				<div class="row">
			  					<div class="coloumn" style="margin-left: 15px; width: 49%;">
					  				<div class="field">
					  					<input name="email_signup" type="email" value="" name="s" placeholder="College Email" />
					  				</div>
					  			</div>
					  			<div class="coloumn" style="margin-left: 5px; width: 200px;">
					  				<div class="field clearfix">
						  				<div class="field">
						  					<div class="field-select">
												<select name="em_ext" id="" style="margin-bottom: 0px; border-radius: 0px;">
													<option value="hampshire.edu">@hampshire.edu</option>
													<option value="umass.edu">@umass.edu</option>
													<option value="mtholyoke.edu">@mtholyoke.edu</option>
													<option value="smith.edu">@smith.edu</option>
													<option value="amherst.edu">@amherst.edu</option>
												</select>
											</div>
						  				</div>
									</div>
								</div>
							</div>
			  				<div class="field">
			  					<input name="pass_signup" type="password" value="" name="s" placeholder="Password" />
			  				</div>
			  				<div class="field">
			  					<input name="pass_signup_verify" type="password" value="" name="s" placeholder="Verify your password" />
			  				</div>
			  				<?php
			  					$int_sql="SELECT * FROM proj_categories";
			  					$int_qry=mysqli_query($dbconnect, $int_sql);
			  					$count=mysqli_num_rows($int_qry);
			  					$int_res=mysqli_fetch_assoc($int_qry);
			  					$half=$count/2;

			  				?>
			  				<div class="payment" style="margin-top: 0px;">
								<h4 style="font-size: 14px; margin-bottom: 5px; font-weight: bold; color: #555555">Your top interests *</h4>
								<h5 style="font-weight: normal; color: #555555; font-size: 14px; font-style: italic;">Pick your top interests</h5>
								<div class="row" style="padding-left: 6px;">
									<div class="column">
										<?php
											


												do{
													if($count>$half){
														?>
														<div class="create-account" style="margin-top: 10px;">
										  					<input type="checkbox" id="<?php echo $int_res['catID'];?>" name="chk_<?php echo $int_res['catID'];?>" value="<?php echo $int_res['catID'];?>">
										  					<label for="<?php echo $int_res['catID'];?>" style="padding-left: 22px;"><?php echo $int_res['catName'];?></label>
										  					<div class="checkbox" style="margin-top: 2px;"></div>
									  					</div>

														<?php
														$count-=1;
													}
													else{
														break;
													}
												}while($int_res=mysqli_fetch_assoc($int_qry));
											
										?>
<!-- 										<div class="create-account" style="margin-top: 10px;">
						  					<input type="checkbox" id="1" name="" value="">
						  					<label for="1" style="padding-left: 22px;">Design & Art</label>
						  					<div class="checkbox" style="margin-top: 2px;"></div>
					  					</div>
					  					<div class="create-account" style="margin-top: 10px;">
						  					<input type="checkbox" id="2" name="" value="">
						  					<label for="2" style="padding-left: 22px;">Film & Video</label>
						  					<div class="checkbox" style="margin-top: 2px;"></div>
					  					</div>
					  					<div class="create-account" style="margin-top: 10px;">
						  					<input type="checkbox" id="3" name="" value="">
						  					<label for="3" style="padding-left: 22px;">Books</label>
						  					<div class="checkbox" style="margin-top: 2px;"></div>
					  					</div>
					  					<div class="create-account" style="margin-top: 10px;">
						  					<input type="checkbox" id="4" name="" value="">
						  					<label for="4" style="padding-left: 22px;">Performances</label>
						  					<div class="checkbox" style="margin-top: 2px;"></div>
					  					</div> -->
				  					</div>
				  					<div class="column">
				  						<?php
				  							
				  								do{
				  									if($count<=$half){
				  									?>
								  						<div class="create-account" style="margin-top: 10px;">
										  					<input type="checkbox" id="<?php echo $int_res['catID'];?>" name="chk_<?php echo $int_res['catID'];?>" value="<?php echo $int_res['catID'];?>">
										  					<label for="<?php echo $int_res['catID'];?>" style="padding-left: 22px;"><?php echo $int_res['catName'];?></label>
										  					<div class="checkbox" style="margin-top: 2px;"></div>
									  					</div>
				  									<?php
				  									}else{
				  										break;
				  									}
				  								}while($int_res=mysqli_fetch_assoc($int_qry));
				  							
				  						?>
<!-- 										<div class="create-account" style="margin-top: 10px;">
						  					<input type="checkbox" id="5" name="" value="">
						  					<label for="5" style="padding-left: 22px;">Crafts</label>
						  					<div class="checkbox" style="margin-top: 2px;"></div>
					  					</div>
					  					<div class="create-account" style="margin-top: 10px;">
						  					<input type="checkbox" id="6" name="" value="">
						  					<label for="6" style="padding-left: 22px;">Technology</label>
						  					<div class="checkbox" style="margin-top: 2px;"></div>
					  					</div>
					  					<div class="create-account" style="margin-top: 10px;">
						  					<input type="checkbox" id="7" name="" value="">
						  					<label for="7" style="padding-left: 22px;">Food</label>
						  					<div class="checkbox" style="margin-top: 2px;"></div>
					  					</div>
					  					<div class="create-account" style="margin-top: 10px;">
						  					<input type="checkbox" id="8" name="" value="">
						  					<label for="8" style="padding-left: 22px;">Games</label>
						  					<div class="checkbox" style="margin-top: 2px;"></div>
					  					</div> -->
				  					</div>
				  				</div>

				  				<div class="field" style="margin-bottom: 0px; margin-top: 10px;">
				  					<p><strong>Upload a Profile Picture *</strong></p>
				  					<p><i>A size of 120 x 120 is preferred</i></p>
				  					<div class="file-upload">
				  						<div class="upload-bg">
					  						<div id="myfileupload1">
										   		<input type="file" id="uploadfile1" name="profilepic" onchange="readURL1(this);" />	  
										 	</div>
										 	<div id="thumbbox1">
										 		<img height="100" width="100" alt="Thumb image" id="thumbimage1" style="display: none" />
										  		<a class="removeimg1" href="javascript:" ></a>
										  	</div>
										 	<div id="boxchoice1">
										  		<a href="javascript:" class="choicefile1"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Upload Image</a>
										  		<p style="clear:both"></p>
										 	</div>
										  	<label class="filename1"></label>
					  					</div>
				  					</div>
				  				</div>

			  					<div class="create-account" style="margin-top: 14.5px; /*margin-bottom: 15px;*/ float: right;">
				  					<input type="checkbox" id="tou" name="" value="" checked>
				  					<label for="tou" style="padding-left: 22px;">I agree to the <u><a style="display: inline;" href="termsofuse.html">Terms of Use</a></u></label>
				  					<div class="checkbox" style="margin-top: 2px;"></div>
			  					</div>

			  					<div class="bootstrap-iso">
								<button id="createAccount" type="button" class="btn-mainb" data-toggle="modal" data-target="#modal-1" style="color: white;">Create Account</button>
								  <div class="modal fade" id="modal-1">
								    <div class="modal-dialog modal-lg" >
								      <div class="modal-content" style="height: 300px;">
								         <div class="modal-body">
								          <!-- <iframe id="if_createAccount" src="social_connect.php" style="width: 100%;" height="180" frameborder="0"> -->
<!-- 								          </iframe> -->
								         </div>
								         <div class="modal-footer">
								         	<a id="no_fb" href="">No, proceed without Facebook</a>
								          <!-- <button class="btn-mainb" data-dismiss="modal" style="cursor: pointer; width: 100px; color: white;">Close</button>
								          <button name="add_update" id="update_button" type="submit" value="Save & Launch" class="btn-mainb" style="cursor: pointer; width: 200px; color: white;">Add Update</button> -->
								         </div>
								      </div>
								    </div>
								  </div>
								</div>

			  				<!-- <div class="inline clearfix" style="margin-top: 10px;">
						  		<button type="submit" name="signup" class="btn-primary">Create Account</button>
						  	</div> -->
					  	</form>
					</div>
				</div>
			</div>	
		</main>
		<!-- .site-main -->

		<footer id="footer" class="site-footer">
			<div class="footer-menu">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-sm-4 col-4">
							<div class="footer-menu-item">
								<h3>Company</h3>
								<ul>
									<li><a href="about.html">About</a></li>
									<li><a href="press.html">Press</a></li>
									<li><a href="contact.html">Contact</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-sm-4 col-4">
							<div class="footer-menu-item">
								<h3>Community</h3>
								<ul>
									<li><a href="support.html">Support</a></li>
									<li><a href="guidelines.html">Guidelines</a></li>
									<li><a href="termsofuse.html">Terms of Use</a></li>
									<li><a href="privacypolicy.html">Privacy Policy</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-sm-4 col-4">
							<div class="footer-menu-item">
								<h3>Projects</h3>
								<ul>
									<li><a href="#">Technology</a></li>
									<li><a href="#">Games</a></li>
									<li><a href="#">Design &amp; Art</a></li>
									<li><a href="#">Film &amp; Video</a></li>
									<li><a href="#">Performances</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-sm-12 col-12">
							<div class="footer-menu-item newsletter">
								<h3>Subscribe</h3>
								<div class="newsletter-description">Join the Teamwerk community</div>
								<form action="s" method="POST" id="newsletterForm">
							  		<input type="text" value="" name="s" placeholder="Enter your email..." />
							    	<button type="submit" value=""><span class="ion-android-drafts"></span></button>
							  	</form>
							  	<!-- <div class="follow">
							  		<h3>Join us on</h3>
							  		<ul>
							  			<li class="facebook"><a target="_Blank" href="http://www.facebook.com"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							  			<li class="twitter"><a target="_Blank" href="http://www.twitter.com"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							  		</ul>
							  	</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-copyright">
				<div class="container">
					<p class="copyright">© Copyrights 2018 by Teamwerk. All Rights Reserved.</p>
					<a href="#" class="back-top">Back to top<span class="ion-android-arrow-up"></span></a>
				</div>
			</div>
		</footer> <!-- site-footer -->
	</div><!-- #wrapper -->
	<!-- jQuery -->    
    <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="libs/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="libs/owl-carousel/owl.carousel.min.js"></script>
    <script type="text/javascript" src="libs/jquery.countdown/jquery.countdown.min.js"></script>
    <script type="text/javascript" src="libs/wow/wow.min.js"></script>
    <script type="text/javascript" src="libs/isotope/isotope.pkgd.min.js"></script>
    <script type="text/javascript" src="libs/bxslider/jquery.bxslider.min.js"></script>
    <!-- orther script -->
    <script  type="text/javascript" src="js/main.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
    <script src="http://malsup.github.com/jquery.form.js"></script> 

    <script type="text/javascript">
    	// var formData;
    	$(document).ready(function(){
   //  		$('input[type=text],input[type=password],input[type=email],input[type=checkbox]').keyup(function() {
        
		 //    if ($('input[name=firstname]').val() !=''&&
			//     $('input[name=lastname]').val() != '' &&
			//     $('input[name=pitch]').val() != ''&&
			//     $('input[name=email_signup]').val() != ''&&
			//     $('input[name=pass_signup]').val() != ''&&
			//     $('input[name=pass_signup_verify]').val() != ''&&
			//     $("input[name^='chk_']:checked").length>1){
			      
		 //        $('#createAccount').removeAttr('disabled');
			//     } else {
			//         $('#createAccount').attr('disabled', 'disabled');
			//     }
			// });
    		
    		$('#createAccount').click(function(){
				// formData=new FormData($('#reg_form')[0]);
				var iframe='<iframe id="if_createAccount" src="social_connect.php" style="width: 100%;" height="180" frameborder="0">';
				$('.modal-body').html(iframe);

    		});
    		$('#no_fb').click(function(){
    			$("#reg_form").ajaxSubmit({url: 'usr.php', type: 'post'})
    // 			var request = new XMLHttpRequest();
				// request.open("POST", "usr.php");
				// request.send(formData);
    		});



    	});
    </script>
</body>
</html>