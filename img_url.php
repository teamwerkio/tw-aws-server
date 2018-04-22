<?php
	
	use AWS\S3\Exception\S3Exception;
	use Aws\S3\S3Client;
	require '../vendor/autoload.php';

	function getProfURL($name){

		$parsed_ini=parse_ini_file("../../cred.ini", true);

		$s3=S3Client::factory([
		'credentials' => [
			'key' => $parsed_ini["S3_bucket"]["key"],
			'secret' => $parsed_ini["S3_bucket"]["secret"]
		],
		'region' => 'us-east-1',
		'version' => 'latest'
		]);

		$images=$s3->getIterator('ListObjects',array(
			'Bucket' => $parsed_ini["S3_bucket"]["bucket"],
			'Prefix' => "img_assets/profilepic/",
			'Delimiter' => "/"
		));
		
		if(substr( $name, 0, 2 ) === "av" && strlen($name)<=4){

			return "../images/avatars/".$name.".jpg";

		}
		else{
			
			
			$url="";
			foreach ($images as $image) {
				$image_path=$image["Key"];
				$exp_image_path=explode("/", $image_path);
				$img_fn=end($exp_image_path);
				$exp_img_fn=explode(".", $img_fn);

				
				
				if(strcmp($name, $exp_img_fn[0])==0){

					$url=$s3->getObjectURL($parsed_ini["S3_bucket"]["bucket"], $image_path);
					break;
				}
				
				
			}
			return $url;
		}

	}

	function getimgURL($name, $dir){

		$parsed_ini=parse_ini_file("../../cred.ini", true);

		$s3=S3Client::factory([
		'credentials' => [
			'key' => $parsed_ini["S3_bucket"]["key"],
			'secret' => $parsed_ini["S3_bucket"]["secret"]
		],
		'region' => 'us-east-1',
		'version' => 'latest'
		]);

		$images=$s3->getIterator('ListObjects',array(
			'Bucket' => $parsed_ini["S3_bucket"]["bucket"],
			'Prefix' => "img_assets/".$dir."/",
			'Delimiter' => "/"
		));
		
		if(strcmp($name, "")==0 && strcmp($dir, "profilepic")==0){
			return "../images/placeholder/place_profilepic.png";

		}
		elseif (strcmp($name, "")==0 && strcmp($dir, "banner_big")==0) {
			return "../images/placeholder/570x350.png";
		}
		elseif (strcmp($name, "")==0 && strcmp($dir, "banner_small")==0) {
			return "../images/placeholder/370x240.png";
		}
		elseif (strcmp($name, "")==0 && strcmp($dir, "proj_icon")==0) {
			return "../images/placeholder/150x150.png";
		}
		else{
			$url="";
			foreach ($images as $image) {
				$image_path=$image["Key"];
				$exp_image_path=explode("/", $image_path);
				$img_fn=end($exp_image_path);
				$exp_img_fn=explode(".", $img_fn);

				
				
				if(strcmp($name, $exp_img_fn[0])==0){

					$url=$s3->getObjectURL($parsed_ini["S3_bucket"]["bucket"], $image_path);
					break;
				}
				
				
			}
			return $url;
		}

	}

	function smallbanChecker($small,$big){
		if($small===""){
			return getimgURL($big, 'banner_big');
		}
		else{
			return getimgURL($small, 'banner_small');
		}
	}
	if(isset($_POST['profilepic'])){
		$profilepic_url=array_map("getProfURL", $_POST['profilepic']);
		$ban_url=array_map("smallbanChecker", $_POST['smallban'], $_POST['bigban']);
		$json=array("profilepic"=>$profilepic_url, "banner"=>$ban_url);
		echo json_encode($json);

	}
	// if(isset($_GET['jsimg'])){
	// 	if(isset($_GET['imagetype'])=="profilepic"){
	// 		error_log(getProfURL($_GET['jsimg']));
	// 		echo getProfURL($_GET['jsimg']);
	// 	}
	// 	else{
	// 		error_log(getimgURL($_GET['jsimg'], $_GET['imagetype']));
	// 		echo getimgURL($_GET['jsimg'], $_GET['imagetype']);
	// 	}
	// }
?>