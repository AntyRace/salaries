<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'salary' => $this->faker->numberBetween(1000, 2000) * 100,
            'employed_since' => $this->faker->dateTimeBetween($startDate = '-15 years', $endDate = '-1 year'),
        ];
    }
}
