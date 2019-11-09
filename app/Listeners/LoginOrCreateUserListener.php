<?php

namespace App\Listeners;

use App\Services\UserService;
use Laravel\Socialite\Facades\Socialite;

class LoginOrCreateUserListener
{
    public function handle($event)
    {
        $provider = $event->provider;
        $getInfo = Socialite::driver($provider)->stateless()->user();
        $user = new UserService($getInfo, $provider);
        auth()->login($user->getUser(), true);
    }
}
