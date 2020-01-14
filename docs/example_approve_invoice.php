<?php

/**
 * Example of approving an invoice
 *
 * 
 */

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// Invoice to attempt payment for 
$invoice_id = 10107;

// Pay for it 
$resp = $API->action(ChargeOverAPI_Object::TYPE_INVOICE, 
	$invoice_id, 
	'approve');

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

