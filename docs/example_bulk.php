<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$Bulk = new ChargeOverAPI_Bulk();

// Get a list of customers
//$Bulk->bulk('GET', '/api/v3/customer');

// Get a specific customer
$Bulk->bulk('GET', '/api/v3/customer/2');

// Add a customer
$Bulk->bulk('POST', '/api/v3/customer', array(
	'company' => 'My new bulk customer ' . mt_rand(0, 1000), 
	));

$Bulk->bulk('PUT', '/api/v3/customer', array());

$Bulk->bulk('POST', '/api/v3/customer', array(
	'company' => 'Test Company ' . mt_rand(0, 1000), 
	'external_key' => 'abcd1234', 
	));

// Create the user
$resp = $API->bulk($Bulk);

// Check for errors
if (!$API->isError($resp))
{
	print_r($resp->response->_bulk);
}
else
{
	print('Error!');

	print($API->lastRequest());
	print("\n\n");
	print($API->lastResponse());
	
}

/*
print("\n\n");
print($API->lastRequest());
print("\n\n");
print($API->lastResponse());
*/