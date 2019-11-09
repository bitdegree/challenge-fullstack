<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersUpdateRequest;
use App\Services\ImageStoringService;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function update(UsersUpdateRequest $request)
    {
        $imageService = new ImageStoringService($request);
        Auth::user()->update([
            'avatar' => '/storage/users/' . $imageService->getAvatarName()
        ]);
        return redirect()->route('profile');
    }
}
