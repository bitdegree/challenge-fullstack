<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{
    public function index()
    {
        return view('profile');
    }
    public function update(UsersUpdateRequest $request)
    {
        $file = $request->file('avatar');
        $avatarName = $file->getClientOriginalName() . '.' . $file->getClientOriginalExtension();
        $user = Auth::user();
        $user->avatar = '/storage/users/' . $avatarName;
        $user->save();
        Image::make($file)->resize(300, 300)->save(public_path('storage/users/' . $avatarName));
        return redirect()->route('profile');
    }
}
