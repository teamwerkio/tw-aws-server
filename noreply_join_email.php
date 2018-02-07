<?php
	include("mjconnect.php");
	
	use \Mailjet\Resources;
	$body = [
    'Messages' => [
        [
            'From' => [
                'Email' => "noreply@teamwerk.io",
                'Name' => "Teamwerk"
            ],
            'To' => [
                [
                    'Email' => "tde15@hampshire.edu",
                    'Name' => "passenger 1"
                ]
            ],
            'Subject' => "Your email flight plan!",
            'TextPart' => "Dear passenger 1, welcome to Mailjet! May the delivery force be with you!",
            'HTMLPart' => "<h3>Dear passenger 1, welcome to Mailjet!</h3><br />May the delivery force be with you!"
        ]
    ]
	];
	$response = $mj->post(Resources::$Email, ['body' => $body]);
	$response->success() && error_log(print_r($response->getData(), true));
	

?>