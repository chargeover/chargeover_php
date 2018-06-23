<?php

header('Content-Type: text/plain');

use ChargeOver\APIObject\Customer;
use ChargeOver\ChargeOverAPI;

require_once '../vendor/autoload.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'Mjay6XozbPTr0diJOWgs7YL49FBlfIUA';
$password = 'qTD8NLlCi6BsZUA973JP5upfEHw4FXrd';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$customer_id = 3;

$Customer = new Customer(array(
	'company' => 'Test API Company, LLC',

	'bill_addr1' => mt_rand(0, 1000) . ' ChargeOver Street',
	'bill_addr2' => 'Suite 10',
	'bill_city' => 'Minneapolis',
	'bill_state' => 'MN',
	'bill_postcode' => '55416',
	'bill_country' => 'USA',

	'external_key' => 'abcd' . mt_rand(1, 10000), 		// The external key is used to reference objects in external applications

	// Optional -  you can update the main contact for this customer too
	'superuser_name' => 'David Palmer',
	'superuser_email' => 'david@palmer.com',
	'superuser_phone' => '860-634-1111',

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

