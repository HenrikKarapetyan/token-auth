<?php

/**
 * @author Henrik Karapetyan
 * @email HenrikKarapetyan@gmail.com
 */


namespace HashAuth;

use HashAuth\Claims\AbstractClaim;
use HashAuth\Exceptions\MustImplementClaimInterfaceException;
use HashAuth\Interfaces\ClaimInterface;

/**
 * Class ClaimCollector
 * @package HashAuth
 */
class ClaimCollector
{
    /**
     * @var array AbstractClaim
     */
    private $claims = [];

    /**
     * @param $id
     * @param $value
     * @throws MustImplementClaimInterfaceException
     */
    public function add($id, $value)
    {
        if ($value instanceof ClaimInterface) {
            $this->claims[$id] = $value;
        } else {
            throw new MustImplementClaimInterfaceException();
        }

    }

    /**
     * @return array AbstractClaim
     */
    public function getClaims()
    {
        return $this->claims;
    }

    public function buildClaims($claims)
    {
        foreach ($claims as $id => $claim_data) {
            try {
                $class = $claim_data[0];
                /**
                 * @var $claim_obj AbstractClaim
                 */
                $claim_obj = new $class;
                if (isset($claim_data[1])) {
                    $claim_obj->setCurrentData($claim_data[1]);
                }
                $this->claims[$id] = $claim_obj;
            } catch (\Exception $e) {
                var_dump("error in claim collector");
            }
        }
    }

    /**
     * @param $claim_parsed_data
     */
    public function checkClaims($claim_parsed_data)
    {
        foreach ($claim_parsed_data as $id => $claim_data) {
            if ($this->has($id)){
                $claim_obj = $this->claims[$id];
                $claim_obj->setPreviousData($claim_data);
                $claim_obj->check();
            }
            // TO DO raise error  when  claim id not exists
        }
    }


    private function has($id){
        return isset($this->claims[$id]);
    }
}