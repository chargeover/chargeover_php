<?php

header('Content-Type: text/plain');

use ChargeOver\ChargeOverAPI;

require_once '../vendor/autoload.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$url = 'http://macbookpro.chargeover.com:8888/chargeover/signup/api/v3.php';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = '6d3nS4bQEXltIwNoYTFOHWUe9Gyugirj';
$password = 'lYEKFrnBSGZaUk9DW70huNMepfHs3cb4';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$package_id = 582;

$resp = $API->action('package', $package_id, 'hold',
	array(
		'holduntil_datetime' => date('Y-m-d H:i:s', strtotime('+30 days'))
	));

/*
print("\n\n\n\n");
print($API->lastRequest());
print("\n\n\n\n");
print($API->lastResponse());
print("\n\n\n\n");
exit;
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

