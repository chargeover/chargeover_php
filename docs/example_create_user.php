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

$User = new ChargeOverAPI_Object_User(array(
	'customer_id' => 21, 					// The customer # that the user/contact should be assigned to 

	'username' => 'my_test_username_' . mt_rand(0, 500), 	// (optional) The username the user can use to log in to their customer portal
	'password' => 'some test password', 					// (optional) The password the user can use to log in 

	'name' => 'Ryan Bantz', 

	'email' => 'ryan@adgadgagadg.com',
	'phone' => '888-555-1212',
	));

// Create the user
$resp = $API->create($User);

// Check for errors
if (!$API->isError($resp))
{
	$user_id = $resp->response->id;
	print('SUCCESS! User/contact # is: ' . $user_id);
}
else
{
	print('Error saving user/contact via API');

	print($API->lastResponse());
}
