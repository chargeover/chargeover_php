<?php

/**
 * Example of creating an invoice, and then paying it using a credit card
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
$username = 'K7hECS2yl1pXZBPfHibv0dwgOcVYtJIx';
$password = 'gWHJsmrzwXLDPReNu8fahj3cVABF0yI1';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// Pay for it
$resp = $API->action('transaction',
	null,
	'pay', 				// This is the type of action we want to perform
	array(
		'customer_id' => 295,
		'amount' => 2.95,
		'paymethods' => array(
			array(
				'creditcard_id' => 127,
				),
			),
		));

if (!$API->isError($resp))
{
	print_r($resp);
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

