<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    public function Adualt()
    {
        return view('customAuth.index');
    }

    public function admin()
    {
        return view('admin');
    }

    public function site()
    {
        return view('site');
    }
    public function login()
    {
        return view('adminLogin');
    }
    public function checkAdminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
//        return $this->guard()->attempt(
//            $this->credentials($request), $request->filled('remember')
//        );
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {

            return redirect()->intended('/admin');
        }
        return back()->withInput($request->only('email'));

    }
}
