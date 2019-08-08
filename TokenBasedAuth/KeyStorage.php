<?php

/**
 * @author Henrik Karapetyan
 * @email HenrikKarapetyan@gmail.com
 */


namespace HashAuth;

/**
 * Class KeyStorage
 * @package HashAuth
 */
class KeyStorage
{
    /**
     * @var string
     */
    private $token_private_key;
    /**
     * @var string
     */
    private $token_private_iv;
    /**
     * @var string
     */
    private $signature_private_key;


    /**
     * @var
     */
    private $hash_algorithm;
    /**
     * @var
     */
    private $parser_algorithm;

    /**
     * @return string
     */
    public function getTokenPrivateKey(): string
    {
        return $this->token_private_key;
    }

    /**
     * @param string $token_private_key
     */
    public function setTokenPrivateKey(string $token_private_key)
    {
        $this->token_private_key = $token_private_key;
    }

    /**
     * @return string
     */
    public function getTokenPrivateIv(): string
    {
        return $this->token_private_iv;
    }

    /**
     * @param string $token_private_iv
     */
    public function setTokenPrivateIv(string $token_private_iv)
    {
        $this->token_private_iv = $token_private_iv;
    }

    /**
     * @return string
     */
    public function getSignaturePrivateKey(): string
    {
        return $this->signature_private_key;
    }

    /**
     * @param string $signature_private_key
     */
    public function setSignaturePrivateKey(string $signature_private_key)
    {
        $this->signature_private_key = $signature_private_key;
    }

    /**
     * @return mixed
     */
    public function getHashAlgorithm()
    {
        return $this->hash_algorithm;
    }

    /**
     * @param mixed $hash_algorithm
     */
    public function setHashAlgorithm($hash_algorithm): void
    {
        $this->hash_algorithm = $hash_algorithm;
    }

    /**
     * @return mixed
     */
    public function getParserAlgorithm()
    {
        return $this->parser_algorithm;
    }

    /**
     * @param mixed $parser_algorithm
     */
    public function setParserAlgorithm($parser_algorithm): void
    {
        $this->parser_algorithm = $parser_algorithm;
    }
}