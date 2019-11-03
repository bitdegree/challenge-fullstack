<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{
    public function index()
    {
        return view('profile');
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $file = $request->file('avatar');
        $avatarName = $file->getClientOriginalName() . '.' . $file->getClientOriginalExtension();
        $user->avatar = '/storage/users/' . $avatarName;
        $user->save();
        Image::make($file)->resize(300, 300)->save(public_path('storage/users/' . $avatarName));
        return redirect()->route('profile');
    }
}
