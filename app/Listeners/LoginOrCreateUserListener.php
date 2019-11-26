<?php

namespace App\Listeners;

use App\Services\UserService;
use Illuminate\Support\Facades\Event;
use Laravel\Socialite\Facades\Socialite;

class LoginOrCreateUserListener
{
    /**
     * @param $event
     */
    public function handle($event): void
    {
        $provider = $event->provider;
        $getInfo = Socialite::driver($provider)->stateless()->user();
        $user = new UserService($getInfo, $provider);
        auth()->login($user->getUser(), true);
    }
}
