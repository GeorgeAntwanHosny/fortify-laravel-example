<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwoFactorController extends Controller
{

    public function show(Request $request)
    {
        return view('profile.two-factor-authentication-form');
    }
}
