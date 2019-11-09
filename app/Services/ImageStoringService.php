<?php

namespace App\Services;

use App\Http\Requests\UsersUpdateRequest;
use Intervention\Image\Facades\Image;

class ImageStoringService
{
    private $avatarName;

    public function __construct(UsersUpdateRequest $request)
    {
        $file = $request->file('avatar');
        $avatarName = $file->getClientOriginalName() . '.' . $file->getClientOriginalExtension();
        $this->avatarName = $avatarName;
        Image::make($file)->resize(300, 300)->save(public_path('storage/users/' . $avatarName));
    }

    /**
     * @return string
     */
    public function getAvatarName(): string
    {
        return $this->avatarName;
    }
}
