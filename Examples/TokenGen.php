<?php


require "../vendor/autoload.php";
const SIGNATURE_PRIVATE_KEY = "secret1sdfsfsdfsdfsdf";
const TOKEN_PRIVATE_IV = "secret-secret123";
const TOKEN_PRIVATE_KEY = "secret3sdfsdfsdfsdfsdfsdf";

$start = microtime(true);

for ($i = 0; $i < 10000; $i++) {

    $tokenManager = new \HashAuth\TokenManager(
        TOKEN_PRIVATE_KEY,
        TOKEN_PRIVATE_IV,
        SIGNATURE_PRIVATE_KEY,
        \HashAuth\Algorithms::ENCRYPT_AES_256_XTS,
        \HashAuth\Algorithms::HASH_SHA256
    );

    $token = $tokenManager->makeToken([
        'id' => 1,
        'name' => "Demo",
        'last_name' => "Demo"
    ], ['sessId' => rand(1, 100000)]);
    var_dump($i, $token);
//    $data = $tokenManager->parseToken($token, []);
//    var_dump($i, json_encode($data), $token);
}

var_dump("elapsed time",$time_elapsed_secs = microtime(true) - $start);
