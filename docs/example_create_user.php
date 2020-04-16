<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$User = new ChargeOverAPI_Object_User(array(
	'customer_id' => 1, 					// The customer # that the user/contact should be assigned to 

	//'username' => 'my_test_username_' . mt_rand(0, 500), 	// (optional) The username the user can use to log in to their customer portal
	'password' => 'some test password', 					// (optional) The password the user can use to log in 

	'name' => 'Ryan Bantz', 

	'email' => 'ryan@adgadgagadg.com',
	'phone' => '888-555-1212',

	//'external_key' => 'abcd12345', 
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
