<?php

/**
 * Example of refunding a previously made payment
 *
 * 
 */

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

// Your ChargeOver API credentials 
$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = '1EkcsIZRUJwdWmyT6lzqa4Y0pXvgNKCB';
$password = 'IZah9p134R7OLtHl26BCmFXWUjVQxsNM';

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

