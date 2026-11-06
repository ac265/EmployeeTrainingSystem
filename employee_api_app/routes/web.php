
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeWebController;

Route::get('/', [EmployeeWebController::class, 'index'])
    ->name('employees.index');

Route::post('/employees', [EmployeeWebController::class, 'store'])
    ->name('employees.store');

Route::put('/employees/{employee}', [EmployeeWebController::class, 'update'])
    ->name('employees.update');

Route::delete('/employees/{employee}', [EmployeeWebController::class, 'destroy'])
    ->name('employees.destroy');
