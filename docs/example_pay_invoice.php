<?php

/**
 * Example of creating an invoice, and then paying it using a credit card 
 *
 * 
 */

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// Invoice to attempt payment for 
$invoice_id = 13085;

// Pay for it 
$resp = $API->action(ChargeOverAPI_Object::TYPE_INVOICE, 
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

