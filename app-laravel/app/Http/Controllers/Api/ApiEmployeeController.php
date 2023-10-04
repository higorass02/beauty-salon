<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class ApiEmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return response()->json([
            'data' => $employees
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
        ]);

        $employees = Employee::create($data);

        return response()->json([
            'message' => 'Employee created successfully!',
            'data' => $employees
        ]);
    }

    public function show(Employee $employee)
    {
        return response()->json([
            'data' => $employee
        ]);
    }

    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
        ]);

        $employee->update($data);

        return response()->json([
            'message' => 'Employee updated successfully!',
            'data' => $employee
        ]);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json([
            'message' => 'Employee deleted successfully!',
            'data' => $employee
        ]);
    }
}
