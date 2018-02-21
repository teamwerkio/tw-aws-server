<?php
	include("dbconnect.php");
	include("utilities.php");
	include("img_url.php");
	session_start();
	if(isset($_POST['rej'])){
		$reqID=$_POST['reqID'];

		$prel_sql="SELECT * FROM join_req WHERE reqID=".mysqli_real_escape_string($dbconnect,$reqID);
		$prel_qry=mysqli_query($dbconnect, $prel_sql);
		$prel_res=mysqli_fetch_assoc($prel_qry);

		$roleID=$prel_res['roleID'];

		$del_sql="DELETE FROM join_req WHERE reqID=".mysqli_real_escape_string($dbconnect,$reqID);
		
		$del_qry=mysqli_query($dbconnect, $del_sql);

		$req_sql="SELECT * FROM join_req WHERE roleID=".mysqli_real_escape_string($dbconnect,$roleID);
		$req_qry=mysqli_query($dbconnect, $req_sql);

		echo mysqli_num_rows($req_qry);
	}
	elseif(isset($_POST['acc'])){
		$reqID=$_POST['reqID'];

		$prel_sql="SELECT * FROM join_req WHERE reqID=".mysqli_real_escape_string($dbconnect,$reqID);
		$prel_qry=mysqli_query($dbconnect, $prel_sql);
		$prel_res=mysqli_fetch_assoc($prel_qry);

		$projID=$prel_res['projID'];
		$roleID=$prel_res['roleID'];
		$usrID=$prel_res['usrID'];
		$pos=returnCat('team_roles', 'title', $roleID, $dbconnect, 'roleID');

		$mem_arr=array('id' =>$usrID, 'pos'=>$pos);

		$del_sql="DELETE FROM join_req WHERE reqID=".mysqli_real_escape_string($dbconnect,$reqID);
		
		$del_qry=mysqli_query($dbconnect, $del_sql);


		$proj_sql="SELECT * FROM project WHERE projID=".mysqli_real_escape_string($dbconnect,$projID);
		$proj_qry=mysqli_query($dbconnect, $proj_sql);
		$proj_res=mysqli_fetch_assoc($proj_qry);
		$team_json=json_decode($proj_res['team'],true);
		
		array_push($team_json["member"], $mem_arr);
		$up_arr=json_encode($team_json);
		

		$up_sql="UPDATE project SET team='".$up_arr."' WHERE projID=".mysqli_real_escape_string($dbconnect,$projID);
		$up_qry=mysqli_query($dbconnect,$up_sql);

		$req_sql="SELECT * FROM join_req WHERE roleID=".mysqli_real_escape_string($dbconnect,$roleID);
		$req_qry=mysqli_query($dbconnect, $req_sql);

		$htmlStr='<img src="'.getProfURL(returnCat('users', 'profilepic', $usrID, $dbconnect, 'usrID')).'">';
		$json_arr=array('html' =>$htmlStr , 'rows'=>mysqli_num_rows($req_qry));
		echo json_encode($json_arr);
	}
?>