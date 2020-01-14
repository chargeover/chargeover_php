<?php

header('Content-Type: text/plain');

require('../ChargeOverAPI.php');
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$customer_id = 1;

$Tokenized = new ChargeOverAPI_Object_Tokenized(array(
	'customer_id' => $customer_id, // Must be the customer ID of an existing customer in ChargeOver

	'token' => 'abcd1234', 
	'type' => 'customer'
	));

$resp = $API->create($Tokenized);

if (!$API->isError($resp))
{
	$tokenized_id = $resp->response->id;
	
	print('SUCCESS! Stored tokenized payment method as tokenized_id #: ' . $tokenized_id);
}
else
{
	print('Error saving tokenized info via API!');

	print($API->lastResponse());
}

