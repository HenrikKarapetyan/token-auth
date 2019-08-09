<?php

/**
 * @author Henrik Karapetyan
 * @email HenrikKarapetyan@gmail.com
 */

namespace HashAuth\Claims;


use HashAuth\Exceptions\TokenExpiredException;

/**
 * Class ExpClaim
 * @package HashAuth\Claims
 */
class ExpClaim extends AbstractClaim
{
    /**
     * @return bool|mixed
     * @throws TokenExpiredException
     */
    public function check()
    {
        if ($this->previous_data < $this->current_data) {
            throw new TokenExpiredException('the token is expired');
        }
        return true;

    }
}