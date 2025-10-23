<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegistration()
    {
        return view('auth.registration');
    }

    public function registration(Request $request)
    {
        $validated = $request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed|min:6',
        ]);
        $validated['password'] = Hash::make($request->password);
        $user = User::create($validated);
        $user->assignRole('inventory_viewer'); // only view permission
        //fire event
        event(new UserRegistered($user));
        return redirect()->route('auth.showLogin')->with('success','Registartion Done! , Please Login');
    }

    public function showLogin()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6',
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('products.index');
        }else{
            return back()->withErrors([
                'email'=>'Invalid Credentials',
            ]);
        }

    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.showLogin')->with('success','Logged Out');
    }
}
