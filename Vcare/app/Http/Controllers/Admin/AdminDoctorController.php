<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

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
    public function store(){
    }
}
