<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// Find a subscription by subscription ID #
$resp = $API->findById('package', 1234);

if (!$API->isError($resp))
{
	$Package = $resp->response;
	print_r($Package);

}
else
{
	print('There was an error looking up the subscription!' . "\n");
}

