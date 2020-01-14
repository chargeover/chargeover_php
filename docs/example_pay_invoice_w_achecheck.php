<?php

/**
 * Example of creating an invoice, and then paying it using an ACH/eCheck payment
 *
 * 
 */

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$Invoice = new ChargeOverAPI_Object_Invoice();
$Invoice->setCustomerId(1563);

$LineItem = new ChargeOverAPI_Object_LineItem();
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
	$Ach = new ChargeOverAPI_Object_Ach(array(
		'number' => '1234 1234 1234', 			// This is the bank account number
		'name' => 'Keith Palmer', 				// The name of the person/company on the checking account
		'routing' => '072403004', 				// Routing number for the bank 
		'type' => ChargeOverAPI_Object_Ach::TYPE_CHECKING, 		// Bank account type 
		));

	// Pay for it 
	$resp = $API->action(ChargeOverAPI_Object::TYPE_INVOICE, 
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

