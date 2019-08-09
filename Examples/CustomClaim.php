<?php


namespace Examples;


use HashAuth\Claims\AbstractClaim;
use Exception;

class CustomClaim extends AbstractClaim
{

    /**
     * @return mixed
     */
    public function check()
    {
        if ($this->current_data == $this->previous_data) {
            // TODO do something
        }
    }
}