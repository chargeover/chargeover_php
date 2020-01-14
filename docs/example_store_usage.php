<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);



$Usage = new ChargeOverAPI_Object_Usage();

$Usage->setLineItemId(854);
//$Usage->setLineItemExternalKey('abc123');

$Usage->setUsageValue(mt_rand(0, 100));
$Usage->setFrom('2015-09-15 00:00:00');
$Usage->setTo('2015-09-15 23:59:59');





//print_r($resp);

print("\n\n\n\n");
print($API->lastRequest());
print("\n\n\n\n");
print($API->lastResponse());
print("\n\n\n\n");


