<?php

header('Content-Type: text/plain');

use ChargeOver\APIObject\Ach;
use ChargeOver\ChargeOverAPI;

require_once '../vendor/autoload.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = '7sutWFEO2zKVYIGmZMJ3Nij5hfLxDRb8';
$password = '9vCJbmdZKSieVchyrRItFQw8MBN4lOH3';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$customer_id = 1560;

$ACH = new Ach(array(
	'customer_id' => $customer_id, // Must be the customer ID of an existing customer in ChargeOver

	'type' => Ach::TYPE_CHECKING,
	'number' => '1234 1234 1234',
	'routing' => '072403004',

	'name' => 'John Doe',

	));

$resp = $API->create($ACH);

if (!$API->isError($resp))
{
	$ach_id = $resp->response->id;

	print('SUCCESS! Stored ACH/eCheck account as ach_id #: ' . $ach_id);
}
else
{
	print('Error saving ACH/eCheck account via API!');

	print($API->lastResponse());
}

