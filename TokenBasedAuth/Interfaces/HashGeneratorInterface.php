<?php

/**
 * @author Henrik Karapetyan
 * @email HenrikKarapetyan@gmail.com
 */

namespace HashAuth\Interfaces;

/**
 * Interface HashGeneratorInterface
 * @package HashAuth\Interfaces
 */
interface HashGeneratorInterface
{
    /**
     * @return mixed
     */
    public function generate();
}