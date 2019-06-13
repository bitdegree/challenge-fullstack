<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'failLogin', 'googleAuth']]);
    }

    public function failLogin() {
        return response()->json(
            [
                "message" => "Your session is expired!"
            ],
            402
        );
    }

    /**
     * Logins with raw authenthication
     */
    public function login(Request $request)
    {
        $credentials = [
            "email" => $request->get("email", null),
            "password" => $request->get("password", null)
        ];

        if (!$token = Auth::guard('api')->attempt($credentials))
            return response()->json(
                [
                    'error' => 'Unauthorized',
                    'message' => 'Wrong username or password'
                ],
                401
            );

        return $this->respondWithToken($token, auth()->user());
    }

    public function googleAuth(Request $request)
    {
        $token = $request->get("googleToken", null);

        if($token === null)
            return response()->json(
                [
                    "message" => "Google Auth Token was not provided!"
                ],
                400
            );

        $client = new \Google_Client(
            [
                'client_id' => '1091528950892-ndm33msvssq94e0onpqjtqtvn9ql6ji8.apps.googleusercontent.com'
            ]
        );
        $payload = $client->verifyIdToken(
            $token
        );

        if(!$payload)
            return response()->json(
                [
                    "message" => "Google Auth Token is invalid!"
                ],
                401
            );
        //^^^ could be done through middleware, but I only auth with google in one place soooo its fine.

        $user = User::firstOrCreate(
            [
                'email' => $payload['email']
            ],
            [
                'firstName' => $payload['given_name'],
                'lastName' => $payload['family_name'],
                'avatarURL' => $payload['picture'],
                'password' => 'someRandomPasswordThatNooneWillFigureOut...........'
                //^^^^^^^^ Dodgy but will do since this is really small scale demo.
            ]
        );
        $user->avatarURL = $payload["picture"];
        $user->save();

        $token = Auth::guard('api')->login($user);

        return $this->respondWithToken(
            $token,
            $user
        );
    }

    public function updateAvatar(Request $request) {
        $url = $request->get("avatar", null);

        if($url === null)
            return response()->json(
                [
                    "message" => "Avatar was not provided!"
                ],
                400
            );

        $user = Auth::guard("api")->user();
        $user->avatarURL = $url;
        $user->save();

        return response()->json([]);
    }

    public function logout()
    {
        Auth::guard('api')->logout();

        return response()->json(
            [
                "message" => "Successfully logged out!"
            ]
        );
    }

    public function register(Request $request)
    {
        $checkString_FN = function (string $valueName, ?string $value, int $minLen, int $maxLen) {
            if ($value === null)
                throw new HttpException(
                    400,
                    "$valueName was not provided!"
                );

            $valueLen = strlen($value);
            if ($valueLen < $minLen)
                throw new HttpException(
                    400,
                    "$valueName is too short! (Must be at least $minLen characters in length)"
                );

            if ($valueLen > $maxLen)
                throw new HttpException(
                    400,
                    "$valueName is too long! (Must be at most $maxLen characters in length)"
                );
        };

        $email = $request->get("email", null);
        $password = $request->get("password", null);
        $firstName = $request->get("firstName", null);
        $lastName = $request->get("lastName", null);

        try {
            $checkString_FN("Email", $email, 5, 256);
            $checkString_FN("Password", $password, 5, 64);
            $checkString_FN("First name", $firstName, 3, 64);
            $checkString_FN("Last name", $lastName, 3, 64);
        } catch (HttpException $e) {
            return response()->json(
                [
                    "message" => $e->getMessage()
                ],
                $e->getStatusCode()
            );
        }

        $user = User::create(
            [
                'email' => $email,
                'password' => $password,
                'firstName' => $firstName,
                'lastName' => $lastName
            ]
        );

        $token = Auth::guard('api')->login($user);

        return $this->respondWithToken(
            $token,
            $user
        );
    }

    public function status() {
        return $this->respondWithToken(
            Auth::guard('api')->refresh(),
            Auth::guard('api')->user()
        );
    }

    protected function respondWithToken($token, $user)
    {
        return response()->json(
            [
                "token" => $token,
                "ttl" => Auth::guard('api')->factory()->getTTL() * 60,
                "user" => $user
            ]
        );
    }
}
