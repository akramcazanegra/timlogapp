<?php

namespace App\Http\Controllers\Backend;


use App\Models\Customer; // Add this line
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function AllProduct()
    {
        $product = Product::latest()->get();
        return view('backend.product.all_product',compact('product'));
    }


 

    public function AllProductDashboard()
{
    $product = Product::latest()->get();
    return view('index', compact('product'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function AddProduct()
    {
        $category = Category::latest()->get();
        $supplier = Supplier::latest()->get();
        $customers = Customer::all(); // Fetch all customers
     
        return view('backend.product.add_product',compact('category','supplier' , 'customers'  ));
    
    }
    /**
     * Store a newly created resource in storage.
     */
    public function StoreProduct(Request $request)
    {
        $pcode = IdGenerator::generate(['table' => 'products','field' => 'product_code','length' => 4, 'prefix' => 'PC' ]);
 


        $image = $request->file('product_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/product/'.$name_gen);
        $save_url = 'upload/product/'.$name_gen;

        Product::insert([

            
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'customer_id' => $request->customer_id, // Add this line
            'product_code' => $pcode,
            'product_garage' => $request->product_garage,
            'product_store' => $request->product_store,
            'buying_date' => $request->buying_date,
            'expire_date' => $request->expire_date,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'product_image' => $save_url,
            'created_at' => Carbon::now(), 

        ]);

         $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification); 
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
    public function EditProduct(string $id)
    {
        $product = Product::findOrFail($id);
        $category = Category::latest()->get();
        $supplier = Supplier::latest()->get();
        $customers = Customer::all(); // Fetch customers
       
        return view('backend.product.edit_product',compact('product','category','supplier' , 'customers' ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function UpdateProduct(Request $request)
    {
        $product_id = $request->id;

        if ($request->file('product_image')) {

        $image = $request->file('product_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/product/'.$name_gen);
        $save_url = 'upload/product/'.$name_gen;

        Product::findOrFail($product_id)->update([

            

            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'product_code' => $request->product_code,
            'product_garage' => $request->product_garage,
            'product_store' => $request->product_store,
            'buying_date' => $request->buying_date,
            'expire_date' => $request->expire_date,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'product_image' => $save_url,
            'created_at' => Carbon::now(), 

        ]);

         $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification); 
             
        } else{

            Product::findOrFail($product_id)->update([

            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'product_code' => $request->product_code,
            'product_garage' => $request->product_garage,
            'product_store' => $request->product_store,
            'buying_date' => $request->buying_date,
            'expire_date' => $request->expire_date,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price, 
            'created_at' => Carbon::now(), 

        ]);

         $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification); 

        } // End else Condition  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function DeleteProduct(string $id)
    {
        $product_img = Product::findOrFail($id);
        $img = $product_img->product_image;
        unlink($img);

        Product::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }

    /**
     * Bar code .
     */
    public function BarcodeProduct(string $id)
    {
        $product = Product::findOrFail($id);
        return view('backend.product.barcode_product',compact('product')); 
    }

    public function ImportProduct(){

        return view('backend.product.import_product');

    }// End Method 


    public function Export(){

        return Excel::download(new ProductExport,'products.xlsx');

    }// End Method 


    public function Import(Request $request){

        Excel::import(new ProductImport, $request->file('import_file'));

         $notification = array(
            'message' => 'Product Imported Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }// End Method 
}
