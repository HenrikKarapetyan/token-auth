<?php

/**
 * @author Henrik Karapetyan
 * @email HenrikKarapetyan@gmail.com
 */

namespace HashAuth\Interfaces;

/**
 * Interface TokenBuilderInterface
 * @package HashAuth\Interfaces
 */
interface TokenBuilderInterface
{
    /**
     * @param $data
     * @param $claims
     * @return mixed
     */
    public function buildToken($data, $claims);
}