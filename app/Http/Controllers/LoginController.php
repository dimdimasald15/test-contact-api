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
        return view('login.index', $data);
    }
    public function registrasi()
    {
        $data = [
            'title' => 'Registrasi',
            'nav' => 'registrasi'
        ];
        return view('registrasi.index', $data);
    }
}
