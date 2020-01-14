<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$Resthook = new ChargeOverAPI_Object_Resthook(array(
	'target_url' => 'http://playscape2.uglyslug.com/resthooks/user_update.php', 
	'event' => 'user.update',
	));

// Create the user
$resp = $API->create($Resthook);

// Check for errors
if (!$API->isError($resp))
{
	print('SUCCESS!');
	print_r($resp);
}
else
{
	print('Error saving resthook via API');

	print("\n\n");
	print($API->lastRequest() . "\n\n");
	print($API->lastResponse() . "\n\n");
}
