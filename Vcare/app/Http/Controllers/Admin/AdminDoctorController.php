<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Admin;
use App\Models\Major;
use App\Models\Doctor;
use Yoeunes\Toastr\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class AdminDoctorController extends Controller
{
    public function index()
    {
        abort_if(Gate::allows('doctor'),403);
        $doctors=Doctor::orderBy('id','desc')->paginate(10);
        return view('admin.pages.doctors.index',compact('doctors'));
    }
    public function edit(Doctor $doctor)
    {
        abort_if(Gate::denies('admin'),403);
        $majors=Major::get();
        $admins=Admin::where('type','!=','doctor')->get();
        return view('admin.pages.doctors.edit',compact(['doctor','majors','admins']));
    }
    public function update(DoctorRequest $request, Doctor $doctor)
    {
        abort_if(Gate::denies('admin'),403);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            if ($doctor->image) {
                Storage::disk('public')->delete($doctor->image);
            }
            $image = $request->file('image');
            $filename = $image->store('/doctors', 'public');
            $data['image'] = $filename;
        }
        if($request->admin_id){
            $admin=Admin::where('id','admin_id')->get();
            $admin->type='doctor';
        }
        Doctor::where('id', $doctor->id)->update($data);
        return redirect()->route('admin.doctors.index')->with('success', 'doctor updated successfully');
    }
    public function create()
    {
        abort_if(Gate::allows('doctor'),403);
        $majorSelected=Major::get()->first();
        $adminSelected=Admin::where('type','!=','doctor')->get()->first();
        $majors=Major::get();
        $admins=Admin::where('type','!=','doctor')->get();
        return view('admin.pages.doctors.create',compact(['majors','admins','majorSelected','adminSelected']));
    }
        public function store(DoctorRequest $request)
    {
        abort_if(Gate::allows('doctor'),403);
        try{   
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->store('/doctors', 'public');
            $data['image'] = $filename;
        }
        if($request->has('admin_id')){
            Admin::where('id', $request->admin_id)->update(['type'=>'doctor']);            
        }
        Doctor::create($data);
        return redirect()->route('admin.doctors.index')->with('success', 'doctor added successfully');
    }catch(Exception $e){
        dd($e);
    }
    }
    public function destroy(Doctor $doctor)
    {
        abort_if(Gate::allows('doctor'),403);
        $imagePath = null;
        if ($doctor->image) {
            $imagePath = $doctor->image;
        }
        try {
            DB::beginTransaction();
            $doctor->delete();
            if ($imagePath) {
                // Delete the image from storage
                Storage::disk('public')->delete($imagePath);
            }
            DB::commit();
            return redirect()->back()->with('success', 'doctor deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('errors', 'This doctor can not be deleted');
        }
    }
}
