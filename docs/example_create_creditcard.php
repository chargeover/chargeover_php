<?php

header('Content-Type: text/plain');

require('../ChargeOverAPI.php');

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = '7sutWFEO2zKVYIGmZMJ3Nij5hfLxDRb8';
$password = '9vCJbmdZKSieVchyrRItFQw8MBN4lOH3';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$customer_id = 1560;

$CreditCard = new ChargeOverAPI_Object_CreditCard(array(
	'customer_id' => $customer_id, // Must be the customer ID of an existing customer in ChargeOver

	'number' => '4111 1111 1111 1111', 
	'expdate_year' => '2016', 
	'expdate_month' => '11', 
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

