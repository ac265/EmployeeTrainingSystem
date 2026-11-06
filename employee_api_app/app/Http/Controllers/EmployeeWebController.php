<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeWebController
{
    public function index()
    {
        $employees = Employee::get();

        return view('employees.index', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email',
            'department' => 'required|string|max:150'
        ]);

        Employee::create($validated);

        return redirect()->route('employees.index')
            ->with('success', 'Personel eklendi.');
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => [
                'required',
                'email',
                Rule::unique('employees', 'email')->ignore($employee->id)
            ],
            'department' => 'required|string|max:150'
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index')
            ->with('success', 'Personel güncellendi.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Personel silindi.');
    }
}
