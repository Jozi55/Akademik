<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginControllers extends Controller
{

    public function index(){
        if (Auth::user()) {
            return redirect('/');
        }
        return view('auth.login');
    }

    public function postLogin(Request $request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->pass])) {
           return redirect('/home');
        }else {
            return redirect()->back()->with('error', 'Email atau Password salah!');
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
      }
}
