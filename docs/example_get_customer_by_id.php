<?php

use ChargeOver\ChargeOverAPI;

header('Content-Type: text/plain');

require_once '../vendor/autoload.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'WQnDGXPaBOhcK0e2Au7tvwHkMXPaBOhcK0e2qrsY5bS';
$password = 'C05d6Tpz3LEo2RUhNwWC05d6Tpz3LEVKFcJa4bqAGYk';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

//Find a customer by the ChargeOver customer ID
$resp = $API->findById('customer', '386');


/*
print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
*/

if (!$API->isError($resp))
{
	$customer = $resp->response;
	print('SUCCESS! got back customer: ' . $customer);
}
else
{
	print('There was an error looking up the customer!' . "\n");
}

