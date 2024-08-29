<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Get all the employees
        $employees = Employee::orderBy('company_id')->paginate(10);

        return view('employee.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        return view('employee.create', ['companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validate data
        $validatedData = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' =>['required', 'string', 'max:255'],
            'company_id' => ['required', 'integer', 'exists:companies,id'],
            'email' =>['required', 'email', 'max:255', 'unique:employees,email'],
            'phone' =>['required', 'string', 'min:11', 'max:11'],
        ]);
        //Create employee
        $employee = Employee::create($validatedData);
        //Redirect
        return redirect(route('employee.index'))->with('status', __('messages.employee_created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $companies = Company::all();
        return view('employee.edit', ['employee' => $employee, 'companies' => $companies]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //Validate data
        $validatedData = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' =>['required', 'string', 'max:255'],
            'company_id' => ['required', 'integer', 'exists:companies,id'],
            'email' =>['required', 'email', 'max:255', Rule::unique('employees', 'email')->ignore($employee->id)],
            'phone' =>['required', 'string', 'min:11', 'max:11'],
        ]);
        //Update employee
        $employee->update($validatedData);
        //Redirect
        return redirect(route('employee.index'))->with('status', __('messages.employee_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //Delete employee
        $employee->delete();

        //Redirect
        return redirect()->route('employee.index')->with('status', __('messages.employee_deleted'));

    }
}
