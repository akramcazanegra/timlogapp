<?php

namespace App\Http\Controllers\Backend;

use App\Models\Employee;
use App\Models\Attendence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function EmployeeAttendenceList  ()
    {
        $allData = Attendence::select('date')->groupBy('date')->orderBy('id','desc')->get();
        return view('backend.attendence.view_employee_attend',compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function EmployeeAttendenceAdd()
    {
        $employees = Employee::all();
        return view('backend.attendence.add_employee_attend',compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function EmployeeAttendenceStore(Request $request)
    {
        Attendence::where('date',date('Y-m-d',strtotime($request->date)))->delete();
        $countemployee = count($request->employee_id);

        for ($i=0; $i < $countemployee ; $i++) { 
           $attend_status = 'attend_status'.$i;
           $attend = new Attendence();
           $attend->date = date('Y-m-d',strtotime($request->date));
           $attend->employee_id = $request->employee_id[$i];
           $attend->attend_status  = $request->$attend_status;
           $attend->save();
        }

         $notification = array(
            'message' => 'Data Inseted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.attend.list')->with($notification); 
    }

    /**
     * Display the specified resource.
     */
    public function ViewEmployeeAttendence($date){

        $details = Attendence::where('date',$date)->get();
        return view('backend.attendence.details_employee_attend',compact('details'));


   }// End Method

    /**
     * Show the form for editing the specified resource.
     */
    public function EditEmployeeAttendence($date){
        $employees = Employee::all();
        $editData = Attendence::where('date',$date)->get();
        return view('backend.attendence.edit_employee_attend',compact('employees','editData'));

   }// End Method 

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
