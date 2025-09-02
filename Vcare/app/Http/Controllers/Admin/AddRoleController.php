<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddRoleController extends Controller
{
     public function assignRole(Request $request,$id)
    {
        $user = User::findOrFail($id);
        if($request->guard_name == 'admin'){
            unset($user);
            $user= Admin::where('user_id', $id)->first();
        }
        $data = $request->validate([
            'name' => 'required|string',
        ]);
        if ($data['name']) {
            $user->assignRole($data['name']);
            return redirect()->route('admin.dashboard')->with('success', 'Role assigned successfully');
        }
        return redirect()->route('admin.dashboard')->with('error', 'No role selected');
    }
    public function addRole($id)
    {
        $user = User::findOrFail($id);
        $user = $user->admin??$user;
        $roles = \Spatie\Permission\Models\Role::all();
        return view('admin.pages.roles.add-role', compact(['id','user', 'roles']));
        
    }
}
