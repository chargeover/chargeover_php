<?php

/**
 * Example of creating an invoice, and then paying it using an ACH/eCheck payment
 *
 * 
 */

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// The invoice that we want to void
$invoice_id = 13011;

// Void an invoice
$resp = $API->action('invoice', $invoice_id, 'void');

if (!$API->isError($resp))
{
	print('Voided the invoice!' . "\n");
}
else
{
	print('Error voiding invoice via API' . "\n");

	print('Error message was: ' . $resp->code . ': ' . $resp->message . "\n");

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}
