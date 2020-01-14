<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

//Get all customers
$resp = $API->find('note', array( 
	'obj_type:EQUALS:customer', 
	'obj_id:EQUALS:328'
	));


/*
print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
*/

if (!$API->isError($resp))
{
	$notes = $resp->response;

	print_r($notes);
	
}
else
{
	print('Error getting notes' . "\n");
	print_r($API->lastResponse());
}


