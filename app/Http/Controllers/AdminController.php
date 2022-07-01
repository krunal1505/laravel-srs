<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // dd(Auth::user()->user_type);
            $admins = User::where('user_type', 'sub_admin')->get();
            return view('admin.list', compact('admins'));
        }
        return redirect("login");
    }

    public function create()
    {
        if (Auth::check()) {
            return view('admin.create');
        }
        return redirect("login");
    }

    public function save(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required|min:6',
                'phone' => 'required',
            ]);
            /*$data = $request->all();
            dd($data);*/
            $admin_data = array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'user_type' => 'sub_admin',
                'status' => $request->status
            );
            /*dd($data);*/
            User::create($admin_data);
            return redirect("admin")->with('success', 'Admin Created successfully');
        }
        return redirect("login");
    }

    public function edit($id)
    {
        if (Auth::check()) {
            $admin = User::where('id', $id)->get();
            return view('admin.edit', compact('admin'));
        }
        return redirect("login");
    }

    public function update(Request $request, $id)
    {
        if (Auth::check()) {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required',
            ]);
            /*$data = $request->all();
            dd($data);*/
            $admin_data = array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'status' => $request->status
            );
            User::whereId($id)->update($admin_data);
            return redirect("admin")->with('success', 'Admin Updated successfully');
        }
        return redirect("login");
    }

    public function destroy($id)
    {
        if (Auth::check()) {
            $admin = User::findOrFail($id);
            $admin->delete();
            return redirect("admin")->with('danger', 'Admin Deleted successfully');
        }
        return redirect("login");
    }
}
