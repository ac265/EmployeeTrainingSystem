<?php

namespace App\Http\Controllers;

use App\Services\EmployeeApiService;
use Illuminate\Http\JsonResponse;
use Throwable;

class EmployeeController extends Controller
{
    public function index(EmployeeApiService $employeeApi)
    {
        try {
            $employees = $employeeApi->getEmployees();

            $trainings = \App\Models\Training::latest()->get();

            return view('employees.index', compact(
                'employees',
                'trainings'
            ));
        } catch (\Throwable $e) {
            return view('employees.index', [
                'employees' => [],
                'trainings' => \App\Models\Training::latest()->get(),
                'error' => 'Employee API connection failed.'
            ]);
        }
    }
}
