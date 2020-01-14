<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

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


