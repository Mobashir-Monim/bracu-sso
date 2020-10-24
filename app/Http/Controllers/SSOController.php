<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SSOController extends Controller
{
    public function authenticator()
    {


        return view('sso/login');
    }

    public function authenticate()
    {
        dd('here in authenticate');
    }
}
