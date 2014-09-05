<?php

/**
 * Example of deleting a customer from ChargeOver 
 */

header('Content-Type: text/plain');

// Require the library 
require '../ChargeOverAPI.php';

// This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

// You should substitute your API credentials in here 
$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'JxI2LYptQkVDMbaFST8RNegzrqji9Wmh';
$password = 'k5mSN0rb7KFHl4PBVDpLv2JfoG6qEQiW';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// This is the unique customer ID value 
$the_ach_id = 66;

// Delete them
$resp = $API->delete(ChargeOverAPI_Object::TYPE_CREDITCARD, $the_ach_id);

// Check for errors 
if (!$API->isError($resp))
{
	print('Credit card was deleted!');
}
else
{
	print('The credit card COULD NOT BE DELETED!');

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}

