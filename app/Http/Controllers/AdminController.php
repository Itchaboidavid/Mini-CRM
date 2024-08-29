<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $companyCount = Company::count();
        $employeeCount = Employee::count();

        return view('admin.dashboard', [
            'companyCount' => $companyCount,
            'employeeCount' => $employeeCount
        ]);
    }
}
