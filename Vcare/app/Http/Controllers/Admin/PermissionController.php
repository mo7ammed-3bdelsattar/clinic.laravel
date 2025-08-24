<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    
    public function index(){
        $permissions = Permission::paginate(10);
        return view('admin.pages.permissions.index', compact('permissions'));
    }
    
    public function create(){
        return view('admin.pages.permissions.create');
    }
    public function store(PermissionRequest $request){
        Permission::findOrCreate($request->name,$request->guard_name);
        return redirect()->route('admin.permissions.index')->with('success', 'Permission created successfully.');
    }
    public function edit(Permission $permission){
        return view('admin.pages.permissions.edit', compact('permission'));
    }
    public function update(PermissionRequest $request, Permission $permission){
        $permission->update($request->validated());
        return redirect()->route('admin.permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission){
        if($permission->name == 'admin'){
            return redirect()->back()->with('error', 'You cannot delete the admin permission.');
        }
        $permission->delete();
        return redirect()->route('admin.permissions.index')->with('success', 'Permission deleted successfully.');
    }
    

}
