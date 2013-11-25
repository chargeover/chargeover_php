<?php

/**
 * Example of running into a duplicate external key error
 * 
 * External keys are used in ChargeOver to provide an easy way to integrate 
 * external systems with ChargeOver. You can stuff your own keys into any 
 * ChargeOver object, and then later query by and reference that object by 
 * your own external key value.
 * 
 * External keys are a UNIQUE CONSTRAINT in ChargeOver - e.g. you can't have 
 * two customers with the same external key. Trying to do that will result 
 * in an error message. 
 * 
 * See the docs for more details:
 * 	http://chargeover.com/docs/rest-api.html#external-keys
 * 
 * @author Keith Palmer <support@ChargeOver.com>
 */

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_SIGNATURE_V1;
$username = 'f3gMZ2b1JzqkxP8LXt9eGVYdnNKAQc0i';
$password = 'ivw8Wq0cfd9UFTAzaOjLZYNE6e53bIXK';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// Here's the external key we're going to try to use more than once
$external_key = 'duplicate key ' . mt_rand(0, 100);

$Customer = new ChargeOverAPI_Object_Customer(array(
	'company' => 'Test API Company, LLC',
	
	'bill_addr1' => '123 ChargeOver Street',
	'bill_addr2' => 'Suite 10',
	'bill_city' => 'Minneapolis',
	'bill_state' => 'MN',
	'bill_postcode' => '55416',
	'bill_country' => 'USA',

	'external_key' => $external_key, 		// The external key is used to reference objects in external applications
	));

// This ***should*** generate an error after the first request (each subsequent request should be a duplicate key)
for ($i = 0; $i < 5; $i++)
{
	$resp = $API->create($Customer);

	//print($API->lastResponse());
	//exit;

	if (!$API->isError($resp))
	{
		$customer_id = $resp->response->id;
		print('SUCCESS! Customer # is: ' . $customer_id . "\n");
	}
	else
	{
		print('ERROR! The error message was: ' . $resp->message . "\n");
	}
}
