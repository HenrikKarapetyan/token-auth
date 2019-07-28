<?php

/**
 * @author Henrik Karapetyan
 * @email HenrikKarapetyan@gmail.com
 */

namespace HashAuth;

use HashAuth\Interfaces\TokenBuilderInterface;

/**
 * Class TokenBuilder
 * @package HashAuth
 */
class TokenBuilder implements TokenBuilderInterface
{
    /**
     * @var KeyStorage
     */
    private $keyStorage;

    /**
     * TokenBuilder constructor.
     * @param KeyStorage $keyStorage
     */
    public function __construct(KeyStorage $keyStorage)
    {
        $this->keyStorage = $keyStorage;
    }

    /**
     * @param $data
     * @param $claims
     * @return string
     */
    public function buildToken($data, $claims)
    {
        $data_line = [];
        $data_line['data'] = $data;
        $data_line['claims'] = $claims;
        $json_line = json_encode($data_line);
        $token = new Token($this->keyStorage);
        $token->setDataLine($json_line);

        $token_string = $token->generate()->getGeneratedToken();
        $signature = new Signature(
            $token_string,
            $this->keyStorage->getSignaturePrivateKey()
        );
        $signature_token = $signature->generate()->getSignatureToken();
        return $token_string . '-' . $signature_token;
    }
}