<?php

/**
 * Example of setting the payment method for a billing package 
 *
 * 
 */

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// This is the customer/billing package we're updating
$customer_id = 2;
$package_id = 1206;

// Create a new credit card object
$CreditCard = new ChargeOverAPI_Object_CreditCard();
$CreditCard->setNumber('4111 1111 1111 1111');
$CreditCard->setExpdateYear(date('Y') + 1);
$CreditCard->setExpdateMonth(12);
$CreditCard->setCustomerId($customer_id);

// Save credit card via API 
$resp = $API->create($CreditCard);

// Set the payment method 
if (!$API->isError($resp))
{
	$data = array(
		'paymethod' => ChargeOverAPI_Object_Package::PAYMETHOD_CREDITCARD, 
		'creditcard_id' => $resp->response->id, 
		);

	/*
	$data = array(
		'paymethod' => ChargeOverAPI_Object_Package::PAYMETHOD_INVOICE, 
		);
	*/

	$resp = $API->action('package', $package_id, 'paymethod', $data);

	if (!$API->isError($resp))
	{
		print('Updated payment method!');

		/*
		print($API->lastRequest());
		print("\n\n\n");
		print($API->lastResponse());
		*/
	}
	else
	{
		print('ERROR: ' . $resp->message);
	}
}
else
{
	print('ERROR: ' . $resp->message);
}