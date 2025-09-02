<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    
    public function index(){
        $auth =auth('admin')->user()->admin ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('permissions.delete'), 403);
        $permissions = Permission::paginate(10);
        return view('admin.pages.permissions.index', compact('permissions','auth'));
    }
    
    public function create(){
        $auth = Admin::where('user_id', auth('admin')->id())->first() ?? abort(403, 'Unauthorized');
        // abort_if($auth->cannot('permission.create'), 403);
        return view('admin.pages.permissions.create');
    }
    public function store(PermissionRequest $request){
        $auth = Admin::where('user_id', auth('admin')->id())->first() ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('permissions.create'), 403);
        Permission::findOrCreate($request->name,$request->guard_name);
        return redirect()->back()->with('success', 'Permission created successfully.');
    }
    public function edit(Permission $permission){
        $auth = Admin::where('user_id', auth('admin')->id())->first() ?? abort(403, 'Unauthorized');
        // abort_if($auth->cannot('permission.update'), 403);
        return view('admin.pages.permissions.edit', compact('permission'));
    }
    public function update(PermissionRequest $request, Permission $permission){
        $auth = Admin::where('user_id', auth('admin')->id())->first() ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('permissions.update'), 403);
        $permission->update($request->validated());
        return redirect()->route('admin.permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission){
        $auth = Admin::where('user_id', auth('admin')->id())->first() ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('permissions.delete'), 403);
        if($permission->name == 'admin'){
            return redirect()->back()->with('error', 'You cannot delete the admin permission.');
        }
        $permission->delete();
        return redirect()->route('admin.permissions.index')->with('success', 'Permission deleted successfully.');
    }
    

}
