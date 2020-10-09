<?php

namespace App\Http\Controllers;

use App\Dictionary\ReportSorts;
use App\Http\Services\EmployeesService;
use App\Models\Department;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request, EmployeesService $eService)
    {
        return view('home/index',
            [
                'employees' => $eService->getEmployees($request),
                'filters' => $request->all(),
                'departments' => Department::all(),
                'sortTypes' => ReportSorts::TYPES,
            ]
        );
    }
}
