<?php

namespace App\Strategies;

use App\Contracts\IPerk;
use App\Strategies\Perk;

class PercentagePerk extends Perk implements IPerk
{
    /**
     * Handle perk calculations for static strategy
     * @return int
     */
    public function handle(): int
    {
        return (($this->model->getBaseSalary()->getValue() * $this->model->department->perk_value) / 100);
    }
}
