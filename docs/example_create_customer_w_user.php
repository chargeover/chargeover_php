<?php

header('Content-Type: text/plain');

use ChargeOver\APIObject\Customer;
use ChargeOver\ChargeOverAPI;

require_once '../vendor/autoload.php';

//This url should be specific to your ChargeOver instance
$url = 'https://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$url = 'http://haproxy-dev.chargeover.com/signup/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'Q59q7OinLCzSJFd0xbtGA4cy6UNpfIvl';
$password = 'vam458nCkIerzJqWSdF6BcAYHQiMwux2';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$Customer = new Customer(array(

	// Main customer data
	'company' => 'Test API Company, LLC',

	'bill_addr1' => '123 ChargeOver Street',
	'bill_addr2' => 'Suite 10',
	'bill_city' => 'Minneapolis',
	'bill_state' => 'MN',
	'bill_postcode' => '55416',
	'bill_country' => 'USA',

	'external_key' => 'abcd' . mt_rand(1, 10000), 		// The external key is used to reference objects in external applications

	// This is a short-cut to also creating a user at the same time
	'superuser_name' => 'Ryan Bantz',
	'superuser_email' => 'ryan@chargeover.com',
	'superuser_username' => 'ryanbantz' . mt_rand(1, 1000),

	));

$resp = $API->create($Customer);

if (!$API->isError($resp))
{
	$customer_id = $resp->response->id;
	print('SUCCESS! Customer # is: ' . $customer_id);
}
else
{
	print('error saving customer via API');

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}

