<?php

/**
 * @author Henrik Karapetyan
 * @email HenrikKarapetyan@gmail.com
 */

namespace HashAuth;

use HashAuth\Interfaces\ClaimInterface;

/**
 * Class Claim
 * @package HashAuth
 */
class Claim implements ClaimInterface
{
    /**
     * @var string
     */
    private $value;

    /**
     * Claim constructor.
     * @param $name
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }


    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }


    public function check($request, $value)
    {
        echo $this->value . "checked \n";
    }
}