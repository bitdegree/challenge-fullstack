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
        $this->middleware('auth:api', ['except' => ['login', 'register', 'failLogin']]);
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

    public function logout(Request $request)
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
