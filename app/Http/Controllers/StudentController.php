<?php

namespace App\Http\Controllers;

use App\Models\Intake;
use App\Models\Program;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function create()
    {
        if (Auth::check()) {
            $programs = Program::get();
            $intakes = Intake::get();
            $countries = Country::get();
            return view('students.create', compact('programs', 'intakes', 'countries'));
        }
        return redirect("login");
    }
}
