<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Department::factory(10)->create()->each(function ($department) {
            $department->employees()->saveMany(Employee::factory(20)->create([
                'department_id' => $department->id,
            ]));
        });

    }
}
