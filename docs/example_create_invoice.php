<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$Invoice = new ChargeOverAPI_Object_Invoice();
$Invoice->setCustomerId(1);
$Invoice->setDate('2014-01-02');

$LineItem = new ChargeOverAPI_Object_LineItem();
$LineItem->setItemId(4);
$LineItem->setLineRate(29.95);
$LineItem->setLineQuantity(3);
$LineItem->setDescrip('Test of a description goes here.');

$Invoice->addLineItems($LineItem);

$LineItem = clone $LineItem;
$LineItem->setLineQuantity(2);

$Invoice->addLineItems($LineItem);

//print_r($Invoice->__toString());

$resp = $API->create($Invoice);

/*
print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
*/

if (!$API->isError($resp))
{
	$invoice_id = $resp->response->id;
	print('SUCCESS! Invoice # is: ' . $invoice_id);
}
else
{
	print('Error saving invoice via API' . "\n");

	print('Error message was: ' . $resp->code . ': ' . $resp->message . "\n");

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}

