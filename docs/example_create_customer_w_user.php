<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'https://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'f3gMZ2b1JzqkxP8LXt9eGVYdnNKAQc0i';
$password = 'ivw8Wq0cfd9UFTAzaOjLZYNE6e53bIXK';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$Customer = new ChargeOverAPI_Object_Customer(array(

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

