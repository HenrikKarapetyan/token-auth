<?php


require "../vendor/autoload.php";
const SIGNATURE_PRIVATE_KEY = "secret1sdfsfsdfsdfsdf";
const TOKEN_PRIVATE_IV = "secret-secret123"; // this must contain 16 symbols.
const TOKEN_PRIVATE_KEY = "secret3sdfsdfsdfsdfsdfsdf";

$start = microtime(true);

for ($i = 0; $i < 1; $i++) {

    $claims_for_creation = [
        'exp' => [\HashAuth\Claims\ExpClaim::class, (new DateTime())->getTimestamp() + (2 * 60 * 60), (new DateTime())->getTimestamp()],
        'sessId' => [\HashAuth\Claims\SessIdClaim::class, 'Browser', 'Browser'],
        'custom' => [\Examples\CustomClaim::class, 'hello', 'hello']
    ];

    $claims_for_validation = [
        'exp' => [\HashAuth\Claims\ExpClaim::class, (new DateTime())->getTimestamp()],
        'sessId' => [\HashAuth\Claims\SessIdClaim::class, 'Browser'],
        'custom' => [\Examples\CustomClaim::class, 'hello']
    ];

    $tokenManager = new \HashAuth\TokenManager(
        TOKEN_PRIVATE_KEY,
        TOKEN_PRIVATE_IV,
        SIGNATURE_PRIVATE_KEY,
        \HashAuth\Algorithms::ENCRYPT_AES_256_CTR,
        \HashAuth\Algorithms::HASH_SHA256
    );
    $tokenManager->setClaims($claims_for_creation);

    $token = $tokenManager->makeToken([
        'id' => 1
    ]);
    echo $i . $token . "\n";
    $tokenManager->setClaims($claims_for_validation);
    $data = $tokenManager->parseToken($token, []);
    var_dump($i. "\t".json_encode($data)."\t". $token);
}

echo "elapsed time" . $time_elapsed_secs = microtime(true) - $start;
