<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Employee;
use App\Models\PaySalary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaySalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function PaySalary()
    {
        $employee = Employee::latest()->get();
        return view('backend.salary.pay_salary',compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function MonthSalary()
    {
        $paidsalary = PaySalary::latest()->get();
        return view('backend.salary.month_salary',compact('paidsalary'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function EmployeeSalaryStore(Request $request)
    {
        $employee_id = $request->id;

        PaySalary::insert([

            'employee_id' => $employee_id,
            'salary_month' => $request->month,
            'paid_amount' => $request->paid_amount,
            'advance_salary' => $request->advance_salary,
            'due_salary' => $request->due_salary,
            'created_at' => Carbon::now(),

        ]);

       $notification = array(
            'message' => 'Employee Salary Paid Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('pay.salary')->with($notification); 

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function PayNowSalary(string $id)
    {
       $paysalary = Employee::findOrFail($id);
       return view('backend.salary.paid_salary',compact('paysalary'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
