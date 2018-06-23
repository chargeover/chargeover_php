<?php

/**
 * Example of creating an invoice, and then paying it using an ACH/eCheck payment
 *
 *
 */

header('Content-Type: text/plain');

use ChargeOver\ChargeOverAPI;

require_once '../vendor/autoload.php';

// This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3.php';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = '1YExkQoscPr0eHzVbKvMASyLpmC427BW';
$password = 'fhKyga18s3D42lIbB6vRc0TdFOzrYUkL';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// The invoice that we want to void
$transaction_id = 23;

// This $data is all optional, but can be used to override the defaults
$data = array(

	// This let's you override the actual message template itself
	//'message_id' => 3,

	// These let you override individual parts of the message
	//'email' => 'johndoe@send-invoice-to.com',
	//'subject' => 'Test subject',
	//'html' => 'Override the default HTML body here',
	//'body' => 'Override the default message body here',
	//'from' => 'you@your-company.com',
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

