<?php

/**
 * Example of handling a transaction insert
 *
 * This webhook listener listens for new transactions that are created. When a
 * new transaction is created, it then looks up related invoices and
 * subscriptions, and sets some variables.
 *
 * This can be helpful for detecting things like first payment vs. renewal
 * payments, etc.
 */

// Pull in a lib from: https://github.com/chargeover/chargeover_php
require_once dirname(__FILE__) . '/chargeover_php-master/ChargeOverAPI.php';

$url = 'http://dev1.chargeover.test/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';
//
// Your ChargeOver API credentials
$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'JPFyZqaluhc5LRYTBUMk0oV9OeDHsv8g';
$password = 'hcW0b1Pg5MtoDQGaAz2qU3H6JZKTClOm';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// Your secret web hook token
$secret = 'YuoIT2WdXt3Ow5iH04jyCAqQzFkEeGVS';

// Get the data from the web hook
$data = file_get_contents('php://input');

// Decode it to an array
$json = json_decode($data, true);

// Verify the security token
if ($json['security_token'] == $secret)
{
	// Do some work
	if ($json['context_str'] == 'transaction')    // We're going to watch for events related to "packages"
	{
		if ($json['event'] == 'insert')
		{
			// This the unique id for the payment
			$transaction_id = $json['data']['transaction']['transaction_id'];

			// Whether or not the payment was successful (you WILL get webhooks for failed transactions as well)
			$transaction_was_successful = (bool) $json['data']['transaction']['gateway_status'];

			// Have there been any previous transactions for this customer?
			$resp = $API->find('transaction', array( 'transaction_type:EQUALS:pay', 'gateway_status:EQUALS:1', 'customer_id:EQUALS:' . $json['data']['transaction']['customer_id'] ));
			$transaction_is_first = count($resp->response) == 1;

			$invoices = array();
			$subs = array();

			foreach ($json['data']['transaction']['applied_to'] as $i)
			{
				$resp = $API->findById('invoice', $i['invoice_id']);

				$invoices[] = $resp->response;

				 if (!empty($resp->response->package_id))
				 {
				 	$resp2 = $API->findById('package', $resp->response->package_id);

				 	$subs[$resp2->response->package_id] = $resp2->response;
				 }
			}

			error_log(print_r($json, true));
			error_log(print_r($invoices, true));
			error_log(print_r($subs, true));
			error_log('transaction id: ' . $transaction_id);
			error_log('transaction is success: ' . $transaction_was_successful);
			error_log('transaction is first: ' . $transaction_is_first);

		}
	}
}