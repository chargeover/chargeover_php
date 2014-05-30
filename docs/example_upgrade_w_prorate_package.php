<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'o0ptJLS2zwTmMl5dRKZG9kPxYDWVCgHs';
$password = 'WNJxUswvOFh0RbpXrC6Tut82HE9yGgPQ';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$data = array(
	'line_items' => array(
		0 => array(
			'line_item_id' => 576, 
			'item_id' => 2, 
			'descrip' => 'upgraded description goes here', 

			'subscribe_prorate' => true, 		// pro-rate the new one
			'cancel_prorate' => true, 			// pro-rate the old one 

			'custom_1' => 'new custom 1', 
			'external_key' => 'new-external',
			),
		),
	);

$resp = $API->action('package', 565, 'upgrade', $data);

/*
print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
*/

if (!$API->isError($resp))
{
	print('SUCCESS!');
}
else
{
	print('Error message was: ' . $resp->code . ': ' . $resp->message . "\n");

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}

