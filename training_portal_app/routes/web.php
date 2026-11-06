<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\AssignmentController;

Route::get('/', function () {
    return redirect()->route('trainings.index');
});

Route::get('/trainings', [TrainingController::class, 'index'])
    ->name('trainings.index');

Route::post('/trainings', [TrainingController::class, 'store'])
    ->name('trainings.store');

Route::put('/trainings/{training}', [TrainingController::class, 'update'])
    ->name('trainings.update');

Route::delete('/trainings/{training}', [TrainingController::class, 'destroy'])
    ->name('trainings.destroy');

Route::get('/trainings/{training}/assignments', [AssignmentController::class, 'index'])
    ->name('assignments.index');

Route::post('/trainings/{training}/assignments', [AssignmentController::class, 'store'])
    ->name('assignments.store');

Route::get('/employees', [EmployeeController::class, 'index'])
    ->name('employees.index');

Route::post('/employees/assign-training', [
    AssignmentController::class,
    'assignToEmployee'
])->name('employees.assign-training');

Route::patch('/assignments/{assignment}/status', [AssignmentController::class, 'updateStatus'])
    ->name('assignments.status');

Route::delete('/assignments/{assignment}', [AssignmentController::class, 'destroy'])
    ->name('assignments.destroy');
