<?php

/**
 * Example of setting the payment method for a billing package 
 *
 * 
 */

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = '1EkcsIZRUJwdWmyT6lzqa4Y0pXvgNKCB';
$password = 'IZah9p134R7OLtHl26BCmFXWUjVQxsNM';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// This is the package we're sending out welcome e-mails to
$package_id = 715;

// Save credit card via API 
$resp = $API->action('package', $package_id, 'welcome');

// Response from the API 
print_r($resp);

// Debugging 
print("\n\n");
print($API->lastRequest());
print("\n\n");
print($API->lastResponse());