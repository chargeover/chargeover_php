<?php

/**
 * Example of creating an invoice, and then paying it using an ACH/eCheck payment
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
$username = 'p1Ii7JWQKLzZ64G9lt3PAUa8exNsf5RM';
$password = 'h1YlowmzS6bROM8eHZBaT9pj5UcFtDIV';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// The invoice that we want to void
$invoice_id = 10564;

// This $data is all optional, but can be used to override the defaults
$data = array(
	//'email' => 'johndoe@send-invoice-to.com',
	//'message_subject' => 'Test subject',
	//'message_body' => 'Override the default message body here',
	//'message_from' => 'you@your-company.com',
	);

// Void an invoice
$resp = $API->action('invoice', $invoice_id, 'email', $data);

if (!$API->isError($resp))
{
	print('Sent the invoice!' . "\n");
}
else
{
	print('Error sending invoice via API' . "\n");

	print('Error message was: ' . $resp->code . ': ' . $resp->message . "\n");

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}

