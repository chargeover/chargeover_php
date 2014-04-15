<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'Q3putY0lSXn9OKNg15a4x8sHmBUjDWVh';
$password = 'u1tfwimpXGg8bdWELMzPrHxVFZe9DKNj';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

$Usage = new ChargeOverAPI_Object_Usage();
//$Usage->setLineItemId(327);
$Usage->setLineItemExternalKey('abc123');
$Usage->setUsageValue(1);
//$Usage->setFrom(date('Y-m-d 00:00:00'));
//$Usage->setTo(date('Y-m-d 23:59:59'));

$resp = $API->create($Usage);

//print_r($resp);

print("\n\n\n\n");
print($API->lastRequest());
print("\n\n\n\n");
print($API->lastResponse());
print("\n\n\n\n");


