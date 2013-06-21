<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

$url = 'http://dev.chargeover.com/signup/api/v3.php';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = '7sutWFEO2zKVYIGmZMJ3Nij5hfLxDRb8';
$password = '9vCJbmdZKSieVchyrRItFQw8MBN4lOH3';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$Transaction = new ChargeOverAPI_Object_Transaction();

$Transaction->setCustomerId(1541);

$Transaction->setGatewayId(1);
$Transaction->setGatewayStatus(1);
$Transaction->setGatewayTransid('abcd1234');
$Transaction->setGatewayMsg('My test message');

$Transaction->setAmount(15.95);

$Transaction->setTransactionType('pay');
$Transaction->setTransactionMethod('Visa');
$Transaction->setTransactionDetail('');

$Transaction->setTransactionDatetime(date('Y-m-d H:i:s'));


/*
// If you also want to specify what invoices you apply this to
$AppliedTo = new ChargeOverAPI_Object_Transaction();
$AppliedTo->setInvoiceId(1234);

$Transaction->addAppliedTo($AppliedTo);
*/


$resp = $API->create($Transaction);

/*
print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
*/

if (!$API->isError($resp))
{
	$transaction_id = $resp->response->id;
	print('SUCCESS! Transaction # is: ' . $transaction_id);
}
else
{
	print('Error saving transaction via API' . "\n");

	print('Error message was: ' . $resp->code . ': ' . $resp->message . "\n");

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}

