<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersUpdateRequest;
use App\Services\ImageStoringService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UsersController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('profile');
    }

    /**
     * @param UsersUpdateRequest $request
     * @param ImageStoringService $imageStoringService
     * @return RedirectResponse
     * @throws \App\Exceptions\UnableToUpdateImageException
     */
    public function update(UsersUpdateRequest $request, ImageStoringService $imageStoringService): RedirectResponse
    {
        Auth::user()->update([
            'avatar' => '/storage/users/' . $imageStoringService->updateAvatarAndGetName($request)
        ]);
        return redirect()->route('profile.index');
    }
}
