<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Department::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->companySuffix,
            'perk_type' => $this->faker->randomElement(['percentage', 'static']),
            'perk_value' => $this->faker->numberBetween(1, 5) * 10,
        ];
    }
}
