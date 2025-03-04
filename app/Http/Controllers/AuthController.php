<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Hash;

class  AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function auth_login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_delete' => 0], true)) 
        {
            if(Auth::user()->is_admin == 5)
            {
                return redirect('teacher/dashboard');
            }
            else if(Auth::user()->is_admin == 6)
            {
                return redirect('student/dashboard');
            }
            else if(Auth::user()->is_admin == 7)
            {
                return redirect('parent/dashboard');
            }
            else
            {
                return redirect('panel/dashboard');
            }
         
        } 
        else 
        {
            return redirect()->back()->with('error', "Please enter correct email and password");
        } 
    }

    public function forgot()
    {
        return view('auth.forgot');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url(''));
    }
}
