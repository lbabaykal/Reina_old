<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HELPSController extends Controller
{
    public function __invoke()
    {
        auth()->user()->ratings()->ratedAnimes()->get();
        auth()->user()->ratings()->ratedDoramas()->get();
    }
}
