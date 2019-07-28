<?php

/**
 * @author Henrik Karapetyan
 * @email HenrikKarapetyan@gmail.com
 */
namespace HashAuth\Claims;


use HashAuth\Interfaces\ClaimInterface;

/**
 * Class SessIdClaim
 * @package HashAuth\Claims
 */
class SessIdClaim implements ClaimInterface
{
    /**
     * @param $token_stored_value
     * @param $value
     * @return mixed|void
     */
    public function check($token_stored_value, $value)
    {
        return true;
    }
}