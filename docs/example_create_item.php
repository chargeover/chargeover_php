<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'kTvDgaR1Y6I9oeq7mCfhtHE0w8UQixzM';
$password = 'B2jNboGtYlKFc0UfCOp819HzEVQx5wq7';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$Item = new ChargeOverAPI_Object_Item(array(
	'name' => 'My Test Item ' . mt_rand(0, 1000), 
	'type' => ChargeOverAPI_Object_Item::TYPE_SERVICE,

	'pricemodel' => array(
		'base' => 295.95, 
		'paycycle' => 'evy', 
		'pricemodel' => 'fla', 
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