<?php

header('Content-Type: text/plain');

use ChargeOver\APIObject\Usage;
use ChargeOver\ChargeOverAPI;

require_once '../vendor/autoload.php';

//This url should be specific to your ChargeOver instance
$url = 'http://dev.chargeover.com/api/v3';
//$url = 'https://YOUR-INSTANCE-NAME.chargeover.com/api/v3';

$authmode = ChargeOverAPI::AUTHMODE_HTTP_BASIC;
$username = 'noECbNw0GDA7vtPLcuaVqJBRhUldjz38';
$password = 'B6LnuVGE74Co1TacXxHjdwk9hKtPpIW0';

$API = new ChargeOverAPI($url, $authmode, $username, $password);



$Usage = new Usage();

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


