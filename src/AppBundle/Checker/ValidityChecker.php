<?php

namespace AppBundle\Checker;

class ValidityChecker extends DiscountChecker
{
    public function isValid($discount, $basket)
    {
        return true;
    }
}
