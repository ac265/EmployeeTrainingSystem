<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\EmployeeTraining;
use App\Services\EmployeeApiService;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index(
        Training $training,
        EmployeeApiService $employeeApi
    ) {
        $employees = $employeeApi->getEmployees();

        $assignments = $training->employeeTrainings()
            ->latest()
            ->get();

        return view('assignments.index', compact(
            'training',
            'employees',
            'assignments'
        ));
    }

    public function store(
        Request $request,
        Training $training,
        EmployeeApiService $employeeApi
    ) {
        $validated = $request->validate([
            'employee_id' => 'required|integer',
        ]);

        $employees = $employeeApi->getEmployees();

        $employeeExists = collect($employees)->contains(
            fn($employee) => (int) $employee['id'] ===
                (int) $validated['employee_id']
        );

        if (!$employeeExists) {
            return back()->withErrors([
                'employee_id' => 'Selected employee does not exist.'
            ]);
        }

        $alreadyAssigned = EmployeeTraining::where(
            'training_id',
            $training->id
        )->where(
            'employee_id',
            $validated['employee_id']
        )->exists();

        if ($alreadyAssigned) {
            return back()->withErrors([
                'employee_id' => 'This training is already assigned to this employee.'
            ]);
        }

        EmployeeTraining::create([
            'employee_id' => $validated['employee_id'],
            'training_id' => $training->id,
            'status' => 'assigned',
            'assigned_at' => now(),
        ]);

        return back()->with('success', 'Training assigned successfully.');
    }

    public function updateStatus(
        Request $request,
        EmployeeTraining $assignment
    ) {
        $validated = $request->validate([
            'status' => 'required|in:assigned,completed',
        ]);

        $assignment->update([
            'status' => $validated['status'],
            'completed_at' => $validated['status'] === 'completed'
                ? now()
                : null,
        ]);

        return back()->with('success', 'Training status updated.');
    }

    public function destroy(EmployeeTraining $assignment)
    {
        $assignment->delete();

        return back()->with('success', 'Training assignment removed.');
    }

    public function assignToEmployee(
        Request $request,
        EmployeeApiService $employeeApi
    ) {
        $validated = $request->validate([
            'employee_id' => 'required|integer',
            'training_id' => 'required|exists:trainings,id',
        ]);

        $employees = $employeeApi->getEmployees();

        $employeeExists = collect($employees)->contains(
            fn($employee) =>
            (int) $employee['id'] === (int) $validated['employee_id']
        );

        if (!$employeeExists) {
            return back()->withErrors([
                'employee_id' => 'Employee not found.'
            ]);
        }

        $exists = \App\Models\EmployeeTraining::where(
            'employee_id',
            $validated['employee_id']
        )->where(
            'training_id',
            $validated['training_id']
        )->exists();

        if ($exists) {
            return back()->withErrors([
                'training_id' => 'This training is already assigned.'
            ]);
        }

        \App\Models\EmployeeTraining::create([
            'employee_id' => $validated['employee_id'],
            'training_id' => $validated['training_id'],
            'status' => 'assigned',
            'assigned_at' => now(),
        ]);

        return back()->with('success', 'Training assigned successfully.');
    }
}
