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
$username = '1EkcsIZRUJwdWmyT6lzqa4Y0pXvgNKCB';
$password = 'IZah9p134R7OLtHl26BCmFXWUjVQxsNM';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// Invoice to attempt payment for
$invoice_id = 13085;

// Pay for it
$resp = $API->action(\ChargeOver\APIObject::TYPE_INVOICE,
	$invoice_id,
	'pay', 				// This is the type of action we want to perform
	$CreditCard);

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

