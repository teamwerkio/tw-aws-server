<?php
	
	use AWS\S3\Exception\S3Exception;
	use Aws\S3\S3Client;
	require '../vendor/autoload.php';

	function img_uploader($file, $target_dir, $new_name){
		$exploded_name=explode(".", $file['name']);
		$tmp_name=$new_name.'.'.strtolower(end($exploded_name));



		$parsed_ini=parse_ini_file("../../cred.ini", true);

		$s3=S3Client::factory([
		'credentials' => [
			'key' => $parsed_ini["S3_bucket"]["key"],
			'secret' => $parsed_ini["S3_bucket"]["secret"]
		],
		'region' => 'us-east-1',
		'version' => 'latest'
		]);

		try{

			$s3->putObject([
				'Bucket' => $parsed_ini["S3_bucket"]["bucket"],
				'Key' => "img_assets/".$target_dir."/".$tmp_name,
				'SourceFile' => $file['tmp_name']

			]);

		}catch(S3Exception $e){

			die($e->getMessage());
		}
	}

	function json_uploader($tmp_dir, $new_name){


		$parsed_ini=parse_ini_file("../../cred.ini", true);

		$s3=S3Client::factory([
		'credentials' => [
			'key' => $parsed_ini["S3_bucket"]["key"],
			'secret' => $parsed_ini["S3_bucket"]["secret"]
		],
		'region' => 'us-east-1',
		'version' => 'latest'
		]);

		try{

			$s3->putObject([
				'Bucket' => $parsed_ini["S3_bucket"]["bucket"],
				'Key' => "json_fb_data/".$new_name.".json",
				'SourceFile' => $tmp_dir

			]);

		}catch(S3Exception $e){

			die($e->getMessage());
		}
	}

?>