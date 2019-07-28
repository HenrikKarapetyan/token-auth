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
     * @throws \Exception
     */
    public function __construct($token_private_key, $token_private_iv, $signature_private_key)
    {
        $this->keyStorage = new KeyStorage();
        $this->keyStorage->setTokenPrivateIv($token_private_key);
        $this->keyStorage->setSignaturePrivateKey($signature_private_key);
        $this->keyStorage->setTokenPrivateIv($token_private_iv);
        $this->claims = [
            'exp' => (new DateTime())->getTimestamp() + (2 * 60 * 60),
            'sessId' => rand(),
        ];
    }

    /**
     * @param $data
     * @param array $claims
     */
    public function makeToken($data, $claims = [])
    {
        $claims = array_merge($this->claims, $claims);
        (new TokenBuilder($this->keyStorage))->buildToken($data, $claims);
    }

    /**
     * @param $token
     * @param $request_data_array
     * @return string
     * @throws \Exception
     */
    public function parseToke($token, $request_data_array)
    {
        $tokenParser = new TokenParser($this->keyStorage);
        $tokenParser->setRequestData($request_data_array);
        return $tokenParser->parse($token);
    }

}