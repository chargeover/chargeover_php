<?php

header('Content-Type: text/plain');

use ChargeOver\APIObject\Item;
use ChargeOver\ChargeOverAPI;

require_once '../vendor/autoload.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'p1Ii7JWQKLzZ64G9lt3PAUa8exNsf5RM';
$password = 'h1YlowmzS6bROM8eHZBaT9pj5UcFtDIV';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$Item = new Item(array(
	'name' => 'My Apple Test Item ' . mt_rand(0, 1000),
	'type' => Item::TYPE_SERVICE,

	'pricemodel' => array(
		//'base' => 295.95,
		'setup' => 35.95,
		'pricemodel' => Item::PRICEMODEL_FLAT,
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
