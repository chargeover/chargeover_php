<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = '7sutWFEO2zKVYIGmZMJ3Nij5hfLxDRb8';
$password = '9vCJbmdZKSieVchyrRItFQw8MBN4lOH3';



$url = 'https://imagerelay-staging.chargeover.com/api/v3';
$username = 'anxC9l8mu7wyZOdIJbFsL6zRSj032foW';
$password = 'zfnSG7PpIoVh3gCwEUi5bkxJjKTNs0mt';



$API = new ChargeOverAPI($url, $authmode, $username, $password);

//Find a customer by the ChargeOver customer ID
$resp = $API->find(ChargeOverAPI_Object::TYPE_INVOICE, array( 'customer_id:EQUALS:68' ), array('invoice_id:DESC'));

if (!$API->isError($resp))
{
	$invoices = $resp->response;
	
	// Loop through the found invoices and print them out 
	foreach ($invoices as $Invoice)
	{
		print_r($Invoice);
	}
}
else
{
	print('There was an error looking up the invoice!' . "\n");

	print('Error: ' . $API->lastError());
	print('Request: ' . $API->lastRequest());
	print('Response: ' . $API->lastResponse());
	print('Info: ' . print_r($API->lastInfo(), true));
}

