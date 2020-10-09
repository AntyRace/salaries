<?php

namespace App\Models;

use App\Models\Department;
use App\Models\Salary;
use App\Traits\Filterable;
use App\ValueObjects\Price;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'salary', 'department_id', 'employed_sice'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['department', 'salaries'];

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Define a one-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function salaries(): HasMany
    {
        return $this->hasMany(Salary::class);
    }

    /**
     * Last salary
     * @return \App\Models\Salary
     */
    public function getLastSalary():  ? Salary
    {
        return $this->salaries->last();
    }

    /**
     * Salary as object
     * @return \App\ValueObjects\Price
     */
    public function getBaseSalary() : Price
    {
        return new Price($this->salary ?? 0);
    }

    /**
     * Get how many years employee works in company
     * @return int
     */
    public function getYearsOfWork(): int
    {
        return Carbon::now()->startOfMonth()->diffInYears($this->employed_since);
    }

    /**
     * Check if employee has salary for selected date
     * @param  \Carbon\Carbon  $date
     * @return boolean
     */
    public function hasSalaryForDate(Carbon $date): bool
    {
        return $this->salaries->where('salary_date', $date)->count() > 0;
    }

    /**
     * Check if user doesn't have salary for selected date
     * @param  \Carbon\Carbon $date
     * @return bool
     */
    public function doesntHaveSalaryForDate(Carbon $date): bool
    {
        return !$this->hasSalaryForDate($date);
    }
}
