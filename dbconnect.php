<?php
	$parsed_ini=parse_ini_file("cred.ini");
	
	$host=$parsed_ini["host"];
	$uname=$parsed_ini["uname"];
	$pass=$parsed_ini["pass"];
	$db=$parsed_ini["db"];
	$dbconnect = mysqli_connect($host, $uname, $pass, $db);
	

	if(mysqli_connect_errno()){
		echo "Connection failed: ".mysqli_connect_error();
		exit;
	}
?>