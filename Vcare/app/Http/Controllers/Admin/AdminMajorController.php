<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Major;
use Illuminate\Http\Request;

class AdminMajorController extends Controller
{
    public function index(){
        $majors=Major::paginate(10);
        return view('admin.pages.majors.index',compact('majors'));
    }
    public function edit()
    {
        return view('admin.pages.majors.edit');
    }
    public function update(){

    }
    public function create()
    {
        return view('admin.pages.majors.create');
    }
    public function store(){
    }
}
