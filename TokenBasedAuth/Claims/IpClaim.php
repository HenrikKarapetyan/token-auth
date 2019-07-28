<?php
/**
 * @author Henrik Karapetyan
 * @email HenrikKarapetyan@gmail.com
 */

namespace HashAuth\Claims;


use HashAuth\Exceptions\IpNotMatchedException;
use HashAuth\Interfaces\ClaimInterface;

/**
 * Class IpClaim
 * @package HashAuth\Claims
 */
class IpClaim implements ClaimInterface
{
    /**
     * @param $token_stored_value
     * @param $value
     * @return mixed|bool
     * @throws IpNotMatchedException
     */
    public function check($token_stored_value, $value)
    {
        if ($token_stored_value !== $value) {
            throw new IpNotMatchedException("the requested ip not matched  with token ip");
        }
        return true;
    }
}