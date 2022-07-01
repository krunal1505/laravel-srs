<?php

namespace App\Http\Controllers;

use App\Models\Intake;
use App\Models\Program;
use App\Models\Country;
use App\Models\State;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function create()
    {
        if (Auth::check()) {
            $user_type = Auth::user()->user_type;
            $programs = Program::get();
            $intakes = Intake::where('start_date', '>=', date('Y-m-d'))->get();
            $countries = Country::get();
            return view('students.create', compact('programs', 'intakes', 'countries', 'user_type'));
        }
        return redirect("login");
    }

    public function save(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'email' => 'required|unique:students',
                'dob' => 'required',
                'passport_number' => 'required',
                'address1' => 'required',
                'country_id' => 'required',
                'province_id' => 'required',
                'city' => 'required',
                'postal_code' => 'required',
                'program_id' => 'required',
                'intake_id' => 'required',
                'passport' => 'required|mimes:jpg,jpeg,png,pdf',
                'ielts' => 'required|mimes:jpg,jpeg,png,pdf',
                'education_documents' => 'required|mimes:jpg,jpeg,png,pdf'
            ]);

            if ($request->hasFile('passport')) {
                $passportWithExt = $request->file('passport')->getClientOriginalName();
                $passportName = pathinfo($passportWithExt, PATHINFO_FILENAME);
                $passportExtension = $request->file('passport')->getClientOriginalExtension();
                $passportToStore = $passportName . '_' . time() . '.' . $passportExtension;
                $passportPath = $request->file('passport')->storeAs('public/documents', $passportToStore);
            }
            if ($request->hasFile('ielts')) {
                $ieltsWithExt = $request->file('ielts')->getClientOriginalName();
                $ieltsName = pathinfo($ieltsWithExt, PATHINFO_FILENAME);
                $ieltsExtension = $request->file('ielts')->getClientOriginalExtension();
                $ieltsToStore = $ieltsName . '_' . time() . '.' . $ieltsExtension;
                $ieltsPath = $request->file('ielts')->storeAs('public/documents', $ieltsToStore);
            }
            if ($request->hasFile('education_documents')) {
                $education_documentsWithExt = $request->file('education_documents')->getClientOriginalName();
                $education_documentsName = pathinfo($education_documentsWithExt, PATHINFO_FILENAME);
                $education_documentsExtension = $request->file('education_documents')->getClientOriginalExtension();
                $education_documentsToStore = $education_documentsName . '_' . time() . '.' . $education_documentsExtension;
                $education_documentsPath = $request->file('education_documents')->storeAs('public/documents', $education_documentsToStore);
            }
            if ($request->hasFile('study_permit')) {
                $study_permitWithExt = $request->file('study_permit')->getClientOriginalName();
                $study_permitName = pathinfo($study_permitWithExt, PATHINFO_FILENAME);
                $study_permitExtension = $request->file('study_permit')->getClientOriginalExtension();
                $study_permitToStore = $study_permitName . '_' . time() . '.' . $study_permitExtension;
                $study_permitPath = $request->file('study_permit')->storeAs('public/documents', $study_permitToStore);
            } else {
                $study_permitToStore = null;
            }
            if (Auth::user()->user_type == 'admin') {
                $is_private = $request->is_private;
            } else {
                $is_private = 'no';
            }

            $data = array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'email' => $request->email,
                'dob' => $request->dob,
                'passport_number' => $request->passport_number,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'country_id' => $request->country_id,
                'state_id' => $request->province_id,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'program_id' => $request->program_id,
                'intake_id' => $request->intake_id,
                'passport' => $passportToStore,
                'ielts' => $ieltsToStore,
                'education_documents' => $education_documentsToStore,
                'study_permit' => $study_permitToStore,
                'user_type' => $user = Auth::user()->user_type,
                'status' => 'new',
                'created_by' => $user = Auth::user()->id,
                'is_private' => $is_private,
            );

            Student::create($data);
            return redirect("students/new")->with('success', 'Student Profile Created successfully');
        }
        return redirect("login");
    }

    public function new_list()
    {
        if (Auth::check()) {
            if (Auth::user()->user_type == 'admin') {
                $students = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                    ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                    /*->leftJoin('users', 'students.created_by', '=', 'users.id')*/
                    ->where('students.status', 'new')
                    ->latest('students.created_at')
                    ->get();
            } else if (Auth::user()->user_type == 'employee' || Auth::user()->user_type == 'sub_admin') {
                $students = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                    ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                    ->where('students.status', 'new')
                    ->where('is_private', 'no')
                    ->latest('students.created_at')
                    ->get();
            } else {
                $students = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                    ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                    ->where('students.status', 'new')
                    ->where('is_private', 'no')
                    ->where('created_by', Auth::user()->id)
                    ->latest('students.created_at')
                    ->get();
            }
            return view('students.new_list', compact('students'));
        }
        return redirect("login");
    }

    public function new_view($id)
    {
        if (Auth::check()) {
            $user_type = Auth::user()->user_type;
            $student = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                ->where('students.id', $id)
                ->get();
            return view('students.new_view', compact('student', 'user_type'));
        }
        return redirect("login");
    }

    public function new_update_status(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'id' => 'required',
                'status' => 'required',
                'notes' => 'required'
            ]);
            $data = array(
                'status' => $request->status,
                'notes' => $request->notes
            );

            Student::where('id', $request->id)->update($data);
            return redirect("students/new")->with('success', 'Student Updated successfully');
        }
        return redirect("login");
    }

    public function new_edit($id)
    {
        if (Auth::check()) {
            $user_type = Auth::user()->user_type;
            $programs = Program::get();
            $intakes = Intake::where('start_date', '>=', date('Y-m-d'))->get();
            $countries = Country::get();
            $provinces = State::get();
            $student = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                ->where('students.id', $id)
                ->get();
            return view('students.new_edit', compact('student', 'user_type',
                'programs', 'intakes', 'countries', 'provinces'));
        }
        return redirect("login");
    }

    public function new_update(Request $request, $id)
    {
        if (Auth::check()) {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'dob' => 'required',
                'passport_number' => 'required',
                'address1' => 'required',
                'country_id' => 'required',
                'province_id' => 'required',
                'city' => 'required',
                'postal_code' => 'required',
                'program_id' => 'required',
                'intake_id' => 'required',
            ]);

            $data = array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'passport_number' => $request->passport_number,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'country_id' => $request->country_id,
                'state_id' => $request->province_id,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'program_id' => $request->program_id,
                'intake_id' => $request->intake_id,
                'is_private' => $request->is_private,
            );

            Student::where('id', $id)->update($data);
            return redirect("students/new")->with('success', 'Student Profile Updated successfully');
        }
        return redirect("login");
    }

    public function enrolled_list()
    {
        if (Auth::check()) {
            if (Auth::user()->user_type == 'admin') {
                $students = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                    ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                    /*->leftJoin('users', 'students.created_by', '=', 'users.id')*/
                    ->where('students.status', 'approved')
                    ->latest('students.created_at')
                    ->get();
            } else if (Auth::user()->user_type == 'employee' || Auth::user()->user_type == 'sub_admin') {
                $students = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                    ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                    ->where('students.status', 'approved')
                    ->where('is_private', 'no')
                    ->latest('students.created_at')
                    ->get();
            } else {
                $students = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                    ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                    ->where('students.status', 'approved')
                    ->where('is_private', 'no')
                    ->where('created_by', Auth::user()->id)
                    ->latest('students.created_at')
                    ->get();
            }
            return view('students.enrolled_list', compact('students'));
        }
        return redirect("login");
    }

    public function enrolled_view($id)
    {
        if (Auth::check()) {
            $user_type = Auth::user()->user_type;
            $student = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                ->where('students.id', $id)
                ->get();
            return view('students.enrolled_view', compact('student', 'user_type'));
        }
        return redirect("login");
    }

    public function enrolled_edit($id)
    {
        if (Auth::check()) {
            $user_type = Auth::user()->user_type;
            $programs = Program::get();
            $intakes = Intake::where('start_date', '>=', date('Y-m-d'))->get();
            $countries = Country::get();
            $provinces = State::get();
            $student = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                ->where('students.id', $id)
                ->get();
            return view('students.enrolled_edit', compact('student', 'user_type',
                'programs', 'intakes', 'countries', 'provinces'));
        }
        return redirect("login");
    }

    public function enrolled_update(Request $request, $id)
    {
        if (Auth::check()) {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'dob' => 'required',
                'passport_number' => 'required',
                'address1' => 'required',
                'country_id' => 'required',
                'province_id' => 'required',
                'city' => 'required',
                'postal_code' => 'required',
                'program_id' => 'required',
                'intake_id' => 'required',
            ]);

            $data = array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'passport_number' => $request->passport_number,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'country_id' => $request->country_id,
                'state_id' => $request->province_id,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'program_id' => $request->program_id,
                'intake_id' => $request->intake_id,
            );

            Student::where('id', $id)->update($data);
            return redirect("students/enrolled")->with('success', 'Student Profile Updated successfully');
        }
        return redirect("login");
    }

    public function rejected_list()
    {
        if (Auth::check()) {
            if (Auth::user()->user_type == 'admin') {
                $students = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                    ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                    /*->leftJoin('users', 'students.created_by', '=', 'users.id')*/
                    ->where('students.status', 'rejected')
                    ->latest('students.created_at')
                    ->get();
            } else if (Auth::user()->user_type == 'employee' || Auth::user()->user_type == 'sub_admin') {
                $students = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                    ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                    ->where('students.status', 'rejected')
                    ->where('is_private', 'no')
                    ->latest('students.created_at')
                    ->get();
            } else {
                $students = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                    ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                    ->where('students.status', 'rejected')
                    ->where('is_private', 'no')
                    ->where('created_by', Auth::user()->id)
                    ->latest('students.created_at')
                    ->get();
            }
            return view('students.rejected_list', compact('students'));
        }
        return redirect("login");
    }

    public function rejected_view($id)
    {
        if (Auth::check()) {
            $user_type = Auth::user()->user_type;
            $student = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                ->where('students.id', $id)
                ->get();
            return view('students.rejected_view', compact('student', 'user_type'));
        }
        return redirect("login");
    }

    public function rejected_edit($id)
    {
        if (Auth::check()) {
            $user_type = Auth::user()->user_type;
            $programs = Program::get();
            $intakes = Intake::where('start_date', '>=', date('Y-m-d'))->get();
            $countries = Country::get();
            $provinces = State::get();
            $student = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                ->where('students.id', $id)
                ->get();
            return view('students.rejected_edit', compact('student', 'user_type',
                'programs', 'intakes', 'countries', 'provinces'));
        }
        return redirect("login");
    }

    public function rejected_update(Request $request, $id)
    {
        if (Auth::check()) {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'dob' => 'required',
                'passport_number' => 'required',
                'address1' => 'required',
                'country_id' => 'required',
                'province_id' => 'required',
                'city' => 'required',
                'postal_code' => 'required',
                'program_id' => 'required',
                'intake_id' => 'required',
            ]);

            $data = array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'passport_number' => $request->passport_number,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'country_id' => $request->country_id,
                'state_id' => $request->province_id,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'program_id' => $request->program_id,
                'intake_id' => $request->intake_id,
            );

            Student::where('id', $id)->update($data);
            return redirect("students/rejected")->with('success', 'Student Profile Updated successfully');
        }
        return redirect("login");
    }
}
