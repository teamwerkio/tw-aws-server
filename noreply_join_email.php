<?php
	use \Mailjet\Resources;
	function leader_noti_f($owner_email, $projName, $o_name_f, $o_name_l, $position, $mem_email, $mem_name_f, $mem_name_l, $pitch){
		include("mjconnect.php");
		$json='{
		    "owner_fn": "'.$o_name_f.'",
		    "owner_ln": "'.$o_name_l.'",
		    "projName": "'.$projName.'",
		    "mem_fn": "'.$mem_name_f.'",
		    "mem_ln": "'.$mem_name_l.'",
		    "pos": "'.$position.'",
		    "mem_pitch": "'.$pitch.'",
		    "mem_email": "'.$mem_email.'"
		  }';
		$body = [
	    'Messages' => [
	        [
	            'From' => [
	                'Email' => "noreply@teamwerk.io",
	                'Name' => "Teamwerk"
	            ],
	            'To' => [
	                [
	                    'Email' => $owner_email,
	                    'Name' => $o_name_f." ".$o_name_l
	                ]
	            ],
                'TemplateID' => 316380,
		        'TemplateLanguage' => true,
		        'Subject' => "You have received a request to join ".$projName,
		        'Variables' => json_decode($json, true)
	        ]
	    ]
		];


		$response = $mj->post(Resources::$Email, ['body' => $body]);
		error_log(print_r($response->getData(), True));
		if($response->success()){
			error_log("sent");
		}


	}

	function leaderEmail_noti($owner_email, $projName, $o_name_f, $o_name_l, $position, $mem_email, $mem_name_f, $mem_name_l){
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
	                    'Email' => $owner_email,
	                    'Name' => $o_name_f." ".$o_name_l
	                ]
	            ],

	            'TemplateID' => 316381,
		        'TemplateLanguage' => true,
		        'Subject' => "Recent requests to join your project",
		        'Variables' => json_decode('{
		    "owner_fn": "'.$o_name_f.'",
		    "owner_ln": "'.$o_name_l.'",
		    "mem_fn": "'.$mem_name_f.'",
		    "mem_ln": "'.$mem_name_l.'",
		    "projName": "'.$projName.'",
		    "position": "'.$position.'",
		    "mem_email": "'.$mem_email.'"
		  }', true)	            
	        ]
	    ]
		];

		$response = $mj->post(Resources::$Email, ['body' => $body]);
		error_log(error_log(print_r($response->getData(), True)));
		if($response->success()){
			error_log("sent");
		}


	}

	function requester_email_f($projName, $mem_email, $mem_name_f, $mem_name_l){
		include("mjconnect.php");
		
		$json='{
		"mem_fn": "'.$mem_name_f.'",
		"mem_ln": "'.$mem_name_l.'",
		"projName": "'.$projName.'"
		}';
		
		$body = [
		'Messages' => [
		  [
		    'From' => [
		      'Email' => "noreply@teamwerk.io",
		      'Name' => "Teamwerk"
		    ],
		    'To' => [
		      [
		        'Email' => $mem_email,
		        'Name' => $mem_name_f." ".$mem_name_l
		      ]
		    ],
		    'TemplateID' => 316397,
		    'TemplateLanguage' => true,
		    'Subject' => "Your request to join ".$projName." has been sent!",
		    'Variables' => json_decode($json, true)
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
