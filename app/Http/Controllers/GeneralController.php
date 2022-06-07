<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function dashboard()
    {
        if (Auth::check()) {
            // dd(Auth::user()->user_type);
            return view('general.dashboard');
        }
        return redirect("login");
    }

    public function profile()
    {
        if (Auth::check()) {
            // dd(Auth::user()->user_type);
            return view('general.profile');
        }
        return redirect("login");
    }
}
