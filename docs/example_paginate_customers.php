<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

// This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/signup/api/v3.php';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = '7sutWFEO2zKVYIGmZMJ3Nij5hfLxDRb8';
$password = '9vCJbmdZKSieVchyrRItFQw8MBN4lOH3';

$API = new ChargeOverAPI($url, $authmode, $username, $password);


$offset = 0;
$limit = 10;

// Get all customers, 10 at a time (10 per page)
do 
{
	$resp = $API->find('customer', array(), $offset, $limit);
	$customers = $resp->response;

	print('Showing customers ' . $offset . ' through ' . ($offset + $limit) . "\n");

	foreach ($customers as $customer)
	{
		print('   Customer ID: ' . $customer->customer_id . ', Name: ' . $customer->company . "\n");
	}

	print("\n\n\n");

	$offset += $limit;		// Increment so that we get the next set 
}
while (count($customers) >= $limit);

//print($API->lastRequest());
//print($API->lastResponse());