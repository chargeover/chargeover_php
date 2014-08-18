<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'http://macbookpro.chargeover.com:8888/chargeover/signup/api/v3.php';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 's2JQDL3KbV4tX56ox1OGmeBqlz89NUHg';
$password = 'fP6wYtHKSkDrl3xGRNUjJBMp2Q5bynW1';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$your_subscription_id = 'abcd1234' . mt_rand(0, 1000);

// Create a new billing package
$Package = new ChargeOverAPI_Object_Package();
$Package->setCustomerId(1);

// Tell the package to not invoice until the 1st 
$Package->setHolduntilDatetime(date('Y-m-01', strtotime('+1 month')));

// Here is your unique subscription ID # 
$Package->setExternalKey($your_subscription_id);

// This is for our data usage
$LineItem = new ChargeOverAPI_Object_LineItem();
$LineItem->setItemId(13);
$Package->addLineItems($LineItem);

// This is for our extra # of devices
$LineItem = new ChargeOverAPI_Object_LineItem();
$LineItem->setItemId(14);
$Package->addLineItems($LineItem);

$resp = $API->create($Package);

if ($resp->response->id)
{
	// Created the package! 



	// Now, every day you want to push new usage to it 
	// Get the package
	$resp = $API->find('package', array('external_key:EQUALS:' . $your_subscription_id));
	$resp = $API->findById('package', $resp->response[0]->getPackageId());

	$Package = $resp->response;
	
	$Lines = $Package->getLineItems();
	foreach ($Lines as $Line)
	{
		if ($Line->getItemExternalKey() == 'data')
		{
			// @todo Go fetch the usage from your database for the # of gigabytes
			$usage_data = 5; // 5 gigabytes
		}
		else if ($Line->getItemExternalKey() == 'devices')
		{
			// @todo Go fetch the usage from your database for the # of devices
			$usage_data = 9; // 9 devices
		}

		// Push the usage
		$Usage = new ChargeOverAPI_Object_Usage();
		$Usage->setLineItemId($Line->getLineItemId());
		$Usage->setUsageValue($usage_data);

		$resp = $API->create($Usage);
		print('Stored some usage! ' . "\n");
	}
}
else
{
	print('Error: ' . $resp->message);
}

// 

/*
$Usage = new ChargeOverAPI_Object_Usage();
//$Usage->setLineItemId(327);
$Usage->setLineItemExternalKey('abc123');
$Usage->setUsageValue(1);
//$Usage->setFrom(date('Y-m-d 00:00:00'));
//$Usage->setTo(date('Y-m-d 23:59:59'));

$resp = $API->create($Usage);

//print_r($resp);

print("\n\n\n\n");
print($API->lastRequest());
print("\n\n\n\n");
print($API->lastResponse());
print("\n\n\n\n");
*/

