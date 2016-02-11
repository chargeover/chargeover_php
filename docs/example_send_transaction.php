<?php

/**
 * Example of creating an invoice, and then paying it using an ACH/eCheck payment
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
$username = 'yPeQBOa0jAZS91R6u7VvtxYk2wTJFLn4';
$password = 'uk1Q4SgVwcfUzp3xvIlOLR5YiNjbmMsB';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// The invoice that we want to void
$transaction_id = 65;

// This $data is all optional, but can be used to override the defaults
$data = array(
	//'email' => 'johndoe@send-invoice-to.com', 
	//'message_subject' => 'Test subject', 
	//'message_body' => 'Override the default message body here', 
	//'message_from' => 'you@your-company.com', 
	);

// Void an invoice
$resp = $API->action('transaction', $transaction_id, 'email', $data);

if (!$API->isError($resp))
{
	print('Sent the transaction email!' . "\n");
}
else
{
	print('Error sending transaction via API' . "\n");

	print('Error message was: ' . $resp->code . ': ' . $resp->message . "\n");

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}


print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
