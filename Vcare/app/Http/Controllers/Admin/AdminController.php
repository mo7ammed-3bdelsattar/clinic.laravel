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


class AdminController extends Controller
{
    
    public function index()
    {
        $admin = auth('admin')->user();
        abort_if(Gate::allows('doctor'),403);
        $admins = Admin::orderBy('id', 'desc')->paginate(10);
        return view('admin.pages.admins.index', compact('admins'));
    }
    public function edit(Admin $admin)
    {
        abort_if(Gate::denies('admin'),403);
        return view('admin.pages.admins.edit', compact('admin'));
    }
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
    public function create()
    {
        abort_if(Gate::allows('doctor'),403);
        return view('admin.pages.admins.create');
    }
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
