<?php

namespace App\Services\Salaries;

use App\Contracts\ISalaryCalculator;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;

class BaseSalary implements ISalaryCalculator
{
    /**
     * Employee instance
     * @var \App\Models\Employee
     */
    protected $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    /**
     * Salary amount
     * @return int
     */
    public function getAmount(): int
    {
        return $this->employee->getBaseSalary()->getValue();
    }

    /**
     * Target
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getTarget(): Model
    {
        return $this->employee;
    }
}
