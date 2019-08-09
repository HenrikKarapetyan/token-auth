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

    private $claimCollector;

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
        $parser_algorithm = Algorithms::ENCRYPT_AES_256_XTS,
        $hash_algorithm = Algorithms::HASH_SHA256
    )
    {
        $this->keyStorage = new KeyStorage();
        $this->keyStorage->setTokenPrivateKey($token_private_key);
        $this->keyStorage->setSignaturePrivateKey($signature_private_key);
        $this->keyStorage->setTokenPrivateIv($token_private_iv);
        $this->keyStorage->setParserAlgorithm($parser_algorithm);
        $this->keyStorage->setHashAlgorithm($hash_algorithm);
    }

    /**
     * @param array $claims
     */
    public function setClaims(array $claims): void
    {
        $this->claims = $this->compileClaims($claims);
    }


    /**
     * @param $data
     * @return string
     */
    public function makeToken($data)
    {
        $tokenBuilder = new TokenBuilder($this->keyStorage);
        $token = $tokenBuilder->buildToken($data, $this->claims);
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
        $tokenParser = new TokenParser($this->keyStorage, $this->claimCollector);
        $tokenParser->setRequestData($request_data_array);
        return $tokenParser->parse($token);
    }

    /**
     * @param $claims
     * @return array
     */
    private function compileClaims($claims)
    {
        $this->claimCollector = new ClaimCollector();
        $this->claimCollector->buildClaims($claims);
        return $this->claimCollector->getClaims();
    }

}