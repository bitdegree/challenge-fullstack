<?php

namespace App\Exceptions;

use Exception;

class UnableToUpdateImageException extends Exception
{
    public function render($request)
    {
        return \redirect()->route('profile')->with('error', 'Nepavyko pakeisti nuotraukos');
    }
}
