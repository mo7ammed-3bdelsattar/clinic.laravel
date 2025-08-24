<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users=User::with('image')->orderBy('id','desc')->paginate(10);
        return view('admin.pages.users.index',compact('users'));
    }
    public function edit(User $user)
    {
        return view('admin.pages.users.edit',compact('user'));
    }
    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $image = $request->file('image');
            $filename = $image->store('/users', 'public');
            $data['image'] = $filename;
        }
        $data['password']=Hash::make($request->password);
        USer::where('id', $user->id)->update($data);
        return redirect()->route('admin.users.index')->with('success', 'user updated successfully');
    }
    public function create()
    {
        return view('admin.pages.users.create');
    }
        public function store(UserRequest $request)
    {
        try{   
        $data = $request->validated();
        // dd($data);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->store('/users', 'public');
            $data['image'] = $filename;
        }
        $data['password']=Hash::make($request->password);
        User::create($data);
        return redirect()->route('admin.users.index')->with('success', 'user added successfully');
    }catch(Exception $e){
        dd($e);
    }
    }
    public function destroy(User $user)
    {
        $imagePath = null;
        if ($user->image) {
            $imagePath = $user->image;
        }
        try {
            DB::beginTransaction();
            $user->delete();
            if ($imagePath) {
                // Delete the image from storage
                Storage::disk('public')->delete($imagePath);
            }
            DB::commit();
            return redirect()->back()->with('success', 'user deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('errors', 'This user can not be deleted');
        }
    }

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
            return redirect()->back()->with('success', 'Role assigned successfully');
        }
        return redirect()->route('admin.dashboard')->with('error', 'No role selected');
    }
    public function addRole($id)
    {
        $user = User::findOrFail($id);
        $roles = \Spatie\Permission\Models\Role::all();
        return view('admin.pages.roles.add-role', compact('user', 'roles'));
        
    }
}
