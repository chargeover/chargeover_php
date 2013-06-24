<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = '0Dx9dnKrTOR3QlItAoBiULgSwvzVqC2e';
$password = 'OV20hDLzlSTvbsP34J5dUEotI6qmBFyk';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

//Find a customer by the external key
//$resp = $API->find('customer', array('external_key:EQUALS:XFTE-KEY'));

//Get all customers from MN
//$resp = $API->find('customer', array('bill_state:EQUALS:MN'));

//Get customers by email address and located in MN
$resp = $API->find('customer', array('email:EQUALS:mike@example.com', 'bill_state:EQUALS:MN'));

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

