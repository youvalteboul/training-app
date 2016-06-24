<?php

namespace AppBundle\Manager;

use AppBundle\Checker\DiscountChecker;

class DiscountManager
{
    protected $discountCheckers;

    public function addDiscountChecker(DiscountChecker $discountChecker)
    {
        $this->discountCheckers[] = $discountChecker;
    }

    public function validateDiscount($discount, $basket)
    {
        foreach ($this->discountCheckers as $checker) {
            if (!$checker->isValid($discount, $basket)) {
                throw new \Exception("Voucher can't be applied on this basket");
            }
        }

        return true;
    }
}

