<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        return view('tenant.auth.login');
    }
    public function loginStore(Request $request){
        // dd("shaique");
        $credentials = $request->only('email','password');
        // dd($credentials);
        $credentials['tenant_id'] = tenant('id');
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ]);
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $request->session()->regenerate();
            return redirect()->route('tenant.dashboard')->with('success', 'Login successful');
        }
        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function register(){
        return view('tenant.auth.register');
    }

    public function registerStore(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // Auth::login($user);
        return redirect()->route('tenant.login');
    //     return redirect()->route('tenant.login')->with('success', 'Registration successful. Please login.');

    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('tenant.login')->with('success', 'Logout successful');
    }
}
