<?php
	include("dbconnect.php");
	session_start();
	if(isset($_POST['up'])){
		$sub_id=$_POST['usr_id'];
		$proj_id=$_POST['proj_id'];
		
		$usr_sql="SELECT * from users WHERE usrID=".$sub_id;
		$usr_qry=mysqli_query($dbconnect, $usr_sql);
		$usr_res=mysqli_fetch_assoc($usr_qry);

		$usr_json=json_decode($usr_res['subs'], true);
		array_push($usr_json["subs"], $proj_id);
		$new_usr_json=json_encode($usr_json);
		

		$usr_up_sql="UPDATE users SET subs='".mysqli_real_escape_string($dbconnect, $new_usr_json)."' WHERE usrID=".mysqli_real_escape_string($dbconnect, $sub_id);
		$usr_up_qry=mysqli_query($dbconnect, $usr_up_sql);

		$proj_sql="SELECT * from project WHERE projID=".$proj_id;
		$proj_qry=mysqli_query($dbconnect, $proj_sql);
		$proj_res=mysqli_fetch_assoc($proj_qry);

		$proj_json=json_decode($proj_res['subs'], true);
		array_push($proj_json["subs"], $sub_id);
		$new_proj_json=json_encode($proj_json);

		$proj_up_sql="UPDATE project SET subs='".mysqli_real_escape_string($dbconnect, $new_proj_json)."' WHERE projID=".mysqli_real_escape_string($dbconnect, $proj_id);
		$proj_up_qry=mysqli_query($dbconnect, $proj_up_sql);
	}
	elseif (isset($_POST['down'])) {
		$sub_id=$_POST['usr_id'];
		$proj_id=$_POST['proj_id'];
		
		$usr_sql="SELECT * from users WHERE usrID=".$sub_id;
		$usr_qry=mysqli_query($dbconnect, $usr_sql);
		$usr_res=mysqli_fetch_assoc($usr_qry);

		$usr_json=json_decode($usr_res['subs'], true);
		$usr_json_arr=array_diff($usr_json["subs"], array($proj_id));
		$new_json=new \stdClass();
		$new_json->subs=$usr_json_arr;
		$new_usr_json=json_encode($new_json);

		$usr_up_sql="UPDATE users SET subs='".mysqli_real_escape_string($dbconnect, $new_usr_json)."' WHERE usrID=".mysqli_real_escape_string($dbconnect, $sub_id);
		$usr_up_qry=mysqli_query($dbconnect, $usr_up_sql);


		$proj_sql="SELECT * from project WHERE projID=".$proj_id;
		$proj_qry=mysqli_query($dbconnect, $proj_sql);
		$proj_res=mysqli_fetch_assoc($proj_qry);

		$proj_json=json_decode($proj_res['subs'], true);
		$proj_json_arr=array_diff($proj_json["subs"], array($sub_id));
		$new_json_proj=new \stdClass();
		$new_json_proj->subs=$proj_json_arr;

		$new_proj_json=json_encode($new_json_proj);

		$proj_up_sql="UPDATE project SET subs='".mysqli_real_escape_string($dbconnect, $new_proj_json)."' WHERE projID=".mysqli_real_escape_string($dbconnect, $proj_id);
		$proj_up_qry=mysqli_query($dbconnect, $proj_up_sql);
	}
	elseif (isset($_GET['update'])) {
		$sub_id=$_GET['usr_id'];
		$proj_id=$_GET['proj_id'];

		$proj_sql="SELECT * from project WHERE projID=".$proj_id;
		$proj_qry=mysqli_query($dbconnect, $proj_sql);
		$proj_res=mysqli_fetch_assoc($proj_qry);
		
		$proj_json=json_decode($proj_res['subs'], true);
		$json = new \stdClass();
		$json->count=count($proj_json["subs"]);
		$json->present=in_array($sub_id, $proj_json["subs"]);
		
		$data=json_encode($json);
		echo $data;
	}
	elseif (isset($_POST['check_role'])) {
		$roleID=$_POST['roleID'];
		$projID=$_POST['projID'];
		$role_sql="UPDATE team_roles SET status='1' WHERE roleID=".mysqli_real_escape_string($dbconnect, $roleID);
		
		$role_qry=mysqli_query($dbconnect, $role_sql);

		$role2_sql="SELECT * FROM team_roles WHERE (status=0) AND (projID=".$projID.")";
		$role2_qry=mysqli_query($dbconnect, $role2_sql);
		echo mysqli_num_rows($role2_qry);		
	}
	elseif (isset($_POST['del_role'])) {
		$roleID=$_POST['roleID'];
		$projID=$_POST['projID'];
		$role_sql="DELETE FROM team_roles WHERE roleID=".mysqli_real_escape_string($dbconnect, $roleID);
		$role_qry=mysqli_query($dbconnect, $role_sql);
		
		$role2_sql="SELECT * FROM team_roles WHERE projID=".$projID;
		$role2_qry=mysqli_query($dbconnect, $role2_sql);

		echo mysqli_num_rows($role2_qry);

	}

?>