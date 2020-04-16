<?php

/**
 * Example of taking a payment, and then if it suceeds creating the invoice
 *
 *
 */

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$customer_id = 324;
$creditcard_id = 145;
$item_id = 1;

// Pay for it
$resp = $API->action('transaction',
	null,
	'pay', 				// This is the type of action we want to perform
	array(
		'customer_id' => $customer_id,
		'amount' => 100,
		'paymethods' => array(
			array(
				'creditcard_id' => $creditcard_id,
				),
			),
		));

if (!$API->isError($resp))
{
	print('Payment was successful, now create an invoice and apply the payment to it!' . "\n");

	$Invoice = new ChargeOverAPI_Object_Invoice();
	$Invoice->setCustomerId($customer_id);

	$LineItem = new ChargeOverAPI_Object_LineItem();
	$LineItem->setItemId($item_id);
	$LineItem->setLineRate(50);
	$Invoice->addLineItems($LineItem);

	$resp2 = $API->create($Invoice);

	if (!$API->isError($resp2))
	{
		Print('Invoice is ' . $resp2->response->id . "\n");

		// Now apply the previous payment to the invoice
		print('Applying payment...' . "\n");

		$API->action('invoice', $resp2->response->id, 'pay', array(
			'use_customer_balance' => true
			));
	}
	else
	{
		print('Error: ' . $API->lastError() . "\n");
	}
}
else
{
	print('Error while attempting payment via API' . "\n");

	print('Error message was: ' . $resp->code . ': ' . $resp->message . "\n");

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}

