<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function AllSupplier()
    {
        $supplier = Supplier::latest()->get();
        return view('backend.supplier.all_supplier',compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function AddSupplier()
    {
        return view('backend.supplier.add_supplier');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function StoreSupplier(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|unique:suppliers|max:200',
            'phone' => 'required|max:200',
            'address' => 'required|max:400',
            'shopname' => 'required|max:200',
            'type' => 'required|max:200',
            'account_holder' => 'required|max:200',
            'account_number' => 'required|max:200',
            'bank_name' => 'required|max:200',
            'bank_branch' => 'required|max:200',
            'city' => 'required|max:200',
        ]);
        $image = $request->file('image');
        $image_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/supplier'.$image_gen);
        $save_url = 'upload/supplier'.$image_gen;

        Supplier::insert([
          'name' => $request->name,
          'email' => $request->email,
          'phone' => $request->phone,
          'address' => $request->address,
          'shopname' => $request->shopname,
          'type' => $request->type,
          'account_holder' => $request->account_holder,
          'account_number' => $request->account_number,
          'bank_name' => $request->bank_name,
          'bank_branch' => $request->bank_branch,
          'city' => $request->city,
          'image' => $save_url,
          'created_at' => Carbon::now(), 
        ]);

        $notification =array(
            'message' => 'Supplier created Successfully',
            'alert-type' =>'success'
           );
           return redirect()->route('all.supplier')->with($notification);
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function EditSupplier(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.edit_supplier',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function UpdateSupplier(Request $request)
    {
        $supplier_id = $request->id;

        /** Insert data with image*/
        if ($request->file('image')) {
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/supplier/'.$name_gen);
        $save_url = 'upload/supplier/'.$name_gen;

        Supplier::findOrFail($supplier_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'shopname' => $request->shopname,
            'type' => $request->type,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'city' => $request->city,
            'image' => $save_url,
            'created_at' => Carbon::now(), 
        ]);

        $notification =array(
            'message' => 'supplier Updated Successfully',
            'alert-type' =>'success'
           );
           return redirect()->route('all.supplier')->with($notification);
        }

        /** Insert data without image*/ 
        else {
            supplier::findOrFail($supplier_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopname' => $request->shopname,
                'type' => $request->type,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'city' => $request->city,
                'created_at' => Carbon::now(), 
              ]);
      
              $notification =array(
                  'message' => 'supplier Updated Successfully',
                  'alert-type' =>'success'
                 );
                 return redirect()->route('all.supplier')->with($notification);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function DetailsSupplier(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.details_supplier',compact('supplier'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function DeleteSupplier(string $id)
    {
        $supplier_img = Supplier::findOrFail($id);
        $img = $supplier_img->image;
        unlink($img);

        Supplier::findOrFail($id)->delete();

        $notification =array(
            'message' => 'supplier deleted Successfully',
            'alert-type' =>'success'
           );
           return redirect()->back()->with($notification);
    
    }
}
