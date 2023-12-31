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
    const ERROR = 'danger';
    const SUCCESS = 'success';

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
            $logoPath = $request->file('company_logo')->store('company', 'public');
            $validatedInput['company_logo'] = $logoPath;
        }

        $isSaved = Company::create($validatedInput->all());

        if ($isSaved) return redirect()->route('companies.index')
            ->with('message', [self::SUCCESS, 'company saved successfully']);

        return redirect()->route('companies.index')
            ->with('message', [self::ERROR, 'Error with saving company try again ... ']);
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
            $logoPath = $request->file('company_logo')->store('company', 'public');
            $validatedInput['company_logo'] = $logoPath;

            $oldImagePath = $company->company_logo;
            $oldImagePath && Storage::disk('public')->exists($oldImagePath)
                ? Storage::disk('public')->delete($oldImagePath)
                : null;
        }
        $isUpdated = $company->update($validatedInput->all());
        if ($isUpdated) return redirect()->route('companies.index')
            ->with('message', [self::SUCCESS, 'company updated successfully']);

        return redirect()
            ->route('companies.index')
            ->with('message', [self::ERROR, 'Error with updating company try again ... ']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
        $companyLogo = $company->company_logo;

        ($companyLogo && Storage::disk('public')->exists($companyLogo))
            ? Storage::disk('public')->delete($companyLogo)
            : null;

        if ($company->delete())
            return redirect()->route('companies.index')
                ->with('message', [self::SUCCESS, 'Company Deleted successfully']);

        return response()
            ->route('companies.index')
            ->with('message', [self::ERROR, 'Error with deleting company try again ... ']);
    }
}
