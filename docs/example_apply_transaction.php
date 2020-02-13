<?php

/**
 * Example of applying a transaction / adjusting the way a payment is applied
 */

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// This is the customer/billing package we're updating
$transaction_id = 1;

$data = array(
	'applied_to' => array(
		0 => array(
			'invoice_id' => 1001,
			'applied' => 5,
		),
	),
);

// Adjust what invoices this is applied to
$resp = $API->action('transaction', $transaction_id, 'changeAppliedAmounts', $data);

// Set the payment method 
if (!$API->isError($resp))
{
	print('SUCCESS!');
}
else
{
	print('ERROR: ' . $resp->message);
}