<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return view('auth.login');
        }
        return redirect("/");
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'])) {
            return redirect()->intended('/')->with('success', 'You have signed-in');
        }

        return redirect("login")->with('danger', 'Login details are not valid');
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login')->with('success', 'You have signed-out');
    }

    /*public function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone']
        ]);
    }*/
}
