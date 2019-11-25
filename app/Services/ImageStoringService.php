<?php

namespace App\Services;

use App\Exceptions\UnableToUpdateImageException;
use App\Http\Requests\UsersUpdateRequest;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpKernel\Exception\PreconditionFailedHttpException;

class ImageStoringService
{
    private $avatarName;

    /**
     * @param UsersUpdateRequest $request
     * @return string
     * @throws UnableToUpdateImageException
     */
    public function updateAvatarAndGetName(UsersUpdateRequest $request): string
    {
        try {
            $file = $request->file('avatar');
            $avatarName = $file->getClientOriginalName();
            $this->avatarName = $avatarName;
            Image::make($file)->resize(300, 300)->save(public_path('storage/users/' . $avatarName));
        } catch (\Exception $e) {
            throw new UnableToUpdateImageException();
        }
        return $this->avatarName;
    }
}
