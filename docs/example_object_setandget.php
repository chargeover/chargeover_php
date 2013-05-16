<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

$url = 'http://dev.chargeover.com/signup/api/v3.php';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = '7sutWFEO2zKVYIGmZMJ3Nij5hfLxDRb8';
$password = '9vCJbmdZKSieVchyrRItFQw8MBN4lOH3';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$Customer = new ChargeOverAPI_Object_Customer();


$Customer->setEmail('email@email.com');
$Customer->setCompanyName('Test Company Name');
$Customer->setBillAddr1('Test bill adderess 1');
$Customer->setBillPostCode('48858');

print_r($Customer);
print("\n\n\n");

print('email: ' . $Customer->getEmail() . "\n");
print('company name: ' . $Customer->getCompanyName() . "\n");
print('bill addr 1: ' . $Customer->getBillAddr1() . "\n");
print('bill post code: ' . $Customer->getBillPostCode() . "\n");

print("\n\n\n");


print('method for "company_name": ' . ChargeOverAPI_Object::transformFieldToMethod('company_name') . "\n");
print('method for "email": ' . ChargeOverAPI_Object::transformFieldToMethod('email') . "\n");
print('method for "bill_addr1": ' . ChargeOverAPI_Object::transformFieldToMethod('bill_addr1') . "\n");


exit;

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

