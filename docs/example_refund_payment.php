<?php

/**
 * Example of refunding a previously made payment
 *
 * 
 */

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

// The payment transaction_id value
$payment_transaction_id = 206;

// By default, the full transaction amount will be refunde
$data = null;
//$data = array( 'amount' => 9.49 );   // Refund a custom amount

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// Do the refund
$resp = $API->action('transaction', $payment_transaction_id, 'refund', $data);

if (!$API->isError($resp))
{
	print_r($resp);
}
else
{
	print('Error message was: ' . $resp->code . ': ' . $resp->message . "\n");

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}

