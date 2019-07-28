<?php
/**
 * @author Henrik Karapetyan
 * @email HenrikKarapetyan@gmail.com
 */

namespace HashAuth\Interfaces;

/**
 * Interface ClaimInterface
 * @package HashAuth\Interfaces
 */
interface ClaimInterface
{
    /**
     * @param $token_stored_value
     * @param $value
     * @return mixed
     */
    public function check($token_stored_value, $value);
}