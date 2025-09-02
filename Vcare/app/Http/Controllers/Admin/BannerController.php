<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $auth =auth('admin')->user()->admin ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('banners.view'), 403);
        $banners = Banner::with('image')->paginate(10);
        return view('admin.pages.banners.index', compact('banners','auth'));
    }
    public function create()
    {
        $auth =auth('admin')->user()->admin ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('banners.create'), 403);
        return view('admin.pages.banners.create');
    }
    public function store(BannerRequest $request)
    {
        $auth =auth('admin')->user()->admin ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('banners.create'), 403);
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
        $auth =auth('admin')->user()->admin ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('banners.update'), 403);
        return view('admin.pages.banners.edit', compact('banner'));
    }
    public function update(BannerRequest $request, Banner $banner)
    {
        $auth =auth('admin')->user()->admin ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('banners.update'), 403);
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
        $auth =auth('admin')->user()->admin ?? abort(403, 'Unauthorized');
        abort_if($auth->cannot('banners.delete'), 403);
        if ($banner->image) {
            Storage::delete('public/' . $banner->image->path);
            $banner->image()->delete();
        }
        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully');
    }
}
