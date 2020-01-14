<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

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
