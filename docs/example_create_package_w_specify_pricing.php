<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$url = 'http://dev.chargeover.com/signup/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'aPEDf5ehpOtJjix2lnFc7KrkqVmgHouw';
$password = 'hrUvPdo21QG0tSLXg4u69ZfIkMa5pinY';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$Package = new ChargeOverAPI_Object_Package();
$Package->setCustomerId(1);

// By default, ChargeOver will create MONTHLY recurring packages - but you can change this:
//$Package->setPaycycle('yrl');  // yearly
//$Package->setPayCycle('qtr');  // quarterly
// @todo more cycles docs 

$LineItem = new ChargeOverAPI_Object_LineItem();
$LineItem->setItemId(1);
$LineItem->setDescrip('Test of a description goes here.');

$LineItem->setTierset(array(
	'setup' => 0,
	'base' => 135,
	'paycycle' => 'mon', 
	'pricemodel' => 'fla' 
	));

$Package->addLineItems($LineItem);

$resp = $API->create($Package);

/*
print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
*/

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

