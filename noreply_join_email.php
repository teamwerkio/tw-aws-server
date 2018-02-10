<?php
	use \Mailjet\Resources;
	function userEmail($recipient, $name, $teamEmail, $leaderName){
		include("mjconnect.php");
	
		
		$body = [
	    'Messages' => [
	        [
	            'From' => [
	                'Email' => "noreply@teamwerk.io",
	                'Name' => "Teamwerk"
	            ],
	            'To' => [
	                [
	                    'Email' => $recipient,
	                    'Name' => $name
	                ]
	            ],
	            'Subject' => "Your request to join the team has been sent",
	            'TextPart' => "Dear ".$name." you can contact ".$leaderName." using the email: ".$teamEmail
	        ]
	    ]
		];

		$response = $mj->post(Resources::$Email, ['body' => $body]);
		error_log(error_log(print_r($response->getData(), True)));
		if($response->success()){
			error_log("sent");
		}


	}

	function leaderEmail($recipient, $name, $reqEmail, $requester){
		include("mjconnect.php");
	
		
		$body = [
	    'Messages' => [
	        [
	            'From' => [
	                'Email' => "noreply@teamwerk.io",
	                'Name' => "Teamwerk"
	            ],
	            'To' => [
	                [
	                    'Email' => $recipient,
	                    'Name' => $name
	                ]
	            ],
	            'Subject' => "You have a request to join your team",
	            'TextPart' => "Dear ".$name." , ".$requester." wants to join your team, who can be reached using the email: ".$reqEmail
	        ]
	    ]
		];

		$response = $mj->post(Resources::$Email, ['body' => $body]);
		error_log(error_log(print_r($response->getData(), True)));
		if($response->success()){
			error_log("sent");
		}


	}

?>