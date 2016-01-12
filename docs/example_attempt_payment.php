<?php

/**
 * Example of creating an invoice, and then paying it using a credit card 
 *
 * 
 */

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/signup/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

// Your ChargeOver API credentials 
$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'fnELaQ2yXJeINDZ6HjVtAwF0mSqdxCzo';
$password = 'ePTGCYz104wILNdcWZMQsV3JEjapqBlm';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// Pay for it 
$resp = $API->action('transaction', 
	null, 
	'pay', 				// This is the type of action we want to perform
	array(
		'customer_id' => 2, 
		'amount' => 50, 
		'applied_to' => array(
			'invoice_id' => 10002
			),
		));

if (!$API->isError($resp))
{
	print_r($resp);
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

