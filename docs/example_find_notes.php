<?php

use ChargeOver\ChargeOverAPI;

header('Content-Type: text/plain');

require_once '../vendor/autoload.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = '7sutWFEO2zKVYIGmZMJ3Nij5hfLxDRb8';
$password = '9vCJbmdZKSieVchyrRItFQw8MBN4lOH3';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

//Get all customers
$resp = $API->find('note', array(
	'obj_type:EQUALS:customer',
	'obj_id:EQUALS:8'
	));


/*
print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
*/

if (!$API->isError($resp))
{
	$notes = $resp->response;

	print_r($notes);

}
else
{
	print('Error getting notes' . "\n");
	print_r($API->lastResponse());
}


