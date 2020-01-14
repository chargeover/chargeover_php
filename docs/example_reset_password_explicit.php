<?php

/**
 * Example of explicitly setting a user's password to some string 
 *
 * 
 */

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// The user_id value
$user_id = 375; 	

// The default behavior will send the user an email with their password
// 	If you don't want to send the e-mail, you can suppress the email like this:
$API->flag(ChargeOverAPI::FLAG_EMAILS, false);

// Reset the password (and send the user the new password if not suppresssed)
$resp = $API->action(ChargeOverAPI_Object::TYPE_USER, 
	$user_id, 
	'reset_password', 		// Type of action to perform
	array(
		'password' => 'here is the password', 
		));

if ($resp->response)
{
	print('OK, set that user\'s password!');
}
else
{
	print('Could not set password.');

	// Debug info
	print($API->lastRequest());
	print("\n\n");
	print($API->lastResponse());
}
