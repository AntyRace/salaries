<?php

namespace Database\Factories;

use App\Dictionary\Perk;
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
            'name' => $this->faker->jobTitle,
            'perk_type' => $this->faker->randomElement(Perk::TYPES),
            'perk_value' => $this->faker->numberBetween(1, 30),
        ];
    }
}
