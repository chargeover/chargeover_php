<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// Find invoices belonging to a customer
$resp = $API->find(ChargeOverAPI_Object::TYPE_INVOICE, array( 'customer_id:EQUALS:68' ), array('invoice_id:DESC'));

if (!$API->isError($resp))
{
	$invoices = $resp->response;

	// Loop through the found invoices and print them out
	foreach ($invoices as $Invoice)
	{
		print_r($Invoice);
	}


}
else
{
	print('There was an error looking up the invoice!' . "\n");

	print('Error: ' . $API->lastError());
	print('Request: ' . $API->lastRequest());
	print('Response: ' . $API->lastResponse());
	print('Info: ' . print_r($API->lastInfo(), true));
}
