<?php

/**
 * 
 *
 */

// Your secret web hook token
$secret = 'KsF52NuytfWnevljo0MXCcbJLEUZDBdg';

// Get the data from the web hook
$payload = file_get_contents('php://input');

// Log it
error_log('Raw payload: ' . $payload);

// Decode base64
$data = base64_decode($payload);

// Decrypt the encrypted payload 
$td = mcrypt_module_open('rijndael-128', '', 'ofb', '');
$iv_size = mcrypt_enc_get_iv_size($td);

$iv = substr($data, 0, $iv_size);
$str = substr($data, $iv_size);

mcrypt_generic_init($td, $secret, $iv);
$decrypted = trim(mdecrypt_generic($td, $str));

mcrypt_generic_deinit($td);
mcrypt_module_close($td);

// Decode the JSON to an array
$json = json_decode($decrypted, true);

if ($json['context_str'] == 'customer')    // We're going to watch for events related to "customers"
{
	
	if ($json['event'] == 'insert')
	{
		// A new CUSTOMER has just been created
		error_log(print_r($json, true));
	}
	
}