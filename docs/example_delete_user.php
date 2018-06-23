<?php

/**
 * Example of deleting a customer from ChargeOver
 */

header('Content-Type: text/plain');

// Require the library
use ChargeOver\ChargeOverAPI;

require_once '../vendor/autoload.php';

// This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

// You should substitute your API credentials in here
$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'sLmVGFljcKhtg7rBkAOoNaE9SwWzRYUq';
$password = '3TI5VjyNGlwYHeBuxfcq7tbKh9PS8iAW';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// This is the unique user ID value
$the_user_id = 123348;

// Delete them
$resp = $API->delete(\ChargeOver\APIObject::TYPE_USER, $the_user_id);

// Check for errors
if (!$API->isError($resp))
{
	print('User was deleted!');
}
else
{
	print('The user COULD NOT BE DELETED!');

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}

