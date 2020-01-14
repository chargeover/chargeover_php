<?php

/**
 * Example of deleting a customer from ChargeOver 
 */

header('Content-Type: text/plain');

// Require the library 
require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// This is the unique customer ID value 
$the_customer_id = 31;

// Delete them
$resp = $API->delete(ChargeOverAPI_Object::TYPE_CUSTOMER, $the_customer_id);

// Check for errors 
if (!$API->isError($resp))
{
	print('Customer was deleted!');
}
else
{
	print('The customer COULD NOT BE DELETED!');

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}

