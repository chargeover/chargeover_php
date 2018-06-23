<?php

/**
 * Example of creating an invoice, and then paying it using an ACH/eCheck payment
 *
 *
 */

header('Content-Type: text/plain');

use ChargeOver\ChargeOverAPI;

require_once '../vendor/autoload.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

// Your ChargeOver API credentials
$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'lSv6kTnCa1RQWcyGrw73IuzPVxZi49FL';
$password = 'OVmWTfS5knCeLdUp3ziwbcu4EIMN9s0J';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// The invoice that we want to void
$report_id = 44;

$filter = array(
	'invoice_invoice_date:GTE:2017-05-02',
	'invoice_invoice_date:LTE:2017-07-02',
	);

// Void an invoice
$resp = $API->action('_report', $report_id, 'getData', $filter);

if (!$API->isError($resp))
{
	print_r($resp);
}
else
{
	print('Error message was: ' . $resp->code . ': ' . $resp->message . "\n");

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}
