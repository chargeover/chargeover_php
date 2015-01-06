<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
$url = 'http://macbookpro.chargeover.com:8888/chargeover/signup/api/v3.php';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = '6d3nS4bQEXltIwNoYTFOHWUe9Gyugirj';
$password = 'lYEKFrnBSGZaUk9DW70huNMepfHs3cb4';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$Usage = new ChargeOverAPI_Object_Usage();
$Usage->setLineItemId(554);
//$Usage->setLineItemExternalKey('abc123');
$Usage->setUsageValue(mt_rand(0, 100));
//$Usage->setFrom(date('Y-m-d 00:00:00'));
//$Usage->setTo(date('Y-m-d 23:59:59'));

$Usage->setExternalKey('1234abcd');

$resp = $API->create($Usage);


//print_r($resp);

print("\n\n\n\n");
print($API->lastRequest());
print("\n\n\n\n");
print($API->lastResponse());
print("\n\n\n\n");


