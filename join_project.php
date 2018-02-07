<?php
	include("dbconnect.php");
	session_start();
	
	if(!isset($_SESSION['usr'])){
		header("Location:usr.php");
	}
	$role_sql="SELECT * FROM team_roles WHERE (projID=".$_GET['projID'].") AND (status=0)";
	$role_qry=mysqli_query($dbconnect, $role_sql);
	$role_res=mysqli_fetch_assoc($role_qry);

	$usr_sql="SELECT * FROM users WHERE usrID=".$_SESSION['usr'];
	$usr_qry=mysqli_query($dbconnect, $usr_sql);
	$usr_res=mysqli_fetch_assoc($usr_qry);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Join Project | Teamwerk</title>

    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />
    <link rel="icon" href="images/favicon.png" type="image/x-icon"/>
</head>

<body class="campaign-detail">		

		<main id="main" class="site-main">
			<div style="margin-top: 50px;"></div>
			<div class="campaign-form form-update">
				<div class="container">
					<form id="proj_join" name="join_proj" action="join_project_submit.php?projID=<?php echo $_GET['projID'];?>" method="post" enctype="multipart/form-data">
<!-- 						<div class="date">
							<label for="">Date *</label>
							<span class="label-desc">Date for the entry</span>
		  					<input type="date" placeholder="" />
		  				</div> -->
						<div class="field clearfix">
		  					<label for="">Role *</label>
							<span class="label-desc">Choose a role you want to apply for.</span>
			  				<div class="field">
			  					<div class="field-select">
									<select name="j_role" id="">
										<option value="">Select a Role</option>
										<?php
											do{
												?>
													<option value="<?php echo $role_res['roleID']?>"><?php echo $role_res['title']?></option>
												<?php
											}while($role_res=mysqli_fetch_assoc($role_qry));
										?>
<!-- 										<option value="1">A</option>
										<option value="2">B</option>
										<option value="3">C</option>
										<option value="4">D</option>
										<option value="5">E</option> -->
									</select>
								</div>
			  				</div>
						</div>
						<div class="field" style="margin-top: 20px;">
							<label for="title">Why this project?</label>
							<span class="label-desc">Tell us why this project excites you? Why you want to join this role?</span>
		  					<textarea name="j_reason" rows="4" placeholder="Enter upto 140 characters"></textarea>
		  					<label for="count" style="font-weight: normal; font-size: 10px;">     0 characters</label>
		  				</div>
						<div class="payment" style="margin-top: 0px;">
							<h4 style="font-size: 14px; margin-bottom: 15px;">Preferred email *</h4>
							<h5 style="font-weight: normal; color: #555555; font-size: 14px; margin-bottom: 15px;">The project owner will be sent an email about your interest in the project.<br>You will be CC'd on the email so they can easily contact you.</h5>
							<ul>
								<li>
									<input type="radio" id="p-option" name="e_select" value="<?php echo $usr_res['email'];?>">
									<label for="p-option"><?php echo $usr_res['email'];?></label>
									<div class="payment-check"></div>
									<!-- <div class="payment-desc"><p>The project owner will be sent an email about your interest in the project. You will be CC'd on the email so they can easily contact you.</p></div> -->
								</li>
								<li>
									<input type="radio" id="p1-option" name="e_select" value="1">
									<label for="p1-option">Other Email</label>
									<div class="payment-check"></div>
									<textarea name="other_email" rows="1" placeholder="Enter another email address"></textarea>
								</li>
							</ul>
						</div>
					</form>
				</div>
			</div>
		</main>
	</div>
</body>
</html>