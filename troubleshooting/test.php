<?php

header('Content-Type: text/plain');

$ch = curl_init('https://how-late.chargeover.com/api/v3/customer');

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'TLSv1');

curl_setopt($ch, CURLOPT_VERBOSE, true);

$out = curl_exec($ch);

print('[[[' . $out . ']]]');

print_r(curl_getinfo($ch));