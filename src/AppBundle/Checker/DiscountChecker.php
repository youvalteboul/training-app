<?php

namespace AppBundle\Checker;

abstract class DiscountChecker
{
    abstract public function isValid($discount, $basket);
}
