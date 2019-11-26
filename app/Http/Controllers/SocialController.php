<?php

namespace App\Http\Controllers;

use App\Events\LoginOrCreateUserEvent;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SocialController extends Controller
{
    /**
     * @param string $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirect(string $provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callback(string $provider): \Illuminate\Http\RedirectResponse
    {
        event(new LoginOrCreateUserEvent($provider));
        return redirect()->to('/');
    }
}
