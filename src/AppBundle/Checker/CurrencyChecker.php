<?php

namespace AppBundle\Checker;

class CurrencyChecker extends DiscountChecker
{
    public function isValid($discount, $basket)
    {
        return true;
    }
}
