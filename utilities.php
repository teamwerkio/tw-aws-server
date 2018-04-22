<?php
	function timedifference_d($time){
		date_default_timezone_set('US/Eastern');
		$currtime=new DateTime();
		$time=new DateTime($time);
		$interval=$currtime->diff($time);
		return $interval->format('%a');
	}

	
	function returnCat($table, $col, $idx, $dbconnect, $idtype){
		$cat_sql="SELECT ".$col." FROM ".$table." WHERE ".$idtype."='".$idx."'";
		$cat_qry=mysqli_query($dbconnect, $cat_sql);
		$cat_res=mysqli_fetch_assoc($cat_qry);
		return $cat_res[$col];
	}

	function searchTerm($term){
		$reg="/[\]\[.!?,;:'%\/\\\\ ]/";
		$res=preg_replace($reg, "%", $term);
		if(substr($res, -1)==="%"){
			$res=substr($res, 0, -1);
		}
		return strtolower($res);
	}
		

?>