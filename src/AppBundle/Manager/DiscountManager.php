<?php

namespace AppBundle\Manager;

use AppBundle\Service\Checker\CheckerInterface;

class DiscountManager
{
    protected $checkers;
    
    public function addDiscountChecker(CheckerInterface $checker)
    {
        $this->checkers[] = $checker;
    }

    public function validateDiscount($discount, $basket)
    {
        foreach ($this->checkers as $checker) {
            if ( !$checker->isValid($discount, $basket) ) {
                throw new \Exception("Voucher can't be used on this basket");
            }
        }
    }
}