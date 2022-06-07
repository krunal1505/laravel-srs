<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard()
    {
        if(Auth::check()) {
            return view('general.dashboard');
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
}
