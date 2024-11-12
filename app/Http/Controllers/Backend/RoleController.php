<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function AllPermission()
    {
        $permission = Permission::all();
        return view('backend.pages.permission.all_permission',compact('permission'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function AddPermission()
    {
        return view('backend.pages.permission.add_permission');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function StorePermission(Request $request)
    {
        $role = Permission::create([
           'name' => $request->name,
           'group_name' => $request->group_name,
        ]);

        $notification =array(
            'message' => 'Permission created Successfully',
            'alert-type' =>'success'
           );
           return redirect()->route('all.permission')->with($notification);
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
    public function EditPermission(string $id)
    {
        $permission = Permission::findOrFail($id);
        return view('backend.pages.permission.edit_permission',compact('permission'));    
    }

    /**
     * Update the specified resource in storage.
     */
    public function UpdatePermission(Request $request)
    {
        $permission_id = $request->id;
        Permission::findOrFail($permission_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
         ]);
 
         $notification =array(
             'message' => 'Permission updated Successfully',
             'alert-type' =>'success'
            );
            return redirect()->route('all.permission')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function DeletePermission(string $id)
    {
        Permission::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }

     /**
     * Display a listing of the resource.
     */

    public function AllRoles()
    {
        $roles = Role::all();
        return view('backend.pages.roles.all_roles',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function AddRoles()
    {
        return view('backend.pages.roles.add_roles');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function StoreRoles(Request $request)
    {
        $role = Role::create([
           'name' => $request->name,
        ]);

        $notification =array(
            'message' => 'Role created Successfully',
            'alert-type' =>'success'
           );
           return redirect()->route('all.roles')->with($notification);
    }

    public function EditRoles(string $id)
    {
        $roles = Role::findOrFail($id);
        return view('backend.pages.roles.edit_roles',compact('roles'));    
    }

    /**
     * Update the specified resource in storage.
     */
    public function UpdateRoles(Request $request)
    {
        $role_id = $request->id;
        Role::findOrFail($role_id)->update([
            'name' => $request->name,
         ]);
 
         $notification =array(
             'message' => 'Role updated Successfully',
             'alert-type' =>'success'
            );
            return redirect()->route('all.roles')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function DeleteRoles(string $id)
    {
        Role::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Role Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }

    
    /* |------------------| Role and permission All method |------------------|*/

    public function AddRolesPermission()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.roles.add_roles_permission',compact('roles','permissions','permission_groups'));
    }

    // public function StoreRolesPermission(Request $request){

    //     $data = array();
    //     $permissions = $request->permission;

    //     foreach($permissions as $key => $item){
    //         $data['role_id'] = $request->role_id;
    //         $data['permission_id'] = $item;

    //         DB::table('role_has_permissions')->insert($data);
    //     }

    //     $notification = array(
    //         'message' => 'Role Permission Added Successfully',
    //         'alert-type' => 'success'
    //     );

    //     $request->validate([
    //         'role_id' => 'required|exists:roles,id',
    //         'permission' => 'required|array',
    //     ]);

    //     return redirect()->route('all.roles.permission')->with($notification); 
    // }



    public function StoreRolesPermission(Request $request)
    {
        // Validate the request before processing
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission' => 'required|array',
        ]);
    
        $permissions = $request->permission;
    
        foreach ($permissions as $item) {
            // Check if the permission is already assigned to the role
            if (!DB::table('role_has_permissions')->where('role_id', $request->role_id)->where('permission_id', $item)->exists()) {
                DB::table('role_has_permissions')->insert([
                    'role_id' => $request->role_id,
                    'permission_id' => $item,
                ]);
            }
        }
    
        $notification = array(
            'message' => 'Role Permission Added Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('all.roles.permission')->with($notification); 
    }
    



    public function AllRolesPermission(){

        $roles = Role::all();
        return view('backend.pages.roles.all_roles_permission',compact('roles'));

    } // End Method 

    public function AdminEditRoles($id){

        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.roles.edit_roles_permission',compact('role','permissions','permission_groups')); 

    } // End Method 

    public function RolePermissionUpdate(Request $request,$id){

        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

         $notification = array(
            'message' => 'Role Permission Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles.permission')->with($notification);

    }// End Method 

    public function AdminDeleteRoles($id){
          $role = Role::findOrFail($id);
          if (!is_null($role)) {
            $role->delete();
          }

        $notification = array(
            'message' => 'Role Permission deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

}
