<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Admin;
use App\Traits\UserTrait;
use App\Enums\UserTypesEnum;
use Illuminate\Http\Request;
use App\Enums\UserGendersEnum;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * Class AdminController
 * @package App\Http\Controllers\Admin
 */
class AdminController extends Controller
{
    use UserTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $auth =auth('admin')->user()->admin ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('admins.manage'), 403);
        $admins = Admin::with(['user','user.image'])->orderBy('id', 'desc')->paginate(10);
        return view('admin.pages.admins.index', compact(['admins','auth']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\View\View
     */
    public function edit(Admin $admin)
    {
        $auth =auth('admin')->user()->admin ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('admins.manage'), 403);
        $genders=UserGendersEnum::all();
        $types=UserTypesEnum::all();
        // $admin= $admin->user;
        return view('admin.pages.admins.edit', compact(['admin','genders','types']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminRequest $request, Admin $admin)
    {
        $auth =auth('admin')->user()->admin ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('admins.manage'), 403);
        $user = $admin->user;
        $data = $this->updateUser($request, $user);
        $admindata = [
            'updated_at' => now(),
        ];
        $admin->update($admindata);
        return redirect()->route('admin.admins.index')->with('success', 'admin updated successfully');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $auth =auth('admin')->user()->admin ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('admins.manage'), 403);
        $genders=UserGendersEnum::all();
        $types=UserTypesEnum::all();
        return view('admin.pages.admins.create',compact(['genders','types']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AdminRequest  $request
     * @return \Illuminate\Http\RedirectResponse
 
     */
    public function store(AdminRequest $request)
    {
        $auth =auth('admin')->user()->admin ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('admins.manage'), 403);
        $data = $request->validated();
        $user = $this->createUser($request, $data);
        $admin =Admin::create(['user_id'=>$user->id]);
        if($data['type'] == 1){
            $admin->assignRole('admin');
        }else{
            $admin->assignRole('manager');
        }
        return redirect()->route('admin.admins.index')->with('success', 'admin added successfully');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Admin $admin)
    {
        $auth =auth('admin')->user()->admin ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('admins.manage'), 403);

       if($admin->user->image){
        Storage::delete('public/' . $admin->user->image->path);
        $admin->user->image()->delete();
       }
         $admin->user->delete();
         $admin->delete();
        return redirect()->back()->with('success', 'admin deleted successfully');
    }
}