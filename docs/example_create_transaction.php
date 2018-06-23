<?php

header('Content-Type: text/plain');

use ChargeOver\APIObject\Transaction;
use ChargeOver\ChargeOverAPI;

require_once '../vendor/autoload.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = '1EkcsIZRUJwdWmyT6lzqa4Y0pXvgNKCB';
$password = 'IZah9p134R7OLtHl26BCmFXWUjVQxsNM';


$API = new ChargeOverAPI($url, $authmode, $username, $password);

$Transaction = new Transaction();

$Transaction->setCustomerId(1);

//$Transaction->setGatewayId(1);
$Transaction->setGatewayStatus(1);
$Transaction->setGatewayTransid('abcd1234');
$Transaction->setGatewayMsg('My test message');
$Transaction->setGatewayMethod('visa');

$Transaction->setAmount(1500.95);

$Transaction->setTransactionType('pay');
$Transaction->setTransactionMethod('Visa');
$Transaction->setTransactionDetail('');

$Transaction->setTransactionDate('2014-12-02');

/*
// If you also want to specify what invoices you apply this to
$AppliedTo = new \ChargeOver\APIObject_Transaction();
$AppliedTo->setInvoiceId(1234);

$Transaction->addAppliedTo($AppliedTo);
*/

$resp = $API->create($Transaction);

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

