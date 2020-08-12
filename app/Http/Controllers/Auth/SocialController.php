<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Socialite;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class SocialController extends Controller
{
    /**
     * Redirects to appropriate providers based on
     * $provider
     *
     * @param string $provider
     * @return RedirectResponse
     */
    public function redirectToProvider(string $provider) : RedirectResponse
    {
        return Socialite::driver('facebook')->redirect();
    }
    /**
     * Undocumented function
     *
     * @param string $provider
     * @return RedirectResponse
     */
    public function handleProviderCallback(string $provider) : RedirectResponse
    {
        try {
            $data = Socialite::driver('facebook')->user();
            return $this->handleUser($data, $provider);
        } catch (\Exception $e) {
            Log::error(json_encode($e->getMessage()));
            return redirect(route('login'))->with('status', 'Facebook Login failed');
        }
    }
    /**
     * Handles the user's information and creates/updates
     * the record accordingly.
     *
     * @param object $data
     * @param string $provider
     * @return RedirectResponse
     */
    public function handleUser(object $data, string $provider) : RedirectResponse
    {
        $user = User::where([
            'social->'.$provider.'->id' => $data->id,
        ])->first();
        if (!$user) {
            /**
             * If we don't user associated with the facebook id, then
             * check for the user's email and associate the facebook id
             */
            $user = User::where([
                'email' => $data->email,
            ])->first();
        }
        if (!$user) {
            return $this->createUser($data, $provider);
        }
        $user->social->facebook->token = $data->token;
        $user->save();
        return $this->login($user);
    }
    /**
     * Undocumented function
     *
     * @param object $data
     * @param string $provider
     * @return RedirectResponse
     */
    public function createUser(object $data, string $provider) : RedirectResponse
    {
        try {
            $user = new User;
            $user->name   = $data->name;
            $user->email  = $data->email;
            $user->avatar = $data->avatar;
            $user->social = json_encode([
                $provider => [
                    'id'    => $data->id,
                    'token' => $data->token
                ]
            ]);
            $user->save();
            return $this->login($user);
        } catch (Exception $e) {
            return redirect(route('login'))->with(['status' => 'Login failed. Please try again']);
        }
    }
    /**
     * Logins the given user and redirects to home
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function login(User $user) : RedirectResponse
    {
        auth()->loginUsingId($user->id);
        return redirect(route('home'));
    }
}
