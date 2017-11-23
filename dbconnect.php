<?php
	

	$parsed_ini=parse_ini_file("../../cred.ini", true);
	
	$host=$parsed_ini["DB"]["host"];
	$uname=$parsed_ini["DB"]["uname"];
	$pass=$parsed_ini["DB"]["pass"];
	$db=$parsed_ini["DB"]["db"];
	$dbconnect = mysqli_connect($host, $uname, $pass, $db);
	

	if(mysqli_connect_errno()){
		echo "Connection failed: ".mysqli_connect_error();
		exit;
	}


?>