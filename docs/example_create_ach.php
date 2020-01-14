<?php

header('Content-Type: text/plain');

require('../ChargeOverAPI.php');
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$customer_id = 1560;

$ACH = new ChargeOverAPI_Object_Ach(array(
	'customer_id' => $customer_id, // Must be the customer ID of an existing customer in ChargeOver

	'type' => ChargeOverAPI_Object_Ach::TYPE_CHECKING, 
	'number' => '1234 1234 1234', 
	'routing' => '072403004', 
	
	'name' => 'John Doe', 

	));

$resp = $API->create($ACH);

if (!$API->isError($resp))
{
	$ach_id = $resp->response->id;
	
	print('SUCCESS! Stored ACH/eCheck account as ach_id #: ' . $ach_id);
}
else
{
	print('Error saving ACH/eCheck account via API!');

	print($API->lastResponse());
}

