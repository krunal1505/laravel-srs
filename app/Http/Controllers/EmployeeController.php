<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Models\User;

class EmployeeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // dd(Auth::user()->user_type);
            $employees = User::where('user_type', 'employee')->get();
            return view('employees.list', compact('employees'));
        }
        return redirect("login");
    }

    public function create()
    {
        if (Auth::check()) {
            return view('employees.create');
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
            $employee_data = array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'user_type' => 'employee',
                'status' => $request->status
            );
            /*dd($data);*/
            User::create($employee_data);
            return redirect("employees")->with('success', 'Employee Created successfully');
            /*return view('employees.create');*/
        }
        return redirect("login");
    }

    public function edit($id)
    {
        if (Auth::check()) {
            $employee = User::where('id', $id)->get();
            return view('employees.edit', compact('employee'));
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
            $employee_data = array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'status' => $request->status
            );
            User::whereId($id)->update($employee_data);
            return redirect("employees")->with('success', 'Employee Updated successfully');
            /*return view('employees.create');*/
        }
        return redirect("login");
    }

    public function destroy($id)
    {
        if (Auth::check()) {
            $employee = User::findOrFail($id);
            $employee->delete();
            return redirect("employees")->with('danger', 'Employee Deleted successfully');
        }
        return redirect("login");
    }
}
