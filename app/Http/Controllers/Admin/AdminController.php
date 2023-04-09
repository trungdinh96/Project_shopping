<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginAdmin()
    {
        if(Auth::check())
        {
           return redirect()->route('admin.home'); 
        }
        // dd(bcrypt("trungdinh0906"));
        return view('Admin.login');
    }
    public function postLoginAdmin(Request $request)
    {
        $validateLogin = $request->validate(
            [
                'email' => 'required|exists:users,email',
                'password' => 'required',
            ]);
        $remember = $request->has('remember_me') ? true : false;
        if(Auth::attempt($validateLogin,$remember))
        {
            return redirect()->route('admin.home');
        }
    }
    public function logout()
    {
        session()->flush();
        auth()->logout();
        return redirect()->route('client.index');
    }

}
