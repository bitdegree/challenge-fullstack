<?php

namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Redirect;

class UserService
{
    private $user;

    /**
     * UserService constructor.
     * @param $getInfo (comes from Socialite user())
     * @param $provider
     * @return Redirect|void
     */
    public function __construct($getInfo, string $provider)
    {
        try {
            $user = User::where('provider_id', $getInfo->id)->first();
            if (!$user) {
                $user = User::create([
                    'name'     => $getInfo->name,
                    'email'    => $getInfo->email,
                    'avatar'    => $getInfo->avatar,
                    'provider' => $provider,
                    'provider_id' => $getInfo->id,
                ]);
            }
            $this->user = $user;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Nepavyko prisijungti ar prisiregistruoti");
        }
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
