<?php

use ChargeOver\APIObject;
use ChargeOver\ChargeOverAPI;

header('Content-Type: text/plain');

require_once '../vendor/autoload.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = '7sutWFEO2zKVYIGmZMJ3Nij5hfLxDRb8';
$password = '9vCJbmdZKSieVchyrRItFQw8MBN4lOH3';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// Find a customer by the ChargeOver customer ID
$resp = $API->find(APIObject::TYPE_ITEM, [], array('item_id:DESC'));

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

