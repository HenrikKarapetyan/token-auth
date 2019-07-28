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
     * @var string string
     *  algorithms like
     *  sha256, sha512, sha128, md5, etc.
     */
    private $algorithm;
    /**
     * @var string
     */
    private $privateKey;
    /**
     * @var string
     */
    private $token_string;

    /**
     * @var string
     */
    private $signature_string;

    /**
     * Signature constructor.
     * @param $token_string
     * @param $privateKey
     * @param string $algorithm
     */
    public function __construct($token_string, $privateKey, $algorithm = "sha512")
    {
        $this->algorithm = $algorithm;
        $this->privateKey = $privateKey;
        $this->token_string = $token_string;
    }

    /**
     * @return $this
     */
    public function generate()
    {
        $this->signature_string = hash_hmac(
            $this->algorithm,
            $this->token_string,
            $this->privateKey
        );
        return $this;
    }

    /**
     * @return string
     */
    public function getSignatureToken()
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