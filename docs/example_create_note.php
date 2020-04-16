<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$Note = new ChargeOverAPI_Object_Note(array(
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