<?php


require "../vendor/autoload.php";
const SIGNATURE_PRIVATE_KEY = "secret1sdfsfsdfsdfsdf";
const TOKEN_PRIVATE_IV = "secret-secret123"; // this must contain 16 symbols.
const TOKEN_PRIVATE_KEY = "secret3sdfsdfsdfsdfsdfsdf";

$start = microtime(true);

for ($i = 0; $i < 10000; $i++) {

    $tokenManager = new \HashAuth\TokenManager(
        TOKEN_PRIVATE_KEY,
        TOKEN_PRIVATE_IV,
        SIGNATURE_PRIVATE_KEY,
        \HashAuth\Algorithms::ENCRYPT_AES_256_CTR,
        \HashAuth\Algorithms::HASH_SHA512
    );

    $token = $tokenManager->makeToken([
        'id' => 1,
        'name' => "Demo",
        'last_name' => "Demo"
    ], ['sessId' => rand(1, 10000000)]);
    echo $i.$token."\n";
//    $data = $tokenManager->parseToken($token, []);
//    var_dump($i, json_encode($data), $token);
}

echo "elapsed time".$time_elapsed_secs = microtime(true) - $start;
