<?php

/**
 * @author Henrik Karapetyan
 * @email HenrikKarapetyan@gmail.com
 */

namespace HashAuth\Interfaces;

/**
 * Class TokenParserInterface
 * @package HashAuth\Interfaces
 */
interface TokenParserInterface
{
    /**
     * @param $token
     * @return mixed
     */
    public function parse($token);

}