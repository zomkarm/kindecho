<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Symfony\Component\ErrorHandler\Debug;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('admin.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => 1,
            'password' => Hash::make($request->password),
        ]);
        Log::debug($admin);
        //Auth::login($admin);

        return redirect()->route('admin.login')->with('success','Account created successfully,Please Login');
    }

    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        Log::debug($credentials);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->is_admin) {
                Log::debug("login success");
                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout();
                Log::debug("login failed");
                return back()->withErrors(['email' => 'Not authorized as admin']);
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}