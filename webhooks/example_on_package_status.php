<?php

/**
 * 
 *
 */

// Your secret web hook token
$secret = 'xhtfLO9TumgUs6QRpzr8cKMFPHqAnad2';

// Get the data from the web hook
$data = file_get_contents('php://input');

// Decode it to an array
$json = json_decode($data, true);

// Verify the security token
if ($json['security_token'] == $secret)
{
	// Do some work

	if ($json['context_str'] == 'package')    // We're going to watch for events related to "packages"
	{
		
		if ($json['event'] == 'status')
		{
			// A PACKAGE just had it's STATUS change in ChargeOver

			$customer_id = $json['data']['customer']['customer_id'];
			$company = $json['data']['customer']['company'];

			$package_id = $json['data']['package']['package_id'];
			
			$package_status_name = $json['data']['package']['package_status_name'];     // Human-readable package status 
			$package_status_str = $json['data']['package']['package_status_str'];       // See docs here for statuses: http://developer.chargeover.com/apidocs/rest/#recurring-packages
			$package_status_state = $json['data']['package']['package_status_state'];   // See docs here for states: http://developer.chargeover.com/apidocs/rest/#recurring-packages

			// $package_status_state will be one of these 1-character states:
			//  "a"      (active)
			//  "c"      (cancelled)
			//  "e"      (expired)
			//  "s"      (suspended)

			// $package_status_str will be one of these strings:
			//   "active-trial"        (active package, in the free trial period still)
			//   "active-current"      (active package, and payment is current)
			//   "active-overdue"      (active package, payment is overdue)
			//   "canceled-nonpayment" (cancelled, due to non-payment)
			//   "canceled-manual"     (cancelled manually)
			//   "expired-expired"     (expired)
			//   "expired-trial"       (expired free trial)
			//   "suspended-suspended" (suspended)
			
			// Write some data to the error log for debugging
			error_log('Customer ID: ' . $customer_id);
			error_log('Package ID: ' . $package_id);
			error_log('Status name: ' . $package_status_name);
			error_log('Status str: ' . $package_status_str);
			error_log('Status state: ' . $package_status_state);
			
			// Write the raw JSON to the error log
			//error_log($data);
		}
		
	}
}