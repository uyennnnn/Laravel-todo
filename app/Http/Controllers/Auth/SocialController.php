<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function processGoogleLogin()
    {
        $googleUser = Socialite::driver('google')->user();

        if(!$googleUser){
            return redirect('/login');
        }


        $systemUser = User::firstOrNew(
            ['google_id' => $googleUser->id],
            [
                'name' => $googleUser->name,
                'username' => 'google_' . $googleUser->id,
                'email' => $googleUser->email,
            ]
        );

        Auth::login($systemUser);
        return redirect('/home');
    }
}
