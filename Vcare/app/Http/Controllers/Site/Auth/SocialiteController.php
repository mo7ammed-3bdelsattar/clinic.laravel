<?php

namespace App\Http\Controllers\Site\Auth;

use App\Models\User;
use App\Models\Patient;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();
        // dd($contents = Http::get($socialUser->getAvatar())->body());
        $user = User::where('email', operator: $socialUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'phone' => +201234567890,
                'password' => Hash::make(value: 'password'),
                'gender' => rand(0, 1),
                'type' => 4,
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
            ]);
            $patient = Patient::create([
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            if ($socialUser->getAvatar()) {
                $avatarUrl = $socialUser->getAvatar();
                $contents = Http::get($avatarUrl)->body();
                $fileName = 'avatars/' . uniqid() . '.jpg';
                Storage::disk('public')->put($fileName, $contents);
                if (!$user) {
                    return back()->with('error', 'User not found');
                }
                $user->image()->create([
                    'path' => $fileName,
                ]);
            }
            $user->assignRole('patient');
        }

        Auth::login($user);

        return redirect()->route('home.index')->with(['success' => "You're all set!"]);
    }
}
