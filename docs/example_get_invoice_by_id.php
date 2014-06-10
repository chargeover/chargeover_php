<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'https://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = '7sutWFEO2zKVYIGmZMJ3Nij5hfLxDRb8';
$password = '9vCJbmdZKSieVchyrRItFQw8MBN4lOH3';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

//Find a customer by the ChargeOver customer ID
$resp = $API->findById(ChargeOverAPI_Object::TYPE_INVOICE, 2720);

if (!$API->isError($resp))
{
	$Invoice = $resp->response;
	print_r($Invoice);

	//print_r($Invoice->getLineItems());
	//print_r($Invoice->getLineItems(1));
	//print($Invoice->getCustomerId());
}
else
{
	print('There was an error looking up the invoice!' . "\n");
}

