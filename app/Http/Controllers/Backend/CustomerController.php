<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function AllCustomer()
    {
        $customer = Customer::latest()->get();
        return view('backend.customer.all_customer',compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function AddCustomer()
    {
        return view('backend.customer.add_customer');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function StoreCustomer(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|unique:customers|max:200',
            'phone' => 'required|max:200',
            'address' => 'required|max:400',
            'shopname' => 'required|max:200',
            'account_holder' => 'required|max:200',
            'account_number' => 'required|max:200',
            'bank_name' => 'required|max:200',
            'bank_branch' => 'required|max:200',
            'city' => 'required|max:200',
        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/customer/'.$name_gen);
        $save_url = 'upload/customer/'.$name_gen;

        Customer::insert([
          'name' => $request->name,
          'email' => $request->email,
          'phone' => $request->phone,
          'address' => $request->address,
          'shopname' => $request->shopname,
          'account_holder' => $request->account_holder,
          'account_number' => $request->account_number,
          'bank_name' => $request->bank_name,
          'bank_branch' => $request->bank_branch,
          'city' => $request->city,
          'image' => $save_url,
          'created_at' => Carbon::now(),  
        ]);

        $notification =array(
            'message' => 'Customer created Successfully',
            'alert-type' =>'success'
           );
           return redirect()->route('all.customer')->with($notification);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function EditCustomer(string $id)
    {
        $customer = Customer::findOrFail($id); 
        return view('backend.customer.edit_customer',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function UpdateCustomer(Request $request)
    {
        $customer_id = $request->id;

        /** Insert data with image*/
        if ($request->file('image')) {
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/customer/'.$name_gen);
        $save_url = 'upload/customer/'.$name_gen;

        customer::findOrFail($customer_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'shopname' => $request->shopname,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'city' => $request->city,
            'image' => $save_url,
            'created_at' => Carbon::now(), 
        ]);

        $notification =array(
            'message' => 'customer Updated Successfully',
            'alert-type' =>'success'
           );
           return redirect()->route('all.customer')->with($notification);
        }

        /** Insert data without image*/ 
        else {
            customer::findOrFail($customer_id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'shopname' => $request->shopname,
                    'account_holder' => $request->account_holder,
                    'account_number' => $request->account_number,
                    'bank_name' => $request->bank_name,
                    'bank_branch' => $request->bank_branch,
                    'city' => $request->city,
                    'created_at' => Carbon::now(), 
              ]);
      
              $notification =array(
                  'message' => 'customer Updated Successfully',
                  'alert-type' =>'success'
                 );
                 return redirect()->route('all.customer')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function DeleteCustomer(string $id)
    {
        $customer_img = Customer::findOrFail($id);
        $img = $customer_img->image;
        unlink($img);

        Customer::findOrFail($id)->delete();

        $notification =array(
            'message' => 'Customer Updated Successfully',
            'alert-type' =>'success'
           );
           return redirect()->back()->with($notification);
    }
}
