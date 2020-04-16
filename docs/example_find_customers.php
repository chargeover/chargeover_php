<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// Find a customer by the ChargeOver customer ID
$resp = $API->find('customer', array( 'bill_state:EQUALS:AZ' ));

if (!$API->isError($resp))
{
	$customers = $resp->response;

	print('Showing the list of customers...' . "\n\n");
	
	// Loop through the found invoices and print them out 
	foreach ($customers as $Customer)
	{
		print_r($Customer);
	}

	
}
else
{
	print('There was an error looking up the customers!' . "\n");

	print('Error: ' . $API->lastError());
	print('Request: ' . $API->lastRequest());
	print('Response: ' . $API->lastResponse());
	print('Info: ' . print_r($API->lastInfo(), true));
}

