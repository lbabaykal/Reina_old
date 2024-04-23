<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HELPSController extends Controller
{
    public function __invoke()
    {
        auth()->user()->ratings()->ratingAnimes()->get();
        auth()->user()->ratings()->ratingDoramas()->get();
    }
}
