<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;

class GeneralController extends Controller
{
    public function dashboard()
    {
        if (Auth::check()) {
            return view('general.dashboard');
        }
        return redirect("login");
    }

    public function profile()
    {
        if (Auth::check()) {
            $user = User::where('id', Auth::user()->id)->get();
            return view('general.profile', compact('user'));
        }
        return redirect("login");
    }

    public function profile_update(Request $request, $id)
    {
        if (Auth::check()) {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required',
            ]);

            $data = array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone
            );
            User::whereId($id)->update($data);
            return redirect("profile")->with('success', 'Profile Updated successfully');
        }
        return redirect("login");
    }

    public function profile_update_password(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'password_conf' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return redirect("profile")->with('success', 'Password Updated successfully');
    }
}
