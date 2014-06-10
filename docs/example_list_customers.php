<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'Q3putY0lSXn9OKNg15a4x8sHmBUjDWVh';
$password = 'u1tfwimpXGg8bdWELMzPrHxVFZe9DKNj';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

//Get all customers
$resp = $API->find('customer');


/*
print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
*/

if (!$API->isError($resp))
{
	$customers = $resp->response;

	foreach ($customers as $customer)
	{
		//print_r($customer);
		print('Customer ID: ' . $customer->customer_id . ', Name: ' . $customer->company . "\n");
		print('    You can also use ->get*() methods: ' . $customer->getCustomerId() . ', Name: ' . $customer->getCompany() . "\n");
		print("\n");
	}
	
}
else
{
	print('Error getting customer list' . "\n");
}


