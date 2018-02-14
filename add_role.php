<?php
	include("dbconnect.php");
	session_start();
	
	if(!isset($_SESSION['usr'])){
		header("Location:usr.php");

	}
	
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add a role | Teamwerk</title>

    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />
    <link rel="icon" href="../images/favicon.png" type="image/x-icon"/>
</head>

<body class="campaign-detail">		

		<main id="main" class="site-main" style="margin-bottom: 0px; padding-bottom: 0px;">
			<div style="margin-top: 50px;"></div>
			<div class="campaign-form form-update">
				<div class="container">
					<form id="role_add" name="proj_role" action="add_role_submit.php?projID=<?php echo $_GET['projID'];?>" method="post" enctype="multipart/form-data">
						<div class="field" style="margin-top: 20px;">
							<label for="title">Role Title *</label>
							<span class="label-desc">Think of a cool title, for your cool teammate!</span>
		  					<input type="text" value="" name="title" placeholder="CE-Yo!" />
		  				</div>
		  				<div class="field">
							<label for="">Role Description *</label>
							<span class="label-desc">What would be the primary role for this team member? What is expected of them?</span>
		  					<textarea name="desc" rows="2" placeholder="Design marketing plans and social media campaign"></textarea>
		  				</div>
		  				<div class="field" style="margin-top: 20px;">
							<label for="title">What are your meeting times?</label>
							<span class="label-desc">Most high functioning teams meet during regular work days.</span>
		  					<input type="text" value="" name="time" placeholder="TTH 5:00PM to 7:00PM" />
		  				</div>
		  				<div class="field clearfix">
		  					<label for="">How often do these meetings take place?</label>
							<span class="label-desc">Most high functioning teams meet once a week!</span>
			  				<div class="field">
			  					<div class="field-select">
									<select name="freq" id="">
										<option value="1">Weekly</option>
										<option value="2">Bi-Weekly</option>
										<option value="3">Monthly</option>
									</select>
								</div>
			  				</div>
						</div>
		  				<div class="field" style="margin-top: 20px; padding-bottom: 0px;">
							<label for="title">What is your meeting location?</label>
							<span class="label-desc">Easy to locate spots can help new team members navigate faster.</span>
		  					<input type="text" value="" name="location" placeholder="The tree besides the lake" />
		  				</div>
		  				<div class="field clearfix">
		  					<label for="">Which institution will this meeting take place?</label>
							<span class="label-desc">Choose the institution where you run the meetings</span>
			  				<div class="field">
			  					<div class="field-select">
									<select name="college" id="" style="margin-bottom: 0px;">
										<?php
											$col_sql="SELECT * from colleges";
											$col_qry=mysqli_query($dbconnect, $col_sql);
											$col_res=mysqli_fetch_assoc($col_qry);
											do{
												?>

												<option value="<?php echo $col_res['colID'];?>"><?php echo $col_res['colName']; ?></option>
												<?php

											} while($col_res=mysqli_fetch_assoc($col_qry));
										?>
										<!-- <option value="">Hampshire College</option>
										<option value="">Amherst College</option>
										<option value="">Mount Holyoke College</option>
										<option value="">Smith College</option>
										<option value="">University of Massachusetts, Amherst</option> -->
									</select>
								</div>
			  				</div>
						</div>
		  				<!-- <button name="proj_role" type="submit" value="Save & Launch" class="btn-primary" style="margin-bottom: 0px;">Add Role</button> -->
					</form>
				</div>
			</div>
		</main>
	</div>
</body>
</html>