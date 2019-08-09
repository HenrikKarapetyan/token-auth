<?php
/**
 * @author Henrik Karapetyan
 * @email HenrikKarapetyan@gmail.com
 */

namespace HashAuth\Claims;


use HashAuth\Exceptions\BrowserNotMatchedException;

/**
 * Class BrowserIdAbstractClaim
 * @package HashAuth\Claims
 */
class BrowserIdClaim extends AbstractClaim
{
    /**
     * @return bool|mixed
     * @throws BrowserNotMatchedException
     */
    public function check()
    {

        if ($this->previous_data !== $this->current_data) {
            throw new BrowserNotMatchedException("the browsers not matched");
        }
        return true;

    }
}