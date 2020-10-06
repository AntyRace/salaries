<?php

namespace App\Strategies;

use Illuminate\Database\Eloquent\Model;

abstract class Perk
{

    /**
     * Max years to count perk
     * @var integer
     */
    public static $maxPerkYears = 10;

    /**
     * Model instance
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Max years of work that will be consider in perk calculations.
     * @return int
     */
    protected function getMaxAvailableYearsForPerk(): int
    {
        return $this->model->getYearsOfWork() > self::$maxPerkYears ? self::$maxPerkYears : $this->model->getYearsOfWork();
    }

}
