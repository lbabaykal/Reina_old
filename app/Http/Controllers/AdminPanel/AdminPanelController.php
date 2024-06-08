<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;

class AdminPanelController extends Controller
{
    public function __invoke()
    {
        return view('admin.index');
    }
}
