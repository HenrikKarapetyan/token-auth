<?php

/**
 * @author Henrik Karapetyan
 * @email HenrikKarapetyan@gmail.com
 */

namespace HashAuth\Claims;


use HashAuth\Exceptions\TokenExpiredException;
use HashAuth\Interfaces\ClaimInterface;

/**
 * Class ExpClaim
 * @package HashAuth\Claims
 */
class ExpClaim implements ClaimInterface
{
    /**
     * @param $token_stored_value
     * @param $value
     * @return mixed|TokenExpiredException
     * @throws TokenExpiredException
     */
    public function check($token_stored_value, $value)
    {
        if ($token_stored_value < $value) {
            throw new TokenExpiredException('the token is expired');
        }
        return true;

    }
}