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
     * @return mixed
     */
    public function check();
}