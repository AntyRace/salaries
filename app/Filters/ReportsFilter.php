<?php

namespace App\Filters;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

class ReportsFilter extends QueryFilter
{
    /**
     * Simple map to set proper SQL sort direction
     */
    const SORT_DIRECTIONS = [
        '+' => 'ASC',
        '-' => 'DESC',
    ];

    /**
     * Simple sorts
     * @var array
     */
    protected $baseSorts = [
        'first_name',
        'last_name',
        'salary',
    ];

    /**
     * Relations sorts
     * @var array
     */
    protected $callbackSorts = [
        'department' => 'sortByDepartment',
        'perk' => 'sortByPerkValue',
        'perk_type' => 'sortByPerkType',
        'total_salary' => 'sortByTotalSalary',
    ];

    /**
     * Search by first name
     * @param  string $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function first_name(string $firstName): Builder
    {
        return $this->builder->where('first_name', 'LIKE', '%' . $firstName . '%');
    }

    /**
     * Search by last name
     * @param  string $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function last_name(string $lastName): Builder
    {
        return $this->builder->where('last_name', 'LIKE', '%' . $lastName . '%');
    }

    /**
     * Search by department
     * @param  string $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function department_id(string $departmentId): Builder
    {
        return $this->builder->where('department_id', $departmentId);
    }

    /**
     * Sort method
     * @param  string $data
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function sort(string $data): Builder
    {
        $direction = substr($data, 0, 1);
        $parameter = substr($data, 1, strlen($data) - 1);

        if (!in_array($parameter, $this->baseSorts) && !in_array($parameter, array_keys($this->callbackSorts))) {
            return $this->builder;
        }

        if (in_array($parameter, array_keys($this->callbackSorts))) {
            $method = $this->callbackSorts[$parameter];
            return $this->$method(static::SORT_DIRECTIONS[$direction]);
        }

        return $this->builder->orderBy($parameter, static::SORT_DIRECTIONS[$direction]);
    }

    /**
     * Sort by relation department name
     * @param  string $direction
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function sortByDepartment(string $direction): Builder
    {
        return $this->builder->orderBy('departments.name', $direction);
    }

    /**
     * Sort by relation department perk type
     * @param  string $direction
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function sortByPerkType(string $direction): Builder
    {
        return $this->builder->orderBy('departments.perk_type', $direction);
    }

    /**
     * Sort by relation salaries perk value
     * @param  string $direction
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function sortByPerkValue(string $direction): Builder
    {
        return $this->builder->orderBy('salaries.perk', $direction);
    }

    /**
     * Sort by relation salaries wage value
     * @param  string $direction
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function sortByTotalSalary(string $direction): Builder
    {
        return $this->builder->orderBy('salaries.wage', $direction);
    }
}
