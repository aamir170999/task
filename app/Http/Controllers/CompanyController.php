<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Mail\CompanyRegisterMail;
use App\Models\Company;
use Illuminate\Http\Request;
use Mail;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        return view('company.index',  compact('companies'));
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
    public function store(CompanyStoreRequest $request)
    {

        if ($request->hasFile('logo')) {
            $custom_file_name = time() . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move('img/', $custom_file_name);
            Company::create($request->except('logo')+ ["logo" => "img/".$custom_file_name]);

        }
        $content = [
            'subject' => 'new company register',
            'body' => 'Regitser Successfull'
        ];
        Mail::to('your_email@gmail.com')->send(new CompanyRegisterMail($content));

        return redirect()->back()->with('success', 'company added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(company $company)
    {

        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        $company->update($request->validated());
        return redirect()->back()->with('success', 'Company updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(company $company)
    {
        $company->delete();
        return redirect()->back()->with('success', 'company deleted successfully');
    }
}
