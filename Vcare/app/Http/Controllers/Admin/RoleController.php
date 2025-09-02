<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    
    public function index(){
        $auth =auth('admin')->user()->admin ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('roles.view'), 403);
        $roles = Role::with('permissions')->get();
        return view('admin.pages.roles.index', compact('roles','auth'));
    }
    public function create(){
        $auth = Admin::where('user_id', auth('admin')->id())->first() ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('roles.create'), 403);
        $permissions = Permission::all();
        return view('admin.pages.roles.create',compact('permissions'));
    }
    public function store(RoleRequest $request){
        $auth = Admin::where('user_id', auth('admin')->id())->first() ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('roles.create'), 403);
        $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);
        if($request->permissions){
            $role->syncPermissions($request->permissions);
        }
        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }
    public function edit(Role $role){
        $auth = Admin::where('user_id', auth('admin')->id())->first() ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('roles.update'), 403);
        $permissions = Permission::where('guard_name',$role->guard_name)->get();
        return view('admin.pages.roles.edit', compact('role', 'permissions'));
    }
    public function update(RoleRequest $request, Role $role){
        $auth = Admin::where('user_id', auth('admin')->id())->first() ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('roles.update'), 403);
        $role->name = $request->name;
        $role->save();
        if($request->permissions){
            $role->syncPermissions($request->permissions);
        }
        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    
    }
    public function destroy(Role $role){
        $auth = Admin::where('user_id', auth('admin')->id())->first() ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('roles.delete'), 403);
        if($role->name == 'admin'){
            return redirect()->back()->with('error', 'You cannot delete the admin role.');
        }
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }
}
