<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// The invoice we want to update
$invoice_id = 10009;

// Build up the object
$Invoice = new ChargeOverAPI_Object_Invoice();
$Invoice->setDate('2015-06-08');

$LineItem = new ChargeOverAPI_Object_LineItem();
$LineItem->setItemId(3);
$LineItem->setLineRate(29.95);
$LineItem->setLineQuantity(3);
$LineItem->setDescrip('Add this new line item to the invoice.');

$Invoice->addLineItems($LineItem);

// To keep the existing line item, you have to pass the line_item_id
$LineItem = new ChargeOverAPI_Object_LineItem();
$LineItem->setLineItemId(2575);

$Invoice->addLineItems($LineItem);

$resp = $API->modify($invoice_id, $Invoice);

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

