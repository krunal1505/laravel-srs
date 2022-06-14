<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Program;

class ProgramController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // dd(Auth::user()->user_type);
            $programs = Program::get();
            return view('programs.list', compact('programs'));
        }
        return redirect("login");
    }

    public function save(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'program_name' => 'required',
                'fees' => 'required'
            ]);
            /*$data = $request->all();
            dd($data);*/
            $data = array(
                'program_name' => $request->program_name,
                'fees' => $request->fees,
                'status' => $request->status
            );
            /*dd($data);*/
            Program::create($data);
            return redirect("programs")->with('success', 'Program Created successfully');
            /*return view('employees.create');*/
        }
        return redirect("login");
    }

    public function edit(Request $request)
    {
        $data = Program::where("id", $request->program_id)->get();
        return response()->json($data);
    }

    public function update(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'program_name' => 'required',
                'fees' => 'required'
            ]);
            $data = array(
                'program_name' => $request->program_name,
                'fees' => $request->fees,
                'status' => $request->status
            );

            Program::where('id', $request->id)->update($data);
            return redirect("programs")->with('success', 'Program Updated successfully');
            /*return view('employees.create');*/
        }
        return redirect("login");
    }

    public function destroy($id)
    {
        if (Auth::check()) {
            Program::where('id', $id)->delete();
            return redirect("programs")->with('danger', 'Program Deleted successfully');
        }
        return redirect("login");
    }
}
