<?php

/**
 * 
 *
 */

// Connect to MySQL so that we can log some of this stuff
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_pass = 'root';
$mysql_db = 'test_chargeover_webhooks';
$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);
if (!$conn)
{
	die('Could not connect to MySQL');
}

// Your secret web hook token
$secret = 'Q3putY0lSXn9OKNg15a4x8sHmBUjDWVh';

// Get the data from the web hook
$data = file_get_contents('php://input');

// Decode it to an array
$json = json_decode($data, true);

// Verify the security token
if ($json['security_token'] == $secret)
{
	// Do some work

	if ($json['context_str'] == 'package')   // We're going to watch for events related to "packages"
	{
		if ($json['event'] == 'insert')
		{
			// A new PACKAGE was just INSERTED (created) into ChargeOver

			$customer_id = $json['data']['customer']['customer_id'];
			$company = $json['data']['customer']['company'];

			$user_id = $json['data']['user']['user_id'];
			$first_name = $json['data']['user']['first_name'];
			$last_name = $json['data']['user']['last_name'];
			$email = $json['data']['user']['email'];

			$package_id = $json['data']['package']['package_id'];
			$next_invoice_date = $json['data']['package']['next_invoice_datetime'];
			$paycycle = $json['data']['package']['paycycle'];

			// Add to MySQL log
			mysqli_query($conn, "
				INSERT INTO 
					webhook_log
					( webhook_data, webhook_datetime ) 
				VALUES 
					( '" . mysqli_escape_string($conn, print_r($json, true)) . "', NOW() ) ");

			// Write to another MySQL table
			mysqli_query($conn, "
				INSERT INTO 
					chargeover_packages 
					( co_package_id, co_customer_id, co_company, co_name ) 
				VALUES 
					( " . $package_id . ", " . $customer_id . ", '" . mysqli_escape_string($conn, $company) . "', '" . mysqli_escape_string($conn, $first_name . ' ' . $last_name) . "' )");

			// Write some data to the error log for debugging
			error_log($data);
		}
		else if ($json['event'] == 'update')
		{
			// An existing PACKAGE was just UPDATED in ChargeOver

			// ... 
		}
	}
}