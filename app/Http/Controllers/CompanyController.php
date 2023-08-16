<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\DataTables\CompaniesDataTable;

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}
