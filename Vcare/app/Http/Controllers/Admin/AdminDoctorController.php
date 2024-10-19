<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use Illuminate\Support\Facades\Storage;

class AdminDoctorController extends Controller
{
    public function index()
    {
        $doctors=Doctor::orderBy('visitors','desc')->paginate(10);
        return view('admin.pages.doctors.index',compact('doctors'));
    }
    public function edit()
    {
        return view('admin.pages.doctors.edit');
    }
    public function update(){

    }
    public function create()
    {
        return view('admin.pages.doctors.create');
    }
        public function store(DoctorRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->store('/doctors', 'public');
            $data['image'] = $filename;
        }
        Doctor::create($data);
        return redirect()->route('admin.doctors.index')->with('success', 'doctor added successfully');
    }
    public function destroy(Doctor $doctor)
    {
        if ($doctor->image) {
            $imagePath = $doctor->image;
        }
        try {
            $doctor->delete();
            if ($imagePath) {
                // Delete the image from storage
                Storage::disk('public')->delete($imagePath);
            }
            return redirect()->back()->with('success', 'doctor deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('errors', 'This doctor can not be deleted');
        }
    }
}
