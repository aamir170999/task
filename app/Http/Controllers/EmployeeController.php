<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {$employees = Employee::all();
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        return view('employee.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeStoreRequest $request)
    {
        Employee::create($request->validated());
        return redirect()->back()->with('success', 'Employee Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(employee $employee)
    {
        $companies = Company::all();
        return view('employee.edit', compact('companies', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        $employee->update($request->validated());
        return redirect()->back()->with('success', 'Employee updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(employee $employee)
    {
        $employee->delete();
       return redirect()->back()->with('success','employee deleted successfully');
    }
    // public function addemployee(company $company)
    // {
    //     return view('employee.create', compact('company'));
    // }
    public function dataTable(Request $request)
    {
        $employees = Employee::with('company')->select(['*']);

        return DataTables::of($employees)


        ->addColumn('action', function ($employees) {

                $actions = '<a class="btn btn-primary btn-sm p-2 m-1" style="border-radius:100%;" href="' . route('employee.edit', $employees->id) . '" title="Edit"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            >
                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                            </path>
                        </svg></a>';


                $actions .='<a class="btn btn-danger btn-sm p-2 m-1"  title="Delete Employee"  onclick="handleDelete(' . $employees->id . ')" style="border-radius:100%;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
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
            ->rawColumns(['action'])
            ->make(true);
    }
}
