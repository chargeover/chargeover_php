<?php

header('Content-Type: text/plain');

use ChargeOver\APIObject\CreditCard;
use ChargeOver\ChargeOverAPI;

require_once '../vendor/autoload.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = '1YExkQoscPr0eHzVbKvMASyLpmC427BW';
$password = 'fhKyga18s3D42lIbB6vRc0TdFOzrYUkL';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$customer_id = 1;

$CreditCard = new CreditCard(array(
	'customer_id' => $customer_id, // Must be the customer ID of an existing customer in ChargeOver
	//'customer_external_key' => 'abcd12345',

	'number' => '4111 1111 1111 1111',
	'expdate_year' => '2016',
	'expdate_month' => '8',
	'name' => 'John Doe',
	));

$resp = $API->create($CreditCard);

if (!$API->isError($resp))
{
	$creditcard_id = $resp->response->id;

	print('SUCCESS! Stored credit card as creditcard_id #: ' . $creditcard_id);
}
else
{
	print('Error saving credit card via API!');

	print($API->lastResponse());
}
