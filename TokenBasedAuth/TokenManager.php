<?php

/**
 * @author Henrik Karapetyan
 * @email HenrikKarapetyan@gmail.com
 */

namespace HashAuth;


use DateTime;

/**
 * Class TokenManager
 * @package HashAuth
 */
class TokenManager
{
    /**
     * @var array
     */
    private $claims = [];

    private $keyStorage;

    /**
     * TokenManager constructor.
     * @param $token_private_key
     * @param $token_private_iv
     * @param $signature_private_key
     * @param string $parser_algorithm
     * @param string $hash_algorithm
     * @throws \Exception
     */
    public function __construct(
        $token_private_key,
        $token_private_iv,
        $signature_private_key,
        $parser_algorithm = Algorithms::ENCRYPT_AES_256_CTR,
        $hash_algorithm = Algorithms::HASH_SHA256)
    {
        $this->keyStorage = new KeyStorage();
        $this->keyStorage->setTokenPrivateKey($token_private_key);
        $this->keyStorage->setSignaturePrivateKey($signature_private_key);
        $this->keyStorage->setTokenPrivateIv($token_private_iv);
        $this->keyStorage->setParserAlgorithm($parser_algorithm);
        $this->keyStorage->setHashAlgorithm($hash_algorithm);
        /**
         * initializing default claim's for token builder
         */
        $this->claims = [
            'exp' => (new DateTime())->getTimestamp() + (2 * 60 * 60),
            'sessId' => rand(),
        ];
    }

    /**
     * @param $data
     * @param array $claims
     * @return string
     */
    public function makeToken($data, $claims = [])
    {
        $claims = array_merge($this->claims, $claims);

        $tokenBuilder = new TokenBuilder($this->keyStorage);
        $token = $tokenBuilder->buildToken($data, $claims);
        return $token;
    }

    /**
     * @param $token
     * @param $request_data_array
     * @return string
     * @throws \Exception
     */
    public function parseToken($token, $request_data_array)
    {
        $tokenParser = new TokenParser($this->keyStorage);
        $tokenParser->setRequestData($request_data_array);
        return $tokenParser->parse($token);
    }

}