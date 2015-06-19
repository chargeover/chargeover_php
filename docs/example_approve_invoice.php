<?php

/**
 * Example of approving an invoice
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
$username = 'V1tufg9vklUywH0DqrFs26bjCTm7A8KE';
$password = 'PBRIh8mqzErT2ikpud3VtLwX6W1Ko7JN';

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

