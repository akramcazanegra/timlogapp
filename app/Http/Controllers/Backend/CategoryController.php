<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function AllCategory()
    {
        $category = Category::latest()->get();
        return view('backend.category.all_category',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function AddCategory()
    {
        return view('backend.category.add_category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function StoreCategory(Request $request)
    {
        Category::insert([
          'category_name' => $request->category_name,
          'created_at' => Carbon::now(), 
        ]);

        $notification =array(
            'message' => 'Category created Successfully',
            'alert-type' =>'success'
           );
           return redirect()->route('all.category')->with($notification);
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
    public function EditCategory(string $id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.edit_category',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function UpdateCategory(Request $request)
    {
        $category_id = $request->id;
        Category::findOrFail($category_id)->update([
            'category_name' => $request->category_name,
            'created_at' => Carbon::now(), 
          ]);
  
          $notification =array(
              'message' => 'Category updated Successfully',
              'alert-type' =>'success'
             );
             return redirect()->route('all.category')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function DeleteCategory(string $id)
    {
        Category ::findOrFail($id)->delete();

        $notification =array(
            'message' => 'Category  deleted Successfully',
            'alert-type' =>'success'
           );
           return redirect()->back()->with($notification);
    }
}
