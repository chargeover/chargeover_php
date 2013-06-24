<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = '7sutWFEO2zKVYIGmZMJ3Nij5hfLxDRb8';
$password = '9vCJbmdZKSieVchyrRItFQw8MBN4lOH3';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$customer_id = 1529;

$Customer = new ChargeOverAPI_Object_Customer(array(
	'company' => 'Test API Company, LLC',
	'email' => 'asdgagd@asdgasdg.com',
	'phone' => '888-555-1212',

	'bill_addr1' => mt_rand(0, 1000) . ' ChargeOver Street',
	'bill_addr2' => 'Suite 10',
	'bill_city' => 'Minneapolis',
	'bill_state' => 'MN',
	'bill_postcode' => '55416',
	'bill_country' => 'USA',

	'external_key' => 'abcd' . mt_rand(1, 10000), 		// The external key is used to reference objects in external applications
	));

$resp = $API->modify($customer_id, $Customer);

if (!$API->isError($resp))
{
	print('SUCCESS! Customer # ' . $customer_id . ' was updated!');

	
}
else
{
	print('Error saving customer via API');

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}

