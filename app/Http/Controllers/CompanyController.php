<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\DataTables\CompaniesDataTable;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CompaniesDataTable $dataTable)
    {
        //
        return $dataTable->render('companies.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        //  
        $validatedInput = $request->safe();
        if ($request->has('company_logo')) {
            $logoPath = $request->file('company_logo')->store('public/company');
            $validatedInput['company_logo'] = $logoPath;
        }

        Company::create($validatedInput->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCompanyRequest $request, Company $company)
    {
        $validatedInput = $request->safe();
        if ($request->has('company_logo')) {
            $logoPath = $request->file('company_logo')->store('public/company');
            $validatedInput['company_logo'] = $logoPath;
            Storage::exists($company->company_logo)
                ? Storage::delete($company->company_path)
                : null;
        }
        $isUpdated = $company->update($validatedInput->all());
        if ($isUpdated) return redirect()->route('companies.index')
            ->with('message', ['success', 'company updated successfully']);

        return redirect()
            ->route('companies.index')
            ->with('message', ['danger', 'Error with updating company try again ... ']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}
