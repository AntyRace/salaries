<?php

namespace App\Dictionary;

class ReportSorts
{
    /**
     * Reports sorts types
     */
    const TYPES = [
        '+first_name' => 'First name ASC',
        '-first_name' => 'First name DESC',
        '+last_name' => 'Last name ASC',
        '-last_name' => 'Last name DESC',
        '+department' => 'Department ASC',
        '-department' => 'Department DESC',
        '+salary' => 'Base salary ASC',
        '-salary' => 'Base salary DESC',
        '+perk' => 'Perk value ASC',
        '-perk' => 'Perk value DESC',
        '+perk_type' => 'Perk type ASC',
        '-perk_type' => 'Perk type DESC',
        '+total_salary' => 'Total salary ASC',
        '-total_salary' => 'Total salary DESC',
    ];
}
