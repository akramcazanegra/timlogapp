<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Test\HamzaController;
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\SalaryController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\PaySalaryController;
use App\Http\Controllers\Backend\AttendenceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::get('/admin/logout', [AdminController::class, 'adminDestroy'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| Middleware
|--------------------------------------------------------------------------
| You need to be connected  
*/
Route::middleware(['auth'])->group(function(){

    Route::controller(HamzaController::class)->group(function(){

        Route::get('hamza','index');
        
        

    });
     /*
    |--------------------------------------------------------------------------
    | Events route
    |-------------------------------------------------------------------------- 
    */

    Route::get('fullcalender', [FullCalenderController::class, 'index'])->name('fullcalender');
    Route::post('fullcalenderAjax', [FullCalenderController::class, 'ajax']);
    Route::post('/updateEvent', [FullCalenderController::class, 'updateEvent']);



    Route::controller(EventController::class)->group(function(){

        Route::get('all/event','index')->name('all.event');
        Route::get('all/event/ajax','ajax');
        
        

    });
    /*
    |--------------------------------------------------------------------------
    | Profile route
    |-------------------------------------------------------------------------- 
    */

    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'adminProfileStore'])->name('admin.profile.store'); 


    /*
    |--------------------------------------------------------------------------
    | Admin user route
    |-------------------------------------------------------------------------- 
    */
    Route::controller(AdminController::class)->group(function(){

        Route::get('all/admin','AllAdmin')->name('all.admin');
        Route::get('add/admin','AddAdmin')->name('add.admin');
        Route::post('store/admin','StoreAdmin')->name('admin.store');
        Route::get('/edit/admin/{id}','EditAdmin')->name('edit.admin');
        Route::post('/update/admin','UpdateAdmin')->name('admin.update');
        Route::get('/delete/admin/{id}','DeleteAdmin')->name('delete.admin');

        // Database Backup 
       Route::get('/database/backup','DatabaseBackup')->name('database.backup');
       Route::get('/backup/now','BackupNow');
       Route::get('{getFilename}','DownloadDatabase');
       Route::get('/delete/database/{getFilename}','DeleteDatabase');
       
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

    /*
    |--------------------------------------------------------------------------
    | Salary route
    |-------------------------------------------------------------------------- 
    */
    Route::controller(PaySalaryController::class)->group(function(){

        Route::get('pay/salary','PaySalary')->name('pay.salary');
        Route::get('pay/now/salary/{id}','PayNowSalary')->name('pay.now.salary');
        Route::post('employee/salary/store','EmployeeSalaryStore')->name('employee.salary.store');
        Route::get('/month/salary','MonthSalary')->name('month.salary');
        
    });

    /*
    |--------------------------------------------------------------------------
    | Advance Salary route
    |-------------------------------------------------------------------------- 
    */
    Route::controller(SalaryController::class)->group(function(){

        Route::get('all/salary','AllSalary')->name('all.salary');
        Route::get('add/salary','AddSalary')->name('add.salary');
        Route::post('store/salary','StoreSalary')->name('salary.store');
        Route::get('edit/salary/{id}','EditSalary')->name('edit.salary');
        Route::post('update/salary','UpdateSalary')->name('salary.update');
        Route::get('delete/salary/{id}','DeleteSalary')->name('delete.salary');
    });

    /*
    |--------------------------------------------------------------------------
    | Attend route
    |-------------------------------------------------------------------------- 
    */
    Route::controller(AttendenceController::class)->group(function(){

        Route::get('employee/attend/list','EmployeeAttendenceList')->name('employee.attend.list');
        Route::get('employee/attend/add','EmployeeAttendenceAdd')->name('add.employee.attend');
        Route::post('/employee/attend/store','EmployeeAttendenceStore')->name('employee.attend.store');
        Route::get('/edit/employee/attend/{date}','EditEmployeeAttendence')->name('employee.attend.edit'); 
        Route::get('/view/employee/attend/{date}','ViewEmployeeAttendence')->name('employee.attend.view'); 
 
        
    });

    /*
    |--------------------------------------------------------------------------
    | Customer route
    |-------------------------------------------------------------------------- 
    */
    Route::controller(CustomerController::class)->group(function(){

        Route::get('all/customer','AllCustomer')->name('all.customer');
        Route::get('add/customer','AddCustomer')->name('add.customer');
        Route::post('store/customer','StoreCustomer')->name('customer.store');
        Route::get('edit/customer/{id}','EditCustomer')->name('edit.customer');
        Route::post('update/customer','UpdateCustomer')->name('customer.update');
        Route::get('delete/customer/{id}','DeleteCustomer')->name('delete.customer');
    });

    /*
    |--------------------------------------------------------------------------
    | Supplier route
    |-------------------------------------------------------------------------- 
    */
    Route::controller(SupplierController::class)->group(function(){

        Route::get('all/supplier','AllSupplier')->name('all.supplier');
        Route::get('add/supplier','AddSupplier')->name('add.supplier');
        Route::post('store/supplier','StoreSupplier')->name('supplier.store');
        Route::get('edit/supplier/{id}','EditSupplier')->name('edit.supplier');
        Route::post('update/supplier','UpdateSupplier')->name('supplier.update');
        Route::get('delete/supplier/{id}','DeleteSupplier')->name('delete.supplier');
        Route::get('details/supplier/{id}','DetailsSupplier')->name('details.supplier');
    });

    /*
    |--------------------------------------------------------------------------
    | Category route
    |-------------------------------------------------------------------------- 
    */
    Route::controller(CategoryController::class)->group(function(){

        Route::get('all/category','AllCategory')->name('all.category');
        Route::get('add/category','AddCategory')->name('add.category');
        Route::post('store/category','StoreCategory')->name('category.store');
        Route::get('edit/category/{id}','EditCategory')->name('edit.category');
        Route::post('update/category','UpdateCategory')->name('category.update');
        Route::get('delete/category/{id}','DeleteCategory')->name('delete.category');
        Route::get('details/category/{id}','DetailsCategory')->name('details.category');
    });

    /*
    |--------------------------------------------------------------------------
    | Product route
    |-------------------------------------------------------------------------- 
    */
    Route::controller(ProductController::class)->group(function(){

         Route::get('/dashboard', [ProductController::class, 'AllProductDashboard'])
     ->middleware(['auth', 'verified'])
     ->name('dashboard');

        Route::get('all/product','AllProduct')->name('all.product');
        Route::get('add/product','AddProduct')->name('add.product');
        Route::post('store/product','StoreProduct')->name('product.store');
        Route::get('edit/product/{id}','EditProduct')->name('edit.product');
        Route::post('update/product','UpdateProduct')->name('product.update');
        Route::get('delete/product/{id}','DeleteProduct')->name('delete.product');
        Route::get('details/product/{id}','DetailsProduct')->name('details.product');

        Route::get('barcode/product/{id}','BarcodeProduct')->name('barcode.product');

        Route::get('/import/product','ImportProduct')->name('import.product');
        Route::get('/export','Export')->name('export');
        Route::post('/import','Import')->name('import');
    });
    

    /*
    |--------------------------------------------------------------------------
    | Expense route
    |-------------------------------------------------------------------------- 
    */
    Route::controller(ExpenseController::class)->group(function(){

        Route::get('add/expense','AddExpense')->name('add.expense');
        Route::post('store/expense','StoreExpense')->name('expense.store');
        Route::get('today/expense/','TodayExpense')->name('today.expense');
        Route::get('edit/expense/{id}','EditExpense')->name('edit.expense');
        Route::post('update/expense','UpdateExpense')->name('expense.update');
        Route::get('month/expense/','MonthExpense')->name('month.expense');
        Route::get('/year/expense','YearExpense')->name('year.expense');
        

    });

   


    /*
    |--------------------------------------------------------------------------
    | Role And Permission route
    |-------------------------------------------------------------------------- 
    */
    Route::controller(RoleController::class)->group(function(){

        
            /*
            |---------------------------------------
                | Permission route
            |---------------------------------------
            */

        Route::get('/all/permission','AllPermission')->name('all.permission');
        Route::get('/add/permission','AddPermission')->name('add.permission');
        Route::post('store/permission','StorePermission')->name('permission.store');
        Route::get('edit/permission/{id}','EditPermission')->name('edit.permission');
        Route::post('update/permission','UpdatePermission')->name('permission.update');
        Route::get('delete/permission/{id}','DeletePermission')->name('delete.permission');

            /*
            |---------------------------------------
                | Role route
            |---------------------------------------
            */
        
        Route::get('/all/role','AllRoles')->name('all.roles');
        Route::get('/add/role','AddRoles')->name('add.roles');
        Route::post('store/role','StoReroles')->name('roles.store');
        Route::get('edit/role/{id}','EditRoles')->name('edit.roles');
        Route::post('update/role','UpdateRoles')->name('roles.update');
        Route::get('delete/role/{id}','DeleteRoles')->name('delete.roles');  
        
            /*
            |---------------------------------------
                | Role and permission combine route
            |---------------------------------------
            */
        
        Route::get('add/roles/permission','AddRolesPermission')->name('add.roles.permission');
        Route::post('roles/permission/store','StoreRolesPermission')->name('role.permission.store');
        Route::get('/all/roles/permission','AllRolesPermission')->name('all.roles.permission');

        Route::get('/admin/edit/roles/{id}','AdminEditRoles')->name('admin.edit.roles');
        Route::post('/role/permission/update/{id}','RolePermissionUpdate')->name('role.permission.update');
        Route::get('/admin/delete/roles/{id}','AdminDeleteRoles')->name('admin.delete.roles');
            
    });

});
