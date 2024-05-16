<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Login',
            'nav' => 'login'
        ];
        return view('user.login.index', $data);
    }
    public function registration()
    {
        $data = [
            'title' => 'Registration',
            'nav' => 'registration'
        ];
        return view('user.registration.index', $data);
    }
}
