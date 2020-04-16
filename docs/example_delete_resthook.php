<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$the_resthook_id = 3;

// Create the user
$resp = $API->delete(ChargeOverAPI_Object::TYPE_RESTHOOK, $the_resthook_id);

// Check for errors
if (!$API->isError($resp))
{
	print('SUCCESS!');
	print_r($resp);
}
else
{
	print('Error deleting resthook via API');

	print("\n\n");
	print($API->lastRequest() . "\n\n");
	print($API->lastResponse() . "\n\n");
}
