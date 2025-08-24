<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ChangePasswordRequest;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.pages.profile.index', compact('admin'));
    }
    public function updateImage(Request $request, string $id)
    {
        $image = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $user = Auth::guard('admin')->user();
        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::delete('public/' . $user->image->path);
                $user->image()->delete();
            }
            $image = $request->file('image');
            $filename = $image->store('/users', 'public');
            if (!$user) {
                return back()->with('error', 'User not found');
            }
            $user->image()->create([
                'path' => $filename,
            ]);
        }
        return redirect()->route('admin.profile')->with('success', 'image updated successfully');
    }
    public function destroyImage($id)
    {
        $user = Auth::guard('admin')->user();
        if ($user->image) {
            Storage::delete('public/' . $user->image->path);
            $user->image()->delete();
        }
        return redirect()->back()->with('success', 'image deleted successfully');
    }
    public function changePassword(ChangePasswordRequest $request, Admin $admin)
    {
        // dd($request->validated()); 
        $user = Auth::guard('admin')->user();
        $data = ['password' => Hash::make($request->password)];
        User::where('id', $user->id)->update($data);
        return redirect()->back()->with('success', 'the password updated successfully');
    }
}
