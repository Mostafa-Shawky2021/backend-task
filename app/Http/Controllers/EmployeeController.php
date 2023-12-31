<?php

namespace App\Http\Controllers;

use App\DataTables\EmployeesDataTable;
use App\Events\CreateEmployee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    const ERROR = 'danger';
    const SUCCESS = 'success';
    /**
     * Display a listing of the resource.
     */
    public function index(EmployeesDataTable $dataTable)
    {
        //
        $companies = Company::all();
        return $dataTable->render('employees.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $companies = Company::all();

        return view('employees.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {

        $validatedInput = $request->safe();
        if ($request->has('employee_image')) {
            $imagePath = $request->file('employee_image')->store('employee', 'public');

            $validatedInput['employee_image'] = $imagePath;
        }

        $employee = Employee::create($validatedInput->all());

        if ($employee) {
            event(new CreateEmployee($employee));
            return redirect()->route('employees.index')
                ->with('message', [self::SUCCESS, 'employee saved successfully']);
        }

        return redirect()->route('employees.index')
            ->with('message', [self::ERROR, 'Error with saving employee try again ... ']);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $companies = Company::all();
        return view('employees.edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEmployeeRequest $request, Employee $employee)
    {
        $validatedInput = $request->safe();

        if ($request->has('employee_image')) {

            $imagePath = $request->file('employee_image')->store('employee', 'public');
            $validatedInput['employee_image'] = $imagePath;

            $oldImagePath = $employee->employee_image;

            ($oldImagePath && Storage::disk('public')->exists($oldImagePath))
                ? Storage::disk('public')->delete($oldImagePath)
                : null;
        }

        $isUpdated = $employee->update($validatedInput->all());

        if ($isUpdated) return redirect()->route('employees.index')
            ->with('message', [self::SUCCESS, 'employee updated successfully']);

        return redirect()->route('companies.index')
            ->with('message', [self::ERROR, 'Error with updating employee try again ... ']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
        $employeeImagePath = $employee->employee_image;

        ($employeeImagePath && Storage::disk('public')->exists($employeeImagePath))
            ? Storage::disk('public')->delete($employeeImagePath)
            : null;

        if ($employee->delete()) return redirect()
            ->route('employees.index')
            ->with('message', [self::SUCCESS, 'employee Deleted successfully']);
        return response()
            ->route('employees.index')
            ->with('message', [self::ERROR, 'Error with deleting employee try again ... ']);
    }
}
