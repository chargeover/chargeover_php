<?php

header('Content-Type: text/plain');

use ChargeOver\ChargeOverAPI;

require_once '../vendor/autoload.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'aPEDf5ehpOtJjix2lnFc7KrkqVmgHouw';
$password = 'hrUvPdo21QG0tSLXg4u69ZfIkMa5pinY';

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
