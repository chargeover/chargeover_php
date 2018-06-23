<?php

/**
 * Example of creating an invoice, and then paying it using an ACH/eCheck payment
 *
 *
 */

header('Content-Type: text/plain');

use ChargeOver\ChargeOverAPI;

require_once '../vendor/autoload.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

// Your ChargeOver API credentials
$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = '7sutWFEO2zKVYIGmZMJ3Nij5hfLxDRb8';
$password = '9vCJbmdZKSieVchyrRItFQw8MBN4lOH3';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$Invoice = new \ChargeOver\APIObject_Invoice();
$Invoice->setCustomerId(1563);

$LineItem = new \ChargeOver\APIObject_LineItem();
$LineItem->setItemId(303);
$LineItem->setLineRate(29.95);
$LineItem->setLineQuantity(3);
$LineItem->setDescrip('Test of a description goes here.');

$Invoice->addLineItems($LineItem);

// Create the invoice
$resp = $API->create($Invoice);

if (!$API->isError($resp))
{
	$invoice_id = $resp->response->id;
	print('Created new invoice # ' . $invoice_id . '... now let\'s try to pay for it!' . "\n");

	// Now that we've created the invoice, let's try to immediately pay for it
	//	using an ACH debit/eCheck.

	// Create the credit card object
	$Ach = new \ChargeOver\APIObject_Ach(array(
		'number' => '1234 1234 1234', 			// This is the bank account number
		'name' => 'Keith Palmer', 				// The name of the person/company on the checking account
		'routing' => '072403004', 				// Routing number for the bank
		'type' => \ChargeOver\APIObject_Ach::TYPE_CHECKING, 		// Bank account type
		));

	// Pay for it
	$resp = $API->action(\ChargeOver\APIObject::TYPE_INVOICE,
		$invoice_id,
		'pay', 				// This is the type of action we want to perform
		$Ach);

	if ($resp->response)
	{
		print('OK, paid for that invoice using an ACH account!');
	}
	else
	{
		print('Could not pay invoice [' . $resp->code . ': ' . $resp->message .']');
	}
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

