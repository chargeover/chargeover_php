<?php

/**
 * Example of deleting a customer from ChargeOver 
 */

header('Content-Type: text/plain');

// Require the library 
require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// This is the unique creditcard ID value 
$the_creditcard_id = 43;

// Delete them
$resp = $API->delete(ChargeOverAPI_Object::TYPE_CREDITCARD, $the_creditcard_id);

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