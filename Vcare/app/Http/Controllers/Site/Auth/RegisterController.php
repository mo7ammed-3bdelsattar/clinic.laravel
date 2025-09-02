<?php

namespace App\Http\Controllers\Site\Auth;

use App\Models\User;
use App\Models\Patient;
use App\Enums\UserGendersEnum;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        if(Auth::user()){return redirect()->back();}
        $genders = UserGendersEnum::all();
        return view('site.pages.register',compact('genders'));
    }
    public function store(UserRequest $request){
        $data =$request->validated();
        $data['password']=Hash::make($data['password']);
        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            $user = User::create($data);
            $patient =Patient::create([
                'user_id'=>$user->id,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
            $user->assignRole('patient');
        }

        Auth::login($user);

        return redirect()->route('home.index')->with(['success'=>"You're all set!"]);
    }
}

