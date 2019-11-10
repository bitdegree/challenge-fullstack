<?php

namespace App\Services;

use App\Http\Requests\UsersUpdateRequest;
use Intervention\Image\Facades\Image;

class ImageStoringService
{
    private $avatarName;

    public function updateAvatarAndGetName(UsersUpdateRequest $request)
    {
        try {
            $file = $request->file('avatar');
            $avatarName = $file->getClientOriginalName() . '.' . $file->getClientOriginalExtension();
            $this->avatarName = $avatarName;
            Image::make($file)->resize(300, 300)->save(public_path('storage/users/' . $avatarName));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Nepavyko pakeisti nuotraukos");
        }
        return $this->avatarName;
    }
}
