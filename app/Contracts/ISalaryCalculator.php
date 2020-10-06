<?php

namespace App\Contracts;

interface ISalaryCalculator
{
    public function getAmount();
    public function getTarget();
}
