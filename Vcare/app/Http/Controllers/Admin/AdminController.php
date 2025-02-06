<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Admin;
use Illuminate\Http\Request;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $admin = auth('admin')->user();
        abort_if(Gate::allows('doctor'),403);
        $admins = Admin::orderBy('id', 'desc')->paginate(10);
        return view('admin.pages.admins.index', compact('admins'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\View\View
     */
    public function edit(Admin $admin)
    {
        abort_if(Gate::denies('admin'),403);
        return view('admin.pages.admins.edit', compact('admin'));
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
        abort_if(!Gate::allows('admin'),403);

        $data = $request->validated();
        if ($request->hasFile('image')) {
            if ($admin->image) {
                Storage::disk('public')->delete($admin->image);
            }
            $image = $request->file('image');
            $filename = $image->store('/admins', 'public');
            $data['image'] = $filename;
        }
        $data['password'] = Hash::make($request->password);
        Admin::where('id', $admin->id)->update($data);
        return redirect()->route('admin.admins.index')->with('success', 'admin updated successfully');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        abort_if(Gate::allows('doctor'),403);
        return view('admin.pages.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AdminRequest  $request
     * @return \Illuminate\Http\RedirectResponse
 
     */
    public function store(AdminRequest $request)
    {
        abort_if(Gate::allows('doctor'),403);

        try {
            $data = $request->validated();
            // dd($data);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = $image->store('/admins', 'public');
                $data['image'] = $filename;
            }
            $data['password'] = Hash::make($request->password);
            Admin::create($data);
            return redirect()->route('admin.admins.index')->with('success', 'admin added successfully');
        } catch (Exception $e) {
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Admin $admin)
    {
        abort_if(!Gate::allows('admin'),403);
        $imagePath = null;
        if ($admin->image) {
            $imagePath = $admin->image;
        }
        try {
            DB::beginTransaction();
            $admin->delete();
            if ($imagePath) {
                // Delete the image from storage
                Storage::disk('public')->delete($imagePath);
            }
            DB::commit();
            return redirect()->back()->with('success', 'admin deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('errors', 'This admin can not be deleted');
        }  
    }
}