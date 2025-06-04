<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    //
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::updateOrCreate(
                ['email' => $googleUser->email],
                [
                    'name' => $googleUser->name,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(Str::random(16)), // Sigurniji način generiranja lozinke
                    'email_verified_at' => now(), // Automatski verifikuj email
                    'role_id' => 2
                ]
            );

            Auth::login($user, true); // "true" za "remember me"

            return redirect()->intended('/home'); // Preusmjeri na originalno željenu rutu

        } catch (\Exception $e) {
            \Log::error('Google login error: '.$e->getMessage());
            return redirect('/login')->with('error', 'Google login failed. Please try again.');
        }
   }
}
