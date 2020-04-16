<?php

/**
 * Example of deleting a customer from ChargeOver 
 */

header('Content-Type: text/plain');

// Require the library 
require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// This is the unique tokenized ID value 
$the_tokenized_id = 1;

// Delete them
$resp = $API->delete(ChargeOverAPI_Object::TYPE_TOKENIZED, $the_tokenized_id);

// Check for errors 
if (!$API->isError($resp))
{
	print('Tokenized info was deleted!');
}
else
{
	print('The tokenized info COULD NOT BE DELETED!');

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}

