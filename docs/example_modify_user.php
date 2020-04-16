<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$user_id = 350;

$User = new ChargeOverAPI_Object_User(array(
	'name' => 'Ryan Bantz', 
	'email' => 'newemail@newemail.com',
	));

$resp = $API->modify($user_id, $User);

if (!$API->isError($resp))
{
	print('Updated the user!');

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}
else
{
	print('Error updating user via API: ' . $resp->message);

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}

