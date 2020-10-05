<?php

namespace App\Models;

use App\Models\Department;
use App\Models\Salary;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

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
    protected $with = ['department'];

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
     * Get how many years employee works in company
     * @return int
     */
    public function getYearsOfWork(Carbon $date = null): int
    {
        $date = $date ?? Carbon::now()->startOfMonth();
        return $date->diffInYears($this->employed_since);
    }

    public function hasSalaryForDate(Carbon $date): bool
    {
        return $this->salaries()->where('salary_date', $date)->count() > 0;
    }

    public function doesntHaveSalaryForDate(Carbon $date): bool
    {
        return !$this->hasSalaryForDate($date);
    }

}
