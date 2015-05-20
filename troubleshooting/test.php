<?php

header('Content-Type: text/plain');

$ch = curl_init('https://demo.chargeover.com/api/v3/customer');

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'TLSv1');

curl_setopt($ch, CURLOPT_VERBOSE, true);

$fp = fopen('php://output', 'w+');
curl_setopt($ch, CURLOPT_STDERR, $fp);

$out = curl_exec($ch);

print('[[[' . $out . ']]]');

print_r(curl_getinfo($ch));