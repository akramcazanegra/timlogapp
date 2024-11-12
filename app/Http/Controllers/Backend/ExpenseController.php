<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function AddExpense()
    {
        return view('backend.expense.add_expense');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function StoreExpense(Request $request)
    {
        Expense::insert([
            'details' => $request->details,
            'amount' => $request->amount,
            'month' => $request->month,
            'year' => $request->year,
            'date' => $request->date,
            'created_at' => Carbon::now(),
        ]); 

        $notification =array(
            'message' => 'expence created Successfully',
            'alert-type' =>'success'
           );
           return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function TodayExpense()
    {
        $date = date("d-m-Y");
        $today = Expense::where('date',$date)->get();
        return view('backend.expense.today_expense',compact('today'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function EditExpense($id){

        $expense = Expense::findOrFail($id);
        return view('backend.expense.edit_expense',compact('expense'));

    }// End Method 

    /**
     * Update the specified resource in storage.
     */
    public function UpdateExpense(Request $request)
    {
        $expense_id = $request->id;

        Expense::findOrFail($expense_id)->update([
            'details' => $request->details,
            'amount' => $request->amount,
            'month' => $request->month,
            'year' => $request->year,
            'date' => $request->date,
            'created_at' => Carbon::now(),
        ]); 

        $notification =array(
            'message' => 'expence Updated Successfully',
            'alert-type' =>'success'
           );
           return redirect()->route(('today.expense'))->with($notification);
    
    }

     /**
     * Display the specified resource.
     */
    public function MonthExpense(){

        $month = date("F");
        $monthexpense = Expense::where('month',$month)->get();
        return view('backend.expense.month_expense',compact('monthexpense'));

    }// End Method


    public function YearExpense(){

         $year = date("Y");
        $yearexpense = Expense::where('year',$year)->get();
        return view('backend.expense.year_expense',compact('yearexpense'));

    }// End Method

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
