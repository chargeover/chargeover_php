<?php

header('Content-Type: text/plain');

use ChargeOver\ChargeOverAPI;

require_once '../vendor/autoload.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'JxI2LYptQkVDMbaFST8RNegzrqji9Wmh';
$password = 'k5mSN0rb7KFHl4PBVDpLv2JfoG6qEQiW';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$data = array(
	// Valid options:
	//   "mon"    // monthly
	//   "yrl"    // yearly
	//   "1wk"    // every week
	//   "2wk"    // every other week
	//   "qtr"    // every quarter

	'paycycle' => 'mon',
	);

$resp = $API->action('package', 557, 'paycycle', $data);

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

