<?php

namespace App\Strategies;

use App\Contracts\IPerk;
use App\Strategies\Perk;

class StaticPerk extends Perk implements IPerk
{
    /**
     * Handle calculations logic for static perk
     * @return int
     */
    public function handle(): int
    {
        return $this->getMaxAvailableYearsForPerk() * $this->model->department->perk_value;
    }
}
