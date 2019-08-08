<?php

/**
 * @author Henrik Karapetyan
 * @email HenrikKarapetyan@gmail.com
 */


namespace HashAuth;

use HashAuth\Interfaces\HashGeneratorInterface;

/**
 * Class Signature
 * @package HashAuth
 */
class Signature implements HashGeneratorInterface
{

    /**
     * @var string
     */
    private $token_string;

    /**
     * @var string
     */
    private $signature_string;
    /**
     * @var KeyStorage
     */
    private $keyStorage;

    /**
     * Signature constructor.
     * @param $token_string
     * @param $keyStorage
     */
    public function __construct($token_string, $keyStorage)
    {
        $this->keyStorage = $keyStorage;
        $this->token_string = $token_string;
    }

    /**
     * @return $this
     */
    public function generate(): string
    {
        $this->signature_string = hash_hmac(
            $this->keyStorage->getHashAlgorithm(),
            $this->token_string,
            $this->keyStorage->getSignaturePrivateKey()
        );
        return $this;
    }

    /**
     * @return string
     */
    public function getSignatureToken(): string
    {
        return $this->signature_string;
    }

    /**
     * Checking is requested signature token is valid or not
     *
     * @param $token
     * @return bool
     */
    public function is_valid($token): bool
    {
        if (hash_equals($token, $this->signature_string)) {
            return true;
        }
        return false;
    }


}