<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'I2L6SQd9ikRJMUtgurWzTfqOK1FoGxl7';
$password = 'zVLXxjGZvdubmJ5WnyifhlH0gSIY3Et9';



$url = 'http://macbookpro.chargeover.com:8888/chargeover/signup/api/v3.php';
$username = 'Ky4VRNGf08pPeSrwYlmdI35MLDBZCvqc';
$password = '5e9izMt08d1vNpwCnFQkI2uXPYLVBAfT';


$API = new ChargeOverAPI($url, $authmode, $username, $password);

$data = array(
	'line_items' => array(
		0 => array(
			'line_item_id' => 565, 
			'item_id' => 1, 
			'descrip' => 'upgraded description goes here', 

			'custom_1' => 'new custom 1', 
			'external_key' => 'new-external',
			),
		),
	);

$resp = $API->action('billing_package', 556, 'upgrade', $data);


print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");


if (!$API->isError($resp))
{
	print('SUCCESS!');
}
else
{
	print('Error message was: ' . $resp->code . ': ' . $resp->message . "\n");

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}

