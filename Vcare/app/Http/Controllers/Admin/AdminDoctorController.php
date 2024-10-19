<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Major;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use Illuminate\Support\Facades\Storage;

class AdminDoctorController extends Controller
{
    public function index()
    {
        $doctors=Doctor::orderBy('id','desc')->paginate(10);
        return view('admin.pages.doctors.index',compact('doctors'));
    }
    public function edit(Doctor $doctor)
    {
        $majors=Major::get();
        $users=User::where('type','patient')->get();
        return view('admin.pages.doctors.edit',compact(['doctor','majors','users']));
    }
    public function update(DoctorRequest $request, Doctor $doctor)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            if ($doctor->image) {
                Storage::disk('public')->delete($doctor->image);
            }
            $image = $request->file('image');
            $filename = $image->store('/doctors', 'public');
            $data['image'] = $filename;
        }
        if($request->user_id){
            $user=User::where('id','user_id')->get();
            $user->type='doctor';
        }
        Doctor::where('id', $doctor->id)->update($data);
        return redirect()->route('admin.doctors.index')->with('success', 'Doctor updated successfully');
    }
    public function create()
    {
        $majorSelected=Major::get()->first();
        $userSelected=User::where('type','patient')->get()->first();
        $majors=Major::get();
        $users=User::where('type','patient')->get();
        return view('admin.pages.doctors.create',compact(['majors','users','majorSelected','userSelected']));
    }
        public function store(DoctorRequest $request)
    {
        try{   
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->store('/doctors', 'public');
            $data['image'] = $filename;
        }
        if($request->has('user_id')){
            User::where('id', $request->user_id)->update(['type'=>'doctor']);            
        }
        Doctor::create($data);
        return redirect()->route('admin.doctors.index')->with('success', 'doctor added successfully');
    }catch(Exception $e){
        dd($e);
    }
    }
    public function destroy(Doctor $doctor)
    {
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
