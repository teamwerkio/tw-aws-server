<?php
require '../vendor/autoload.php';
use \Mailjet\Resources;



$parsed_ini=parse_ini_file("../../mj.ini", true);
$apikey = $parsed_ini["MJ"]["apikey"];
$apisecret = $parsed_ini["MJ"]["secret"];


$mj = new \Mailjet\Client($apikey, $apisecret, true,['version' => 'v3.1']);


?>