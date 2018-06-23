<?php

header('Content-Type: text/plain');

use ChargeOver\APIObject\Note;
use ChargeOver\ChargeOverAPI;

require_once '../vendor/autoload.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = '7sutWFEO2zKVYIGmZMJ3Nij5hfLxDRb8';
$password = '9vCJbmdZKSieVchyrRItFQw8MBN4lOH3';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$Note = new Note(array(
	'note' => 'Here is my test note',

	'obj_type' => 'customer',
	'obj_id' => 328
	));

// Create the user
$resp = $API->create($Note);

// Check for errors
if (!$API->isError($resp))
{
	$note_id = $resp->response->id;
	print('SUCCESS! Note # is: ' . $note_id);
}
else
{
	print('Error saving note via API');

	print($API->lastResponse());
}

/*
print($API->lastRequest());
print("\n\n\n");
print($API->lastResponse());
*/
