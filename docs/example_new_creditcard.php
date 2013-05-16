<?php

header('Content-Type: text/plain');

require('../ChargeOverAPI.php');

$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/signup/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'h2YwHWe8TA1J64la7rNx0EtdFjmOCnRV';
$password = '0iYhcWp7O1xReqLd4vwJNuDXF2gmlZ86';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$User = new ChargeOverAPI_Object_User(array(
	'customer_id' => $customer_id, //Must be the customer ID of an existing customer in ChargeOver

	'name' => 'Jean-Claude Van Damme',
	'email' => 'jean-claude@vandamme.com',
	'username' => 'my_username_' . mt_rand(0, 1000),
	'password' => 'password',
));

$resp = $API->create($User);

if (!$API->isError($resp))
{
	$customer_id = $resp->response->id;
	print('SUCCESS! User # is: ' . $customer_id);


}
else
{
	print('error saving user via API');

	print($API->lastResponse());
}

