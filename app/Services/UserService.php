<?php

namespace App\Services;

use App\User;

class UserService
{
    private $user;

    public function __construct($getInfo, $provider)
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

    public function getUser()
    {
        return $this->user;
    }
}
