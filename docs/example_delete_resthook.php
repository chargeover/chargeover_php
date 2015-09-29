<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'noECbNw0GDA7vtPLcuaVqJBRhUldjz38';
$password = 'B6LnuVGE74Co1TacXxHjdwk9hKtPpIW0';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$the_resthook_id = 3;

// Create the user
$resp = $API->delete(ChargeOverAPI_Object::TYPE_RESTHOOK, $the_resthook_id);

// Check for errors
if (!$API->isError($resp))
{
	print('SUCCESS!');
	print_r($resp);
}
else
{
	print('Error deleting resthook via API');

	print("\n\n");
	print($API->lastRequest() . "\n\n");
	print($API->lastResponse() . "\n\n");
}
