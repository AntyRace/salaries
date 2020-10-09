<?php

namespace App\Http\Services;

use App\Filters\ReportsFilter;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class EmployeesService
{
    /**
     * Service filter
     * @var \App\Filters\ReportsFilter
     */
    private $filter;

    public function __construct(ReportsFilter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * Get all employees with additional data
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Support\Collection
     */
    public function getEmployees(Request $request): Collection
    {
        $date = Carbon::now()->startOfMonth();
        return Employee::join('departments', 'employees.department_id', '=', 'departments.id')
            ->join('salaries', function ($join) use ($date) {
                $join->on('employees.id', '=', 'salaries.employee_id')
                    ->where('salaries.salary_date', $date);
            })
            ->filter($this->filter)
            ->get();
    }

}
