<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticatedSessionController extends Controller
{
    public function index()
    {
        return view('index') -> with('button', ['sw' => 0, 'fw' => 1, 'sr' => 1, 'fr' => 1]);
    }

}
