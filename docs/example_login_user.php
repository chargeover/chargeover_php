<?php

/**
 * Example of automatically logging a user into the customer portal
 *
 * 
 */

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'IicdJ2vMUOVlW06Cpwo8xALHS71ZFnKs';
$password = 'zOQ7LDR5lfueEYaZynSUwAKBxIv98V4j';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// This is the user/contact you want to log in 
$user_id = 352;

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
