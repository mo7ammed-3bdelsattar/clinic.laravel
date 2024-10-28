<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Major;
use Illuminate\Http\Request;
use App\Http\Requests\MajorRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\UrlGeneration\PublicUrlGenerator;


class AdminMajorController extends Controller
{
    public function index()
    {
        abort_if(Gate::allows('doctor'),403);
        $majors = Major::orderBy('id', 'desc')->paginate(10);
        return view('admin.pages.majors.index', compact('majors'));
    }
    public function edit(Major $major)
    {
        abort_if(Gate::allows('doctor'),403);

        return view('admin.pages.majors.edit', compact('major'));
    }
    public function update(MajorRequest $request, Major $major)
    {
        abort_if(Gate::allows('doctor'),403);

        $data = $request->validated();
        if ($request->hasFile('image')) {
            if ($major->image) {
                Storage::disk('public')->delete($major->image);
            }
            $image = $request->file('image');
            $filename = $image->store('/majors', 'public');
            $data['image'] = $filename;
        }
        Major::where('id', $major->id)->update($data);
        return redirect()->route('admin.majors.index')->with('success', 'Major updated successfully');
    }
    public function create()
    {
        abort_if(Gate::allows('doctor'),403);

        return view('admin.pages.majors.create');
    }
    public function store(MajorRequest $request)
    {
        abort_if(Gate::allows('doctor'),403);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->store('/majors', 'public');
            $data['image'] = $filename;
        }
        Major::create($data);
        return redirect()->route('admin.majors.index')->with('success', 'Major added successfully');
    }
    public function destroy(Major $major)
    {
        abort_if(Gate::allows('doctor'),403);
        $imagePath = null;
        if ($major->image) {
            $imagePath = $major->image;
        }
        try {
            $major->delete();
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            return redirect()->back()->with('success', 'Major deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'This major can not be deleted');
        }
    }
}
