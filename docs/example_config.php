<?php

header('Content-Type: text/plain');

use ChargeOver\ChargeOverAPI;

require_once '../vendor/autoload.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/signup/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'sLmVGFljcKhtg7rBkAOoNaE9SwWzRYUq';
$password = '3TI5VjyNGlwYHeBuxfcq7tbKh9PS8iAW';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// Create the user
$resp = $API->config('chargeoverjs_token', date('YmdHis') . '_' . mt_rand());

// Check for errors
if (!$API->isError($resp))
{
	print_r($resp->response);
}
else
{
	print('Error!');

	print($API->lastRequest());
	print("\n\n");
	print($API->lastResponse());

}

print("\n\n");
print($API->lastRequest());
print("\n\n");
print($API->lastResponse());
