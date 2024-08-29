<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Mail\NewCompany;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Get all the companies
        $companies = Company::orderBy('name')->paginate(10);

        //Redirect
        return view('company.index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:companies,email'],
            'logo' => ['nullable', 'image', File::image()->dimensions(Rule::dimensions()->minWidth(100)->minHeight(100)),],
            'website' => ['required', 'string', 'max:255']
        ]);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            
            // Store the image if valid
            $logoPath = $logo->store('logos', 'public');

            // Add the logo path to the validated data array
            $validatedData['logo'] = $logoPath;
        } else {
            $logoPath = null;
        }
        //Create company
        $company = Company::create($validatedData);

         // Send the email notification
         Mail::to('itchaboidavid420@gmail.com')->send(new NewCompany($company));

        //Redirect
        return redirect()->route('company.index')->with('status', __('messages.company_created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $employees = $company->employees()->paginate(10);
        return view('company.show', ['company' => $company, 'employees' => $employees]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('company.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('companies', 'email')->ignore($company->id)],
            'logo' => ['nullable', 'image', File::image()->dimensions(Rule::dimensions()->minWidth(100)->minHeight(100)),],
            'website' => ['required', 'string', 'max:255']
        ]);
         // Check if a new logo file was uploaded
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            
            // Store the new logo file in the 'public/logos' directory
            $logoPath = $logo->store('logos', 'public');

            // Optionally, delete the old logo file if it exists
            if ($company->logo && Storage::disk('public')->exists($company->logo)) {
                Storage::disk('public')->delete($company->logo);
            }

            // Update the validated data with the new logo path
            $validatedData['logo'] = $logoPath;
        } else {
            $logoPath = null;
        }
        //Update company
        $company->update($validatedData);

        //Redirect
        return redirect()->route('company.index')->with('status', __('messages.company_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        //Redirect
        return redirect()->route('company.index')->with('status', __('messages.company_deleted'));
    }
}
