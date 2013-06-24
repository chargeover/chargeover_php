<?php

header('Content-Type: text/plain');

require('../ChargeOverAPI.php');

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'h2YwHWe8TA1J64la7rNx0EtdFjmOCnRV';
$password = '0iYhcWp7O1xReqLd4vwJNuDXF2gmlZ86';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$Customer = new ChargeOverAPI_Object_Customer(array(
	'company' => 'Test API Company, LLC',
	'email' => 'asdgagd@asdgasdg.com',
	'phone' => '888-555-1212',

	'bill_addr1' => '123 ChargeOver Street',
	'bill_addr2' => 'Suite $',
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
	print('error saving customer via API');

	print($API->lastResponse());
}

