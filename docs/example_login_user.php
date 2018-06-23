<?php

/**
 * Example of automatically logging a user into the customer portal
 *
 *
 */

header('Content-Type: text/plain');

use ChargeOver\ChargeOverAPI;

require_once '../vendor/autoload.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'V1tufg9vklUywH0DqrFs26bjCTm7A8KE';
$password = 'PBRIh8mqzErT2ikpud3VtLwX6W1Ko7JN';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// This is the user/contact you want to log in
$user_id = 389;

$resp = $API->action('user', $user_id, 'login');

if (!$API->isError($resp))
{
	// Forward the user to the one-time login token
	header('Location: ' . $resp->response);
	exit;

	/*
	print($API->lastRequest());
	print("\n\n\n");
	print($API->lastResponse());
	*/
}
else
{
	print('ERROR: ' . $resp->message);
}
