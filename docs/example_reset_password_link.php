<?php

/**
 * Example of sending a reset password link to a user
 *
 * 
 */

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// The user_id value
$user_id = 375; 	

// Sent this user a reset password link 
$resp = $API->action(ChargeOverAPI_Object::TYPE_USER, 
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
