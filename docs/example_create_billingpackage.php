<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'I2L6SQd9ikRJMUtgurWzTfqOK1FoGxl7';
$password = 'zVLXxjGZvdubmJ5WnyifhlH0gSIY3Et9';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$BillingPackage = new ChargeOverAPI_Object_BillingPackage();
$BillingPackage->setCustomerId(5);

$LineItem = new ChargeOverAPI_Object_LineItem();
$LineItem->setItemId(2);
$LineItem->setDescrip('Test of a description goes here.');

$BillingPackage->addLineItems($LineItem);

$resp = $API->create($BillingPackage);

/*
print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
*/

if (!$API->isError($resp))
{
	$billingpackage_id = $resp->response->id;
	print('SUCCESS! Billing Package # is: ' . $billingpackage_id);
}
else
{
	print('Error saving billing package via API' . "\n");

	print('Error message was: ' . $resp->code . ': ' . $resp->message . "\n");

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}

