<?php

header('Content-Type: text/plain');

use ChargeOver\APIObject\Invoice;
use ChargeOver\APIObject\LineItem;
use ChargeOver\ChargeOverAPI;

require_once '../vendor/autoload.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'noECbNw0GDA7vtPLcuaVqJBRhUldjz38';
$password = 'B6LnuVGE74Co1TacXxHjdwk9hKtPpIW0';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$Invoice = new Invoice();
$Invoice->setCustomerId(1);
$Invoice->setDate('2014-01-02');

$LineItem = new LineItem();
$LineItem->setItemId(4);
$LineItem->setLineRate(29.95);
$LineItem->setLineQuantity(3);
$LineItem->setDescrip('Test of a description goes here.');

$Invoice->addLineItems($LineItem);

$LineItem = clone $LineItem;
$LineItem->setLineQuantity(2);

$Invoice->addLineItems($LineItem);

//print_r($Invoice->__toString());

$resp = $API->create($Invoice);

/*
print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
*/

if (!$API->isError($resp))
{
	$invoice_id = $resp->response->id;
	print('SUCCESS! Invoice # is: ' . $invoice_id);
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

