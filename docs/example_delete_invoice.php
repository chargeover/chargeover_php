<?php

/**
 * Example of deleting a customer from ChargeOver 
 */

header('Content-Type: text/plain');

// Require the library 
require '../ChargeOverAPI.php';

// This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = '1EkcsIZRUJwdWmyT6lzqa4Y0pXvgNKCB';
$password = 'IZah9p134R7OLtHl26BCmFXWUjVQxsNM';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// This is the unique customer ID value 
$the_invoice_id = 12998;

// Delete them
$resp = $API->delete(ChargeOverAPI_Object::TYPE_INVOICE, $the_invoice_id);

// Check for errors 
if (!$API->isError($resp))
{
	print('Invoice was deleted!');
}
else
{
	print('The invoice COULD NOT BE DELETED!');

	print("\n\n\n\n");
	print($API->lastError());
	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}

