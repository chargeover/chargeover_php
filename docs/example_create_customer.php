<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'Q3putY0lSXn9OKNg15a4x8sHmBUjDWVh';
$password = 'u1tfwimpXGg8bdWELMzPrHxVFZe9DKNj';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$Customer = new ChargeOverAPI_Object_Customer(array(
	'company' => 'Test API Company, LLC',
	
	'bill_addr1' => '123 ChargeOver Street',
	'bill_addr2' => 'Suite 10',
	'bill_city' => 'Minneapolis',
	'bill_state' => 'MN',
	'bill_postcode' => '55416',
	'bill_country' => 'USA',

	'external_key' => 'abcd' . mt_rand(1, 10000), 		// The external key is used to reference objects in external applications
	));

$resp = $API->create($Customer);

if (!$API->isError($resp))
{
	$customer_id = $resp->response->id;
	print('SUCCESS! Customer # is: ' . $customer_id);


}
else
{
	print('error saving customer via API: ' . $API->lastError());

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}

