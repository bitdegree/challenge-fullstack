<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function __invoke($errorCode)
    {
        switch ($errorCode) {
            case 400:
                info("Blogas adresas");
                break;
            case 422:
                info("Nepatenkinta RequestForma, bandyk dar kart");
                break;
            case 500:
                info("Bėda pas mus");
                break;
            default:
                info("Nežinau kodėl taip nutiko, klaida");
                break;
        }
    }
}
