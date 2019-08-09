<?php

/**
 * @author Henrik Karapetyan
 * @email HenrikKarapetyan@gmail.com
 */

namespace HashAuth\Claims;

use HashAuth\Interfaces\ClaimInterface;

/**
 * Class AbstractClaim
 * @package HashAuth
 */
abstract class AbstractClaim implements ClaimInterface
{
    /**
     * @var
     */
    protected $current_data;
    /**
     * @var
     */
    protected $previous_data;

    /**
     * @param $data
     */
    public function setCurrentData($data)
    {
        $this->current_data = $data;
    }


    /**
     * @param $data
     */
    public function setPreviousData($data)
    {
        $this->previous_data = $data;
    }

    /**
     * @return mixed
     */
    public function exportCurrentData(){
        return $this->current_data;
    }

}