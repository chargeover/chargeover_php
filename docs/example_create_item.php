<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$Item = new ChargeOverAPI_Object_Item(array(
	'name' => 'My Apple Test Item ' . mt_rand(0, 1000), 
	'type' => ChargeOverAPI_Object_Item::TYPE_SERVICE,

	'pricemodel' => array(
		//'base' => 295.95, 
		'setup' => 35.95, 
		'pricemodel' => ChargeOverAPI_Object_Item::PRICEMODEL_FLAT, 
		)
	));

// Create the user
$resp = $API->create($Item);

// Check for errors
if (!$API->isError($resp))
{
	$item_id = $resp->response->id;
	print('SUCCESS! Item # is: ' . $item_id);
}
else
{
	print('Error saving item via API');

	print("\n\n");
	print($API->lastRequest() . "\n\n");
	print($API->lastResponse() . "\n\n");
}

	print($API->lastRequest() . "\n\n");
	print($API->lastResponse() . "\n\n");