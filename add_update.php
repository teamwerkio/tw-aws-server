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
	<title>Add an update | Teamwerk</title>

    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />
    <link rel="icon" href="images/favicon.png" type="image/x-icon"/>
</head>

<body class="campaign-detail">		

		<main id="main" class="site-main">
			<div style="margin-top: 50px;"></div>
			<div class="campaign-form form-update">
				<div class="container">
					<form id="update_add" name="add_update" action="add_update_submit.php?projID=<?php echo $_GET['projID'];?>" method="post">
<!-- 						<div class="date">
							<label for="">Date *</label>
							<span class="label-desc">Date for the entry</span>
		  					<input type="date" placeholder="" />
		  				</div> -->
						<div class="field" style="margin-top: 20px;">
							<label for="title">Update *</label>
							<span class="label-desc">Example: We got a 100 customers!</span>
		  					<input type="text" value="" name="title" placeholder="Enter upto 35 characters" />
		  				</div>
		  				<div class="field">
							<label for="">Update Details *</label>
							<span class="label-desc">Example: We started with 10 people and then ..... </span>
		  					<textarea name="desc" rows="2" placeholder="Enter upto 350 characters"></textarea>
		  				</div>
		  				<!-- <button name="add_update" type="submit" value="Save & Launch" class="btn-primary" style="margin-bottom: 0px;">Add Update</button> -->
					</form>
				</div>
			</div>
		</main>
	</div>
</body>
</html>