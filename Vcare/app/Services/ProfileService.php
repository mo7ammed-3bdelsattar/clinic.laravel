<?php


namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileService{


    public static function updateImage($request){
        $image = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $user = auth('admin')->user()??auth()->user();
        abort_if(!$user,403,'Unauthorized');
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
    }
    public static function destroyImage(){
         $user = auth('admin')->user()??auth()->user();
         abort_if(!$user,403,'Unauthorized');
        if ($user->image) {
            Storage::delete('public/' . $user->image->path);
            $user->image()->delete();
        }
    }
    public static function changePassword($request){
        $user = Auth::guard('admin')->user()??abort(403, 'Unauthorized');
        $data = ['password' => Hash::make($request->password)];
        User::where('id', $user->id)->update($data);
    } 
    
}