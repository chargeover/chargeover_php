<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'f3gMZ2b1JzqkxP8LXt9eGVYdnNKAQc0i';
$password = 'ivw8Wq0cfd9UFTAzaOjLZYNE6e53bIXK';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$user_id = 368;

$User = new ChargeOverAPI_Object_User(array(
	'username' => 'keithpalmer' . mt_rand(0, 1000), 

	'name' => 'Keith Palmer', 
	'email' => 'newemail@newemail.com',
	));

$resp = $API->modify($user_id, $User);

if (!$API->isError($resp))
{
	print('Updated the user!');

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}
else
{
	print('Error updating user via API: ' . $resp->message);

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}

