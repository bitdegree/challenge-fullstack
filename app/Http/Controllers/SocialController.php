<?php

namespace App\Http\Controllers;

use App\Events\LoginOrCreateUserEvent;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        event(new LoginOrCreateUserEvent($provider));
        return redirect()->to('/');
    }
}
