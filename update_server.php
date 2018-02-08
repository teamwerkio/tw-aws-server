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
	elseif (isset($_POST['clicked'])) {
		$usrID=$_POST['usrID'];
		$projID=$_POST['projID'];

		$sql1="SELECT * FROM users where usrID=".$usrID;
		$qry1=mysqli_query($dbconnect, $sql1);
		$res1=mysqli_fetch_assoc($qry1);

		$json=json_decode($res1['clicked'], true);
		if(!in_array($projID, $json["clicked"])){
			array_push($json["clicked"], $projID);

			$json_str=json_encode($json);
			$sql_up="UPDATE users SET clicked='".mysqli_escape_string($dbconnect,$json_str)."' WHERE usrID=".mysqli_escape_string($dbconnect,$usrID);
			$qry_up=mysqli_query($dbconnect, $sql_up);
		}
	}
?>

