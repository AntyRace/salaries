<?php

namespace App\Models;

use App\ValueObjects\Price;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['employee_id', 'wage', 'perk', 'salary_date'];

    /**
     * Salary as object
     * @return \App\ValueObjects\Price
     */
    public function getMonthlySalary(): Price
    {
        return new Price($this->wage ?? 0);
    }

    /**
     * Perk as object
     * @return \App\ValueObjects\Price
     */
    public function getPerk(): Price
    {
        return new Price($this->perk ?? 0);
    }
}
