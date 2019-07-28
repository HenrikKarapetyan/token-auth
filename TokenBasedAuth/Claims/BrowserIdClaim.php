<?php
/**
 * @author Henrik Karapetyan
 * @email HenrikKarapetyan@gmail.com
 */

namespace HashAuth\Claims;


use HashAuth\Exceptions\BrowserNotMatchedException;
use HashAuth\Interfaces\ClaimInterface;

/**
 * Class BrowserIdClaim
 * @package HashAuth\Claims
 */
class BrowserIdClaim implements ClaimInterface
{
    /**
     * @param $token_stored_value
     * @param $value
     * @return bool|BrowserNotMatchedException
     * @throws BrowserNotMatchedException
     */
    public function check($token_stored_value, $value)
    {

        if ($token_stored_value !== $value) {
            throw new BrowserNotMatchedException("the browsers not matched");
        }
        return true;

    }
}