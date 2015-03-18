<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

// This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'aPEDf5ehpOtJjix2lnFc7KrkqVmgHouw';
$password = 'hrUvPdo21QG0tSLXg4u69ZfIkMa5pinY';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// Get records 10 at a time, starting with the first record 
$offset = 0;
$limit = 10;

$where = array();
$sort = array( 'customer_id:ASC' );     // Order by customer_id 

// Get all customers, 10 at a time (10 per page)
do 
{
	$resp = $API->find('customer', $where, $sort, $offset, $limit);
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