<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$Package = new ChargeOverAPI_Object_Package();
$Package->setCustomerId(18);

// Tell it to use whatever ACH account is on file for this customer
//$Package->setPaymethod('ach');
//$Package->setPaymethod('crd');  // ... or whichever credit card

// By default, ChargeOver will create MONTHLY recurring packages - but you can change this:
//$Package->setPaycycle('yrl');  // yearly
//$Package->setPaycycle('qtr');  // quarterly
// @todo more cycles docs 

$Package->setCoupon('The coupon code goes here.');

$LineItem = new ChargeOverAPI_Object_LineItem();
$LineItem->setItemId(1);
//$LineItem->setDescrip('Test of a description goes here.');
$LineItem->setTrialDays(20);
$LineItem->setLineQuantity(15);

$Package->addLineItems($LineItem);

$resp = $API->create($Package);

if (!$API->isError($resp))
{
	$package_id = $resp->response->id;
	print('SUCCESS! Package # is: ' . $package_id);
}
else
{
	print('Error saving package via API' . "\n");

	print('Error message was: ' . $resp->code . ': ' . $resp->message . "\n");

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}

