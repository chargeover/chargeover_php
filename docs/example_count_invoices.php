<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// Find how many invoices a particular customer has
$resp = $API->count(ChargeOverAPI_Object::TYPE_INVOICE,
	array(
		'customer_id:EQUALS:6319'
	));

if (!$API->isError($resp))
{
	print('This customer has ' . $resp->response . ' invoices.' . "\n");
}
else
{
	print('There was an error looking up the invoice!' . "\n");

	print('Error: ' . $API->lastError());
	print('Request: ' . $API->lastRequest());
	print('Response: ' . $API->lastResponse());
	print('Info: ' . print_r($API->lastInfo(), true));
}

// Find how many UNPAID invoices the customer has
$resp = $API->count(ChargeOverAPI_Object::TYPE_INVOICE,
	array(
		'customer_id:EQUALS:6319',
		'invoice_status_state:EQUALS:o'
	));

if (!$API->isError($resp))
{
	print('This customer has ' . $resp->response . ' UNPAID invoices.' . "\n");
}
else
{
	print('There was an error looking up the invoice!' . "\n");

	print('Error: ' . $API->lastError());
	print('Request: ' . $API->lastRequest());
	print('Response: ' . $API->lastResponse());
	print('Info: ' . print_r($API->lastInfo(), true));
}
