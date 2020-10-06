<?php

namespace App\Services\Salaries;

use App\Contracts\ISalaryCalculator;
use App\Dictionary\Perk;
use App\Strategies\PercentagePerk;
use App\Strategies\StaticPerk;
use Illuminate\Database\Eloquent\Model;

class SalaryPerk implements ISalaryCalculator
{
    /**
     * Salary calculator instance
     * @var \App\Contracts\ISalaryCalculator
     */
    protected $calculator;

    public function __construct(ISalaryCalculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function getAmount(): int
    {
        return $this->calculator->getAmount() + $this->getStrategy($this->getTarget())->handle();
    }

    public function getTarget()
    {
        return $this->calculator->getTarget();
    }

    public function getStrategy(Model $model)
    {
        if ($model->department->perk_type == Perk::TYPE_STATIC) {
            return new StaticPerk($model);
        }

        return new PercentagePerk($model);
    }

}
