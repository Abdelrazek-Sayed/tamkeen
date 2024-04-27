<?php

namespace App\Http\Controllers\Auth\Socials;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;

class GoogleController extends Controller
{
    public function signInwithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackToGoogle()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('gauth_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect('/dashboard');

            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'gauth_id' => $user->id,
                    'gauth_type' => 'google',
                    'password' => encrypt('123123123')
                ]);

                Auth::login($newUser);

                return redirect('/dashboard');
            }

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect('/login')->withErrors('Unable to log in with Google. Please try again.');
        }
    }
}
