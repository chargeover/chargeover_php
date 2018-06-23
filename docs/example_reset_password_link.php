<?php

/**
 * Example of sending a reset password link to a user
 *
 *
 */

header('Content-Type: text/plain');

use ChargeOver\ChargeOverAPI;

require_once '../vendor/autoload.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

// Your ChargeOver API credentials
$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = '7sutWFEO2zKVYIGmZMJ3Nij5hfLxDRb8';
$password = '9vCJbmdZKSieVchyrRItFQw8MBN4lOH3';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// The user_id value
$user_id = 375;

// Sent this user a reset password link
$resp = $API->action(\ChargeOver\APIObject::TYPE_USER,
	$user_id,
	'reset_password');				// This is the type of action we want to perform

if ($resp->response)
{
	print('OK, sent that user a reset password link!');
}
else
{
	print('Could not send that user a reset password link!');

	// Debug info
	print($API->lastRequest());
	print("\n\n");
	print($API->lastResponse());
}
