<?php

namespace App\Http\Controllers;

class PageController extends Controller
{

    /**
     * Shows single page application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('app');
    }

}
