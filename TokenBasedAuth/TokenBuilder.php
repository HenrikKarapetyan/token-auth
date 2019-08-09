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
        foreach ($claims as $id => $claim_obj){
            $data_line['claims'][$id] = $claim_obj->exportCurrentData();
        }
        $token = new Token($this->keyStorage);
        $token->setDataLine($data_line);

        $token_string = $token->generate()->getGeneratedToken();
        $signature = new Signature(
            $token_string,
            $this->keyStorage
        );
        $signature_token = $signature->generate()->getSignatureToken();
        return $token_string . '-' . $signature_token;
    }
}