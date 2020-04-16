<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

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

