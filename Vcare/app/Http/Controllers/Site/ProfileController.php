<?php

namespace App\Http\Controllers\Site;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ChangePasswordRequest;

class ProfileController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        return view('site.pages.profile', compact('user'));
    }
      public function updateImage(Request $request)
    {
        $image = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $user = Auth::user();
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
        return redirect()->route('profile')->with('success', 'image updated successfully');
    }
    public function destroyImage()
    {
        $user = Auth::user();
        if ($user->image) {
            Storage::delete('public/' . $user->image->path);
            $user->image()->delete();
        }
        return redirect()->back()->with('success', 'image deleted successfully');
    }
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        $data = ['password' => Hash::make($request->password)];
        // dd($user);
        $user->update($data);
        return redirect()->back()->with('success', 'the password updated successfully');
    }
}
