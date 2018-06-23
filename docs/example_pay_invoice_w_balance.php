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

$url = 'http://haproxy-dev.chargeover.com/signup/api/v3';

// Your ChargeOver API credentials
$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'aPEDf5ehpOtJjix2lnFc7KrkqVmgHouw';
$password = 'hrUvPdo21QG0tSLXg4u69ZfIkMa5pinY';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// Invoice to pay
$invoice_id = 10054;

// Pay this invoice, BUT only use the customer's available account balance to pay it
//  (e.g. don't charge a credit card, just try to use their available open balance
//  from previous over-payments/credits)
$resp = $API->action('invoice', $invoice_id, 'pay', array(
	'use_customer_balance' => true,
	));

if (!$API->isError($resp))
{
	// Did anything get applied to it?
	if ($resp->response)
	{
		print('Customer balance was applied to this invoice.');
	}
	else
	{
		print('There was no customer balance to apply.');
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

