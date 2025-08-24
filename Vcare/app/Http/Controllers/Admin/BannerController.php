<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::with('image')->paginate(10);
        return view('admin.pages.banners.index', compact('banners'));
    }
    public function create()
    {
        return view('admin.pages.banners.create');
    }
    public function store(BannerRequest $request)
    {
        $data = $request->validated();

        $banner = Banner::create($data);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->store('/banners', 'public');
            $banner->image()->create(['path' => $filename]);
        }

        return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully');
    }
    public function edit(Banner $banner)
    {
        return view('admin.pages.banners.edit', compact('banner'));
    }
    public function update(BannerRequest $request, Banner $banner)
    {
        $data = $request->validated();
        $banner->update($data); 
        if ($request->hasFile('image')) {
            if ($banner->image) {
                Storage::delete('public/' . $banner->image->path);
                $banner->image()->delete();
            }
            $image = $request->file('image');
            $filename = $image->store('/banners', 'public');
            $banner->image()->create(['path' => $filename]);
        }
        return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully');
    }
    public function destroy(Banner $banner)
    {
        if ($banner->image) {
            Storage::delete('public/' . $banner->image->path);
            $banner->image()->delete();
        }
        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully');
    }
}