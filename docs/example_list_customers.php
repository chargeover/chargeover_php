<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

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


