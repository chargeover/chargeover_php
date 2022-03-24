<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

//Find a brand by the ChargeOver brand ID
$resp = $API->findById('brand', '4');


/*
print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
*/

if (!$API->isError($resp))
{
	$brand = $resp->response;
	print('SUCCESS! got back brand: ' . $brand->name);
}
else
{
	print('There was an error looking up the brand!' . "\n");
}

