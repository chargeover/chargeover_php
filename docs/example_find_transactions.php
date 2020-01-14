<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// Find payments for a specific invoice
$resp = $API->find('transaction', array( 'transaction_type:EQUALS:pay', 'applied_to.invoice_id:EQUALS:10036' ));

if (!$API->isError($resp))
{
	$transactions = $resp->response;
	
	// Loop through the found invoices and print them out 
	foreach ($transactions as $Payment)
	{
		print_r($Payment);
	}
}

/*
print($API->lastRequest());
print($API->lastResponse());
*/