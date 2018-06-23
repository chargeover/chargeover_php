<?php

header('Content-Type: text/plain');

use ChargeOver\ChargeOverAPI;

require_once '../vendor/autoload.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'o0ptJLS2zwTmMl5dRKZG9kPxYDWVCgHs';
$password = 'WNJxUswvOFh0RbpXrC6Tut82HE9yGgPQ';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// Get a list of all countries
$resp = $API->find('country');

/*
print("\n\n\n\n");
print($API->lastRequest());
print("\n\n\n\n");
print($API->lastResponse());
print("\n\n\n\n");
*/

if (!$API->isError($resp))
{
	$countries = $resp->response;

	foreach ($countries as $country)
	{
		//print_r($customer);
		print('Country: ' . $country->name . "\n");
		print("\n");
	}

}
else
{
	print('Error getting customer list' . "\n");
}


