<?php

/**
 * Example of setting the payment method for a billing package 
 *
 * 
 */

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'JxI2LYptQkVDMbaFST8RNegzrqji9Wmh';
$password = 'k5mSN0rb7KFHl4PBVDpLv2JfoG6qEQiW';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// This is the package we're cancelling
$package_id = 600;

$resp = $API->action('package', $package_id, 'cancel');

if (!$API->isError($resp))
{
	print('Cancelled package!');

	/*
	print($API->lastRequest());
	print("\n\n\n");
	print($API->lastResponse());
	*/
}
else
{
	print('ERROR: ' . $resp->message);
}
