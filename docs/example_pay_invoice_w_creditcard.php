<?php

/**
 * Example of creating an invoice, and then paying it using a credit card
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
$username = '1YExkQoscPr0eHzVbKvMASyLpmC427BW';
$password = 'fhKyga18s3D42lIbB6vRc0TdFOzrYUkL';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$Invoice = new \ChargeOver\APIObject_Invoice();
$Invoice->setCustomerId(23);

$LineItem = new \ChargeOver\APIObject_LineItem();
$LineItem->setItemId(1);
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
	//	using a credit card.

	// Create the credit card object
	$CreditCard = new \ChargeOver\APIObject_CreditCard(array(

		//'number' => '4111 1111 1111 1111',
		'number' => '4116196783374209',    // This one causes decline messages

		'expdate_year' => '2015',
		'expdate_month' => '12',
		'name' => 'Keith Palmer',
		));

	// Pay for it
	$resp = $API->action(\ChargeOver\APIObject::TYPE_INVOICE,
		$invoice_id,
		'pay', 				// This is the type of action we want to perform
		$CreditCard);

	if ($resp->response)
	{
		print('OK, paid for that invoice using a credit card!');
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

