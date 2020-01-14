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
$the_ach_id = 1;

// Delete them
$resp = $API->delete(ChargeOverAPI_Object::TYPE_ACH, $the_ach_id);

// Check for errors 
if (!$API->isError($resp))
{
	print('ACH was deleted!');
}
else
{
	print('The ACH COULD NOT BE DELETED!');

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}

