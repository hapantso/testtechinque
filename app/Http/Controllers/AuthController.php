<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function check(Request $request)
    {
        $data = $request->only('email', 'password');
        if(Auth::attempt($data)){
            return redirect('/admin');
        }
        return redirect('login')->with('error', 'Mail or Password incorrect');
    }
}
