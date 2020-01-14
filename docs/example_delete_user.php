<?php

/**
 * Example of deleting a customer from ChargeOver 
 */

header('Content-Type: text/plain');

// Require the library 
require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// This is the unique user ID value 
$the_user_id = 123348;

// Delete them
$resp = $API->delete(ChargeOverAPI_Object::TYPE_USER, $the_user_id);

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

