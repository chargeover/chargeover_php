<?php

/**
 * Example of setting the payment method for a billing package 
 *
 * 
 */

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';
$url = 'http://dev.chargeover.com/signup/api/v3.php';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = '7sutWFEO2zKVYIGmZMJ3Nij5hfLxDRb8';
$password = '9vCJbmdZKSieVchyrRItFQw8MBN4lOH3';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// This is the customer/billing package we're updating
$customer_id = 1;
$billing_package_id = 554;

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
		'paymethod' => ChargeOverAPI_Object_BillingPackage::PAYMETHOD_CREDITCARD, 
		'creditcard_id' => $resp->response->id, 
		);

	$resp = $API->action('billing_package', $billing_package_id, 'paymethod', $data);

	if (!$API->isError($resp))
	{
		print('Updated payment method!');
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