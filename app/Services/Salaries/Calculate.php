<?php

namespace App\Services\Salaries;

use App\Models\Employee;
use App\Services\Salaries\BaseSalary;
use App\Services\Salaries\SalaryPerk;
use Carbon\Carbon;

class Calculate
{
    /**
     * Handle main loop
     * @return void
     */
    public function handle(): void
    {
        $employees = Employee::all();
        $date = Carbon::now()->startOfMonth();

        foreach ($employees as $employee) {
            if ($employee->doesntHaveSalaryForDate($date)) {
                $result = (new SalaryPerk(new BaseSalary($employee)))->getAmount();
                $employee->salaries()->create([
                    'salary' => $result,
                    'perk' => $result - $employee->getBaseSalary()->getValue(),
                    'salary_date' => $date,
                ]);
            }
        }

    }

}
