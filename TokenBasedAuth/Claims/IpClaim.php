<?php
/**
 * @author Henrik Karapetyan
 * @email HenrikKarapetyan@gmail.com
 */

namespace HashAuth\Claims;


use HashAuth\Exceptions\IpNotMatchedException;

/**
 * Class IpClaim
 * @package HashAuth\Claims
 */
class IpClaim extends AbstractClaim
{
    /**
     * @return bool|mixed
     * @throws IpNotMatchedException
     */
    public function check()
    {
        if ($this->previous_data !== $this->current_data) {
            throw new IpNotMatchedException("the requested ip not matched  with token ip");
        }
        return true;
    }
}