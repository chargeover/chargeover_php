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
$username = 'Q59q7OinLCzSJFd0xbtGA4cy6UNpfIvl';
$password = 'vam458nCkIerzJqWSdF6BcAYHQiMwux2';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// This is the package we're suspending
$package_id = 561;

// Suspend it indefinitely 
$resp = $API->action('package', $package_id, 'suspend');

/*
// Suspend it within a certain date range
$resp = $API->action('package', $package_id, 'suspend', array(
	'suspendfrom_datetime' => '2015-03-06 00:00:00', 
	'suspendto_datetime' => '2015-06-05 00:00:00', 
	));
*/

if (!$API->isError($resp))
{
	print('Suspended package!');

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
