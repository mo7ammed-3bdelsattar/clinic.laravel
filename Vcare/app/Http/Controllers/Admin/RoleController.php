<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    
    public function index(){
        $roles = Role::with('permissions')->get();
        return view('admin.pages.roles.index', compact('roles'));
    }
    public function create(){
        $permissions = Permission::all();
        return view('admin.pages.roles.create',compact('permissions'));
    }
    public function store(RoleRequest $request){
        $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);
        if($request->permissions){
            $role->syncPermissions($request->permissions);
        }
        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }
    public function edit(Role $role){
        $permissions = Permission::all();
        return view('admin.pages.roles.edit', compact('role', 'permissions'));
    }
    public function update(RoleRequest $request, Role $role){
        $role->name = $request->name;
        $role->save();
        if($request->permissions){
            $role->syncPermissions($request->permissions);
        }
        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    
    }
    public function destroy(Role $role){
        if($role->name == 'admin'){
            return redirect()->back()->with('error', 'You cannot delete the admin role.');
        }
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }
}
