<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';


$API = new ChargeOverAPI($url, $authmode, $username, $password);

$Transaction = new ChargeOverAPI_Object_Transaction();

$Transaction->setCustomerId(60);

//$Transaction->setGatewayId(1);
$Transaction->setGatewayStatus(1);
$Transaction->setGatewayTransid('abcd1234');
$Transaction->setGatewayMsg('My test message');
$Transaction->setGatewayMethod('visa');

$Transaction->setAmount(15.95);

$Transaction->setTransactionType('pay');
$Transaction->setTransactionMethod('Visa');
$Transaction->setTransactionDetail('');

$Transaction->setTransactionDate('2020-12-02');

/*
// If you also want to specify what invoices you apply this to
$applied_tos = array();

$applied_to_1 = array(
	'invoice_id' => 1072,   // invoice_id to apply the payment to
	'applied' => 2.95,      // $2.95
	);

$applied_to_2 = array(
	'invoice_id' => 1073,
	'applied' => 13.00,
	);

$applied_tos[] = $applied_to_1;
$applied_tos[] = $applied_to_2;
*/

$Transaction->setAppliedTo($applied_tos);

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

