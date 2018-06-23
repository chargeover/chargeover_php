<?php

header('Content-Type: text/plain');

use ChargeOver\ChargeOverAPI;

require_once '../vendor/autoload.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'aPEDf5ehpOtJjix2lnFc7KrkqVmgHouw';
$password = 'hrUvPdo21QG0tSLXg4u69ZfIkMa5pinY';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$data = array(
	'line_items' => array(
		0 => array(

			// The line_item_id to cancel
			'line_item_id' => 611,

			// Tell it to cancel this line
			'cancel' => true
			),
		),
	);

$resp = $API->action('package', 595, 'upgrade', $data);

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

