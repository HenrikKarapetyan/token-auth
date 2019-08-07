<?php
/**
 * @author Henrik Karapetyan
 * @email HenrikKarapetyan@gmail.com
 */


namespace HashAuth;

/**
 * @author Henrik Karapetyan
 */

use Exception;
use HashAuth\Exceptions\ClaimNotExistsException;
use HashAuth\Exceptions\HashAuthException;
use HashAuth\Exceptions\InvalidTokenDataException;
use HashAuth\Interfaces\ClaimInterface;
use HashAuth\Interfaces\TokenParserInterface;

/**
 * Class TokenParser
 * @package HashAuth
 */
class TokenParser extends AbstractToken implements TokenParserInterface
{
    /**
     * @var string
     */
    private $validated_token;

    /**
     * @var KeyStorage
     */
    private $keyStorage;

    public function __construct(KeyStorage $keyStorage)
    {
        $this->keyStorage = $keyStorage;
    }

    /**
     * @param $token
     * @return string
     * @throws ClaimNotExistsException
     * @throws Exception
     */
    public function parse($token)
    {
        $this->validated_token = $this->validate($token);
        return $this->parseToken($this->validated_token);
    }

    /**
     * @param $token
     * @return mixed
     * @throws Exception
     */
    private function validate($token)
    {
        $droped_tokens = explode('-', $token);
        if (count($droped_tokens) < 2) {
            throw new HashAuthException("invalid token");
        }
        $data_token = $droped_tokens[0];
        $signature_token = $droped_tokens[1];
        $this->checkSignatureToken($data_token, $signature_token);
        return $data_token;
    }

    /**
     * @param $data_token
     * @param $signature_token
     * @throws Exception
     */
    private function checkSignatureToken($data_token, $signature_token)
    {
        $signature = new Signature($data_token, $this->keyStorage->getSignaturePrivateKey());
        if (!$signature->generate()->is_valid($signature_token)) {
            throw new InvalidTokenDataException("invalid token data");
        }
    }

    /**
     * @param $validated_token
     * @return mixed
     * @throws ClaimNotExistsException
     */
    public function parseToken($validated_token)
    {
        $input_token = base64_decode($validated_token);
        $data_with_claims_line = openssl_decrypt(
            $input_token,
            $this->algorithm,
            $this->keyStorage->getTokenPrivateKey(),
            0,
            $this->keyStorage->getTokenPrivateIv()
        );
        $data_with_claims_object = json_decode($data_with_claims_line);
        $this->checkClaims($data_with_claims_object->claims);
        return $data_with_claims_object->data;
    }


    /**
     * @param $claims
     * @throws ClaimNotExistsException
     */
    private function checkClaims($claims)
    {
        foreach ($claims as $claim => $value) {
            $claim_class = "\\HashAuth\\Claims\\" . ucfirst($claim) . "Claim";
            try{
                if (isset($this->request_data[$claim])) {
                    /**
                     * @var $object ClaimInterface
                     */
                        $object = new $claim_class();
                        $object->check($value, $this->request_data[$claim]);
                } else {
                    throw new ClaimNotExistsException("the {$claim} not exists in request data array");
                }
            }catch (ClaimNotExistsException $e){
                // ignore if claim id not exist's 
            }

        }
    }

    /**
     * @return array
     */
    public function getRequestData(): array
    {
        return $this->request_data;
    }

    /**
     * @param array $request_data
     * @return $this
     */
    public function setRequestData(array $request_data)
    {
        $this->request_data = $request_data;
        return $this;
    }


}