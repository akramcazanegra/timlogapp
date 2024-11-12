<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\EmployeeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
    |--------------------------------------------------------------------------
    | Employee route
    |-------------------------------------------------------------------------- 
    */
    Route::controller(EmployeeController::class)->group(function(){

        Route::get('all/employee','AllEmployee')->name('all.employee');
        Route::get('add/employee','AddEmployee')->name('add.employee');
        Route::post('store/employee','StoreEmployee')->name('employee.store');
        Route::get('edit/employee/{id}','EditEmployee')->name('edit.employee');
        Route::post('update/employee','UpdateEmployee')->name('employee.update');
        Route::get('delete/employee/{id}','DeleteEmployee')->name('delete.employee');
    });
