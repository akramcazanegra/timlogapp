<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function AllEmployee()
    {
        $employee = Employee::latest()->get();
        return view('backend.employee.all_employee',compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function AddEmployee()
    {
         return  view('backend.employee.add_employee');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function StoreEmployee(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|unique:employees|max:200',
            'phone' => 'required|max:200',
            'address' => 'required|max:400',
            'salary' => 'required|max:200',
            'vacation' => 'required|max:200',
            'city' => 'required|max:200',
        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/employee/'.$name_gen);
        $save_url = 'upload/employee/'.$name_gen;

        Employee::insert([
          'name' => $request->name,
          'email' => $request->email,
          'phone' => $request->phone,
          'address' => $request->address,
          'salary' => $request->salary,
          'experience' => $request->experience,
          'vacation' => $request->vacation,
          'city' => $request->city,
          'image' => $save_url,
          'created_at' => Carbon::now(),
        ]);

        $notification =array(
            'message' => 'Employee created Successfully',
            'alert-type' =>'success'
           );
           return redirect()->route('all.employee')->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function EditEmployee(string $id)
    {
        $employee = Employee::findOrFail($id);
        return view('backend.employee.edit_employee',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function UpdateEmployee(Request $request)
    {
        $employee_id = $request->id;

        /** Insert data with image*/
        if ($request->file('image')) {
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/employee/'.$name_gen);
        $save_url = 'upload/employee/'.$name_gen;

        Employee::findOrFail($employee_id)->update([
          'name' => $request->name,
          'email' => $request->email,
          'phone' => $request->phone,
          'address' => $request->address,
          'salary' => $request->salary,
          'experience' => $request->experience,
          'vacation' => $request->vacation,
          'city' => $request->city,
          'image' => $save_url,
          'created_at' => Carbon::now(),
        ]);

        $notification =array(
            'message' => 'Employee Updated Successfully',
            'alert-type' =>'success'
           );
           return redirect()->route('all.employee')->with($notification);
        }

        /** Insert data without image*/ 
        else {
            Employee::findOrFail($employee_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'salary' => $request->salary,
                'experience' => $request->experience,
                'vacation' => $request->vacation,
                'city' => $request->city,
                'created_at' => Carbon::now(),
              ]);
      
              $notification =array(
                  'message' => 'Employee Updated Successfully',
                  'alert-type' =>'success'
                 );
                 return redirect()->route('all.employee')->with($notification);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function DeleteEmployee(string $id)
    {
        $employee_img = Employee::findOrFail($id);
        $img = $employee_img->image;
        unlink($img);

        Employee::findOrFail($id)->delete();

        $notification =array(
            'message' => 'Employee Updated Successfully',
            'alert-type' =>'success'
           );
           return redirect()->back()->with($notification);
    }
}
