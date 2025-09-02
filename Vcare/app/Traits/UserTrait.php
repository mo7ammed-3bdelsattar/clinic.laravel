<?php


namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;



trait UserTrait
{
    public function createUser($request,$data)
    {
        $userData = Arr::only($data, [
            'name',
            'email',
            "phone",
            'type',
            'gender',
            "password",
        ]);
        $userData['password'] = Hash::make($userData['password']);
        $user = User::create($userData);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->store('/users', 'public');
            if (!$user) {
                return back()->with('error', 'User not found');
            }
            $user->image()->create([
                'path' => $filename,
            ]);
        }
        return $user;
    }
    public function updateUser($request,$user)
    {
        $data = $request->validated();

        $userData = Arr::only($data, [
            'name',
            'email',
            "phone",
            "password",
            'gender',
            'type',
        ]);
        if($data['password']===$user->password){
            $userData['password']=$data['password'];
        }else{
            $userData['password'] = Hash::make($userData['password']);
        }
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
        $user->update($userData);
        return $data;
    }
}