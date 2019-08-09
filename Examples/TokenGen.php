<?php


require "../vendor/autoload.php";
const SIGNATURE_PRIVATE_KEY = "sdsdfsdfsdfsdfsdfs38748347587345734757dg7d9f7g7dfg79d7g89d9g7df7g32478";
const TOKEN_PRIVATE_IV = "5sNbFTZSS30aSB3F";
const TOKEN_PRIVATE_KEY = "*()&&A*DASDW&*W&*ENKJSDfu89wjewr08)W*(EEWDSEDdfsdf46d4f4f1sdf31sd6f4rwer64s6df";

$start = microtime(true);

for ($i = 0; $i < 10000; $i++) {

    $tokenManager = new \HashAuth\TokenManager(
        TOKEN_PRIVATE_KEY,
        TOKEN_PRIVATE_IV,
        SIGNATURE_PRIVATE_KEY,
        "AES-192-CTR",
        \HashAuth\Algorithms::HASH_SHA256
    );

    $token = $tokenManager->makeToken([
        'id' => 1,
        'name' => "Demo",
        'last_name' => "Demo"
    ], ['sessId' => rand(1, 100000)]);
    $data = $tokenManager->parseToken($token, []);
    var_dump($i, json_encode($data), $token);
}

var_dump("elapsed time",$time_elapsed_secs = microtime(true) - $start);
