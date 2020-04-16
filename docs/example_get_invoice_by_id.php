<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

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

