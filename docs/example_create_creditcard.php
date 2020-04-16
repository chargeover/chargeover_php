<?php

header('Content-Type: text/plain');

require('../ChargeOverAPI.php');
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$customer_id = 1;

$CreditCard = new ChargeOverAPI_Object_CreditCard(array(
	'customer_id' => $customer_id, // Must be the customer ID of an existing customer in ChargeOver
	//'customer_external_key' => 'abcd12345', 

	'number' => '4111 1111 1111 1111', 
	'expdate_year' => '2016', 
	'expdate_month' => '8', 
	'name' => 'John Doe', 
	));

$resp = $API->create($CreditCard);

if (!$API->isError($resp))
{
	$creditcard_id = $resp->response->id;
	
	print('SUCCESS! Stored credit card as creditcard_id #: ' . $creditcard_id);
}
else
{
	print('Error saving credit card via API!');

	print($API->lastResponse());
}
