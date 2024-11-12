<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\AdvanceSalary;
use App\Http\Controllers\Controller;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function AllSalary()
    {
        $salary = AdvanceSalary::latest()->get();
        return view('backend.salary.all_salary',compact('salary'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function AddSalary()
    {
        $employee = Employee::latest()->get();
        return view('backend.salary.add_salary',compact('employee'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function StoreSalary(Request $request)
    {
        $validateData = $request->validate([
            'month' => 'required',
            'year' => 'required',
            
        ]);

        $month = $request->month;
        $employee_id = $request->employee_id;

        $advanced = AdvanceSalary::where('month',$month)->where('employee_id',$employee_id)->first();

        if ($advanced === NULL) {

            AdvanceSalary::insert([
                'employee_id' => $request->employee_id,
                'month' => $request->month,
                'year' => $request->year,
                'advance_salary' => $request->advance_salary,
                'created_at' => Carbon::now(), 
            ]);

         $notification = array(
            'message' => 'Advance Salary Paid Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.salary')->with($notification); 


        } else{

             $notification = array(
            'message' => 'Advance Already Paid',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification); 

        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function EditSalary(string $id)
    {
        $employee = Employee::latest()->get();
        $salary = AdvanceSalary::findOrFail($id);
        return view('backend.salary.edit_salary',compact('salary','employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function UpdateSalary(Request $request)
    {
        $salary_id = $request->id;

         AdvanceSalary::findOrFail($salary_id)->update([
                'employee_id' => $request->employee_id,
                'month' => $request->month,
                'year' => $request->year,
                'advance_salary' => $request->advance_salary,
                'created_at' => Carbon::now(), 
            ]);

         $notification = array(
            'message' => 'Advance Salary Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.salary')->with($notification); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function DeleteSalary(string $id)
    {
    

        AdvanceSalary::findOrFail($id)->delete();

        $notification =array(
            'message' => 'Salry Deleted Successfully',
            'alert-type' =>'success'
           );
           return redirect()->back()->with($notification);
    
    }
}
