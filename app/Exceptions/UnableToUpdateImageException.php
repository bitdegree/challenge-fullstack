<?php

namespace App\Exceptions;

use Exception;

class UnableToUpdateImageException extends Exception
{
    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function render($request)
    {
        return \redirect()->route('profile')->with('error', 'Nepavyko pakeisti nuotraukos');
    }
}
