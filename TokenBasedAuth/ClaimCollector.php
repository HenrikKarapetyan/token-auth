<?php

/**
 * @author Henrik Karapetyan
 * @email HenrikKarapetyan@gmail.com
 */


namespace HashAuth;

/**
 * Class ClaimCollector
 * @package HashAuth
 */
class ClaimCollector
{
    /**
     * @var array Claim
     */
    private $claims = [];

    /**
     * @param $name
     * @param $value
     */
    public function add($name, $value)
    {
        $this->claims[$name] = new Claim($value);
    }

    /**
     * @return array Claim
     */
    public function getClaims()
    {
        return $this->claims;
    }

}