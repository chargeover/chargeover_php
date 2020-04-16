<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

//Find a customer by the external key
//$resp = $API->find('customer', array('external_key:EQUALS:XFTE-KEY'));

//Get all customers from MN
$resp = $API->find('customer', array('bill_state:EQUALS:MN'));

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
	print('SUCCESS! got back customer: ' . $customer->company);
}
else
{
	print('There was an error looking up the customer!' . "\n");
}

