<?php

namespace AppBundle\Service\Checker;

interface CheckerInterface
{
    public function isValid($discount, $basket);

}