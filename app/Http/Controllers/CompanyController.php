<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Mail\CompanyRegisterMail;
use App\Models\Company;
use Illuminate\Http\Request;
use Mail;
use Yajra\DataTables\Facades\DataTables;

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
            Company::create($request->except('logo') + ["logo" => "img/" . $custom_file_name]);
        } else {
            Company::create($request->validated());
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
        if ($request->hasFile('logo')) {
            $custom_file_name = time() . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move('img/', $custom_file_name);
            $company->update($request->except('logo') + ["logo" => "img/" . $custom_file_name]);
        } else {
            $company->update($request->except('logo'));
        }

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


    public function dataTable(Request $request)
    {
        $companies = Company::select(['*']);

        return DataTables::of($companies)


            ->addColumn('action', function ($companies) {

                $actions = '<a class="btn btn-primary btn-sm p-2 m-1" style="border-radius:100%;" href="' . route('company.edit', $companies->id) . '" title="Edit"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            >
                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                            </path>
                        </svg></a>';


                $actions .= '<a class="btn btn-danger btn-sm p-2 m-1"  title="Delete company"  onclick="handleDelete(' . $companies->id . ')" style="border-radius:100%;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                     class="feather feather-trash p-1 br-8 mb-1">
                                     <polyline points="3 6 5 6 21 6"></polyline>
                                    <path
                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                    </path>
                                </svg></a>';
                return '<div>
                ' . $actions . '
                </div>';
            })
            ->editColumn('logo', function ($companies) {
                return '<img src="' . $companies->logo . '"  width="100px"   />';
            })
            ->rawColumns(['action', 'logo'])
            ->make(true);
    }
}
