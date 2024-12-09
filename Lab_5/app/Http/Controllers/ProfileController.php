<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile'); // Будет отображаться представление profile.blade.php
    }
}
