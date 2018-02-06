<?php
	include("dbconnect.php");
	session_start();
	if(isset($_POST['check'])){
		$upID=$_POST['upID'];
		$projID=$_POST['projID'];
		$up_sql="UPDATE proj_updates SET status='1' WHERE upID=".mysqli_real_escape_string($dbconnect, $upID);
		
		$up_qry=mysqli_query($dbconnect, $up_sql);

		$up2_sql="SELECT * FROM proj_updates WHERE (status=0) AND (projID=".$projID.")";
		$up2_qry=mysqli_query($dbconnect, $up2_sql);
		echo mysqli_num_rows($up2_qry);		
	}
	elseif (isset($_POST['del'])) {
		$upID=$_POST['upID'];
		$projID=$_POST['projID'];
		$up_sql="DELETE FROM proj_updates WHERE upID=".mysqli_real_escape_string($dbconnect, $upID);
		$up_qry=mysqli_query($dbconnect, $up_sql);
		
		$up2_sql="SELECT * FROM proj_updates WHERE projID=".$projID;
		$up2_qry=mysqli_query($dbconnect, $up2_sql);

		echo mysqli_num_rows($up2_qry);

	}