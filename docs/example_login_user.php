<?php

/**
 * Example of automatically logging a user into the customer portal
 *
 * 
 */

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

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
