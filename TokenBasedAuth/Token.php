<?php

/**
 * @author Henrik Karapetyan
 * @email HenrikKarapetyan@gmail.com
 */


namespace HashAuth;

use HashAuth\Interfaces\HashGeneratorInterface;

/**
 * Class Token
 * @package HashAuth
 */
class Token extends AbstractToken implements HashGeneratorInterface
{

    private $keyStorage;

    /**
     * Token constructor.
     * @param KeyStorage $keyStorage
     */
    public function __construct(KeyStorage $keyStorage)
    {
        $this->keyStorage = $keyStorage;
    }


    /**
     * @return $this
     */
    public function generate()
    {
        $output = openssl_encrypt(
            $this->data_line,
            $this->algorithm,
            $this->keyStorage->getTokenPrivateKey(),
            0, $this->keyStorage->getTokenPrivateIv());
        $this->generated_token = base64_encode($output);
        return $this;
    }

    /**
     * @return string
     */
    public function getGeneratedToken()
    {
        return $this->generated_token;
    }

}
