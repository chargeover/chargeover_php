<?php

header('Content-Type: text/plain');

use ChargeOver\APIObject\User;
use ChargeOver\ChargeOverAPI;

require_once '../vendor/autoload.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'sLmVGFljcKhtg7rBkAOoNaE9SwWzRYUq';
$password = '3TI5VjyNGlwYHeBuxfcq7tbKh9PS8iAW';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$user_id = 350;

$User = new User(array(
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

