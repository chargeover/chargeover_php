<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'NdFEQznqKlJki2LOfZSW5b7Ip86amMe1';
$password = '8HuIoLUlv4qfwNczSEC7Ypt3asbhi1k0';

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

