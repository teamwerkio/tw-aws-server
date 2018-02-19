<?php
	include("dbconnect.php");
	session_start();
	
	if(!isset($_SESSION['usr'])){
		header("Location:usr.php");
	}
	if(!isset($_GET['edit'])){
			header("Location:project.php?projID=".$_GET['projID']);
	}
	else{
		$up_sql="SELECT * FROM proj_updates WHERE upID=".$_GET['upID'];
		$up_qry=mysqli_query($dbconnect, $up_sql);
		$up_res=mysqli_fetch_assoc($up_qry);
		
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit timeline | Teamwerk</title>

    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />
    <link rel="icon" href="../images/favicon.png" type="image/x-icon"/>
</head>

<body class="campaign-detail">		

		<main id="main" class="site-main">
			<div style="margin-top: 50px;"></div>
			<div class="campaign-form form-update">
				<div class="container">
					<form id="update_edited" name="edit_updated" action="timeline_update_submit.php?upID=<?php echo $_GET['upID'];?>&projID=<?php echo $_GET['projID'];?>" method="post" enctype="multipart/form-data">

						<div class="field" style="margin-top: 20px;">
							<label for="title">Update *</label>
							<span class="label-desc">Example: We got a 100 customers!</span>
		  					<input type="text" value="<?php echo $up_res['title'];?>" name="title" placeholder="Enter upto 35 characters" />
		  				</div>
		  				<div class="field">
							<label for="">Update Details *</label>
							<span class="label-desc">Example: We started with 10 people and then ..... </span>
		  					<textarea name="desc" rows="2" placeholder="Enter upto 350 characters"><?php echo $up_res['details'];?></textarea>
		  				</div>

					</form>
				</div>
			</div>
		</main>
</body>
</html>