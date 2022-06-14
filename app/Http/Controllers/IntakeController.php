<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Intake;

class IntakeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // dd(Auth::user()->user_type);
            $intakes = Intake::get();
            return view('intakes.list', compact('intakes'));
        }
        return redirect("login");
    }

    public function save(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'start_date' => 'required',
                'end_date' => 'required'
            ]);

            $data = array(
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            );

            Intake::create($data);
            return redirect("intakes")->with('success', 'Intake Created successfully');
            /*return view('employees.create');*/
        }
        return redirect("login");
    }

    public function destroy($id)
    {
        if (Auth::check()) {
            Intake::where('id', $id)->delete();
            return redirect("intakes")->with('danger', 'Intake Deleted successfully');
        }
        return redirect("login");
    }
}
