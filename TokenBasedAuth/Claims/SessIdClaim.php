<?php

/**
 * @author Henrik Karapetyan
 * @email HenrikKarapetyan@gmail.com
 */

namespace HashAuth\Claims;



/**
 * Class SessIdClaim
 * @package HashAuth\Claims
 */
class SessIdClaim extends AbstractClaim
{
    /**
     * @return bool|mixed
     */
    public function check()
    {
        return true;
    }
}