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
            /*if (Auth::user()->user_type == 'admin') {
                $students = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                    ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
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
            }*/
            return view('students.new_list');
        }
        return redirect("login");
    }

    public function new_list_ajax(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        if (Auth::user()->user_type == 'admin') {
            $totalRecords = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                ->where('students.status', 'new')
                ->count();
            $totalRecordswithFilter = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                ->where(function ($query) use ($searchValue) {
                    $query->where('first_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('last_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('email', 'like', '%' . $searchValue . '%');
                })
                ->where('students.status', 'new')
                ->where('first_name', 'like', '%' . $searchValue . '%')
                ->where('last_name', 'like', '%' . $searchValue . '%')
                ->where('email', 'like', '%' . $searchValue . '%')
                ->where('students.status', 'new')
                ->count();

            $records = Student::orderBy($columnName, $columnSortOrder)
                ->select('students.*', 'program_name', 'start_date')
                ->leftJoin('programs', 'students.program_id', '=', 'programs.id')
                ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                ->where(function ($query) use ($searchValue) {
                    $query->where('first_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('last_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('email', 'like', '%' . $searchValue . '%');
                })
                ->where('students.status', 'new')
                ->skip($start)
                ->take($rowperpage)
                ->get();

            $data_arr = array();
            $sno = $start + 1;
            foreach ($records as $record) {
                $id = $record->id;
                $first_name = $record->first_name;
                $last_name = $record->last_name;
                $email = $record->email;
                $program_name = $record->program_name;
                $start_date = $record->start_date;
                $action = '<a href="' . route('students.new.view', $id) . '" class="btn btn-info btn-flat" data-toggle="tooltip"><i class="fa fa-eye"></i></a>';
                $data_arr[] = array(
                    "id" => $id,
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "email" => $email,
                    "program" => $program_name,
                    "start_date" => $start_date,
                    "action" => $action
                );
            }
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordswithFilter,
                "aaData" => $data_arr
            );
            echo json_encode($response);
            exit;
        } else if (Auth::user()->user_type == 'employee' || Auth::user()->user_type == 'sub_admin') {
            $totalRecords = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                ->where('students.status', 'new')
                ->where('is_private', 'no')
                ->count();
            $totalRecordswithFilter = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                ->where(function ($query) use ($searchValue) {
                    $query->where('first_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('last_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('email', 'like', '%' . $searchValue . '%');
                })
                ->where('students.status', 'new')
                ->where('is_private', 'no')
                ->where('first_name', 'like', '%' . $searchValue . '%')
                ->where('last_name', 'like', '%' . $searchValue . '%')
                ->where('email', 'like', '%' . $searchValue . '%')
                ->where('students.status', 'new')
                ->count();

            $records = Student::orderBy($columnName, $columnSortOrder)
                ->select('students.*', 'program_name', 'start_date')
                ->leftJoin('programs', 'students.program_id', '=', 'programs.id')
                ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                ->where(function ($query) use ($searchValue) {
                    $query->where('first_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('last_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('email', 'like', '%' . $searchValue . '%');
                })
                ->where('students.status', 'new')
                ->where('is_private', 'no')
                ->skip($start)
                ->take($rowperpage)
                ->get();

            $data_arr = array();
            $sno = $start + 1;
            foreach ($records as $record) {
                $id = $record->id;
                $first_name = $record->first_name;
                $last_name = $record->last_name;
                $email = $record->email;
                $program_name = $record->program_name;
                $start_date = $record->start_date;
                $action = '<a href="' . route('students.new.view', $id) . '" class="btn btn-info btn-flat" data-toggle="tooltip"><i class="fa fa-eye"></i></a>';
                $data_arr[] = array(
                    "id" => $id,
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "email" => $email,
                    "program" => $program_name,
                    "start_date" => $start_date,
                    "action" => $action
                );
            }
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordswithFilter,
                "aaData" => $data_arr
            );
            echo json_encode($response);
            exit;
        } else {
            $totalRecords = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                ->where('students.status', 'new')
                ->where('is_private', 'no')
                ->where('created_by', Auth::user()->id)
                ->count();
            $totalRecordswithFilter = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                ->where(function ($query) use ($searchValue) {
                    $query->where('first_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('last_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('email', 'like', '%' . $searchValue . '%');
                })
                ->where('students.status', 'new')
                ->where('is_private', 'no')
                ->where('created_by', Auth::user()->id)
                ->where('first_name', 'like', '%' . $searchValue . '%')
                ->where('last_name', 'like', '%' . $searchValue . '%')
                ->where('email', 'like', '%' . $searchValue . '%')
                ->where('students.status', 'new')
                ->count();

            $records = Student::orderBy($columnName, $columnSortOrder)
                ->select('students.*', 'program_name', 'start_date')
                ->leftJoin('programs', 'students.program_id', '=', 'programs.id')
                ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                ->where(function ($query) use ($searchValue) {
                    $query->where('first_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('last_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('email', 'like', '%' . $searchValue . '%');
                })
                ->where('students.status', 'new')
                ->where('is_private', 'no')
                ->where('created_by', Auth::user()->id)
                ->skip($start)
                ->take($rowperpage)
                ->get();

            $data_arr = array();
            $sno = $start + 1;
            foreach ($records as $record) {
                $id = $record->id;
                $first_name = $record->first_name;
                $last_name = $record->last_name;
                $email = $record->email;
                $program_name = $record->program_name;
                $start_date = $record->start_date;
                $action = '<a href="' . route('students.new.view', $id) . '" class="btn btn-info btn-flat" data-toggle="tooltip"><i class="fa fa-eye"></i></a>';
                $data_arr[] = array(
                    "id" => $id,
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "email" => $email,
                    "program" => $program_name,
                    "start_date" => $start_date,
                    "action" => $action
                );
            }
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordswithFilter,
                "aaData" => $data_arr
            );
            echo json_encode($response);
            exit;
        }
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
            /*if (Auth::user()->user_type == 'admin') {
                $students = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                    ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
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
            }*/
            return view('students.enrolled_list');
        }
        return redirect("login");
    }

    public function enrolled_list_ajax(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        if (Auth::user()->user_type == 'admin') {
            $totalRecords = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                ->where('students.status', 'approved')
                ->count();
            $totalRecordswithFilter = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                ->where(function ($query) use ($searchValue) {
                    $query->where('first_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('last_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('email', 'like', '%' . $searchValue . '%');
                })
                //->where('students.status', 'new')
                ->where('first_name', 'like', '%' . $searchValue . '%')
                ->where('last_name', 'like', '%' . $searchValue . '%')
                ->where('email', 'like', '%' . $searchValue . '%')
                ->where('students.status', 'approved')
                ->count();

            $records = Student::orderBy($columnName, $columnSortOrder)
                ->select('students.*', 'program_name', 'start_date')
                ->leftJoin('programs', 'students.program_id', '=', 'programs.id')
                ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                ->where(function ($query) use ($searchValue) {
                    $query->where('first_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('last_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('email', 'like', '%' . $searchValue . '%');
                })
                ->where('students.status', 'approved')
                ->skip($start)
                ->take($rowperpage)
                ->get();

            $data_arr = array();
            $sno = $start + 1;
            foreach ($records as $record) {
                $id = $record->id;
                $first_name = $record->first_name;
                $last_name = $record->last_name;
                $email = $record->email;
                $program_name = $record->program_name;
                $start_date = $record->start_date;
                $action = '<a href="' . route('students.generate', $id) . '" class="btn btn-secondary btn-flat" data-toggle="tooltip"><i class="fa fa-file"></i></a><a href="' . route('students.enrolled.view', $id) . '" class="btn btn-info btn-flat" data-toggle="tooltip"><i class="fa fa-eye"></i></a><a href="' . route('students.enrolled.edit', $id) . '" class="btn btn-warning btn-flat" data-toggle="tooltip"><i class="fa fa-edit"></i></a>';
                $data_arr[] = array(
                    "id" => $id,
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "email" => $email,
                    "program" => $program_name,
                    "start_date" => $start_date,
                    "action" => $action
                );
            }
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordswithFilter,
                "aaData" => $data_arr
            );
            echo json_encode($response);
            exit;
        } else if (Auth::user()->user_type == 'employee' || Auth::user()->user_type == 'sub_admin') {
            $totalRecords = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                ->where('students.status', 'new')
                ->where('is_private', 'no')
                ->count();
            $totalRecordswithFilter = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                ->where(function ($query) use ($searchValue) {
                    $query->where('first_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('last_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('email', 'like', '%' . $searchValue . '%');
                })
                ->where('students.status', 'new')
                ->where('is_private', 'no')
                ->where('first_name', 'like', '%' . $searchValue . '%')
                ->where('last_name', 'like', '%' . $searchValue . '%')
                ->where('email', 'like', '%' . $searchValue . '%')
                ->where('students.status', 'new')
                ->count();

            $records = Student::orderBy($columnName, $columnSortOrder)
                ->select('students.*', 'program_name', 'start_date')
                ->leftJoin('programs', 'students.program_id', '=', 'programs.id')
                ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                ->where(function ($query) use ($searchValue) {
                    $query->where('first_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('last_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('email', 'like', '%' . $searchValue . '%');
                })
                ->where('students.status', 'new')
                ->where('is_private', 'no')
                ->skip($start)
                ->take($rowperpage)
                ->get();

            $data_arr = array();
            $sno = $start + 1;
            foreach ($records as $record) {
                $id = $record->id;
                $first_name = $record->first_name;
                $last_name = $record->last_name;
                $email = $record->email;
                $program_name = $record->program_name;
                $start_date = $record->start_date;
                $action = '<a href="' . route('students.enrolled.view', $id) . '" class="btn btn-info btn-flat" data-toggle="tooltip"><i class="fa fa-eye"></i></a>';
                $data_arr[] = array(
                    "id" => $id,
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "email" => $email,
                    "program" => $program_name,
                    "start_date" => $start_date,
                    "action" => $action
                );
            }
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordswithFilter,
                "aaData" => $data_arr
            );
            echo json_encode($response);
            exit;
        } else {
            $totalRecords = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                ->where('students.status', 'approved')
                ->where('is_private', 'no')
                ->where('created_by', Auth::user()->id)
                ->count();
            $totalRecordswithFilter = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
                ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                ->where(function ($query) use ($searchValue) {
                    $query->where('first_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('last_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('email', 'like', '%' . $searchValue . '%');
                })
                //->where('students.status', 'new')
                ->where('is_private', 'no')
                ->where('created_by', Auth::user()->id)
                ->where('first_name', 'like', '%' . $searchValue . '%')
                ->where('last_name', 'like', '%' . $searchValue . '%')
                ->where('email', 'like', '%' . $searchValue . '%')
                ->where('students.status', 'approved')
                ->count();

            $records = Student::orderBy($columnName, $columnSortOrder)
                ->select('students.*', 'program_name', 'start_date')
                ->leftJoin('programs', 'students.program_id', '=', 'programs.id')
                ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
                ->where(function ($query) use ($searchValue) {
                    $query->where('first_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('last_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('email', 'like', '%' . $searchValue . '%');
                })
                ->where('students.status', 'approved')
                ->where('is_private', 'no')
                ->where('created_by', Auth::user()->id)
                ->skip($start)
                ->take($rowperpage)
                ->get();

            $data_arr = array();
            $sno = $start + 1;
            foreach ($records as $record) {
                $id = $record->id;
                $first_name = $record->first_name;
                $last_name = $record->last_name;
                $email = $record->email;
                $program_name = $record->program_name;
                $start_date = $record->start_date;
                $action = '<a href="' . route('students.enrolled.view', $id) . '" class="btn btn-info btn-flat" data-toggle="tooltip"><i class="fa fa-eye"></i></a>';
                $data_arr[] = array(
                    "id" => $id,
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "email" => $email,
                    "program" => $program_name,
                    "start_date" => $start_date,
                    "action" => $action
                );
            }
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordswithFilter,
                "aaData" => $data_arr
            );
            echo json_encode($response);
            exit;
        }
    }

    public function generate($id)
    {
        $student = Student::leftJoin('programs', 'students.program_id', '=', 'programs.id')
            ->leftJoin('intakes', 'students.intake_id', '=', 'intakes.id')
            ->where('students.id', $id)
            ->get();
//        dd($student[0]);
        $html = '<!DOCTYPE html>
            <html>
            <head>
                <title> Letter of Acceptance </title>
            </head>
            <body style="margin: 0;">
            <h4 style="color: #1F497D; margin-bottom: 0;font-size: medium;"><b>Trillium Esthetic and Hair Technology College</b></h4>
            <small style="margin: 0">989 Derry Road East, Suite 401 <br>
            Mississauga, L5T 2J8, Canada <br>
            Tel: (647)-612-5899 Fax: (905)-886-8108</small>
            <p style="color: #1F497D; text-align: center; font-size: medium;"><b>Letter of Acceptance</b></p>
            <small>PERSONAL INFORMATION</small> <small style="float: right">Date: ' . date("Y-m-d") . '</small>
            <table border="1px" style="width: 100%; font-size: x-small;">
                <tr>
                    <td style="padding: 5px;" colspan="2"><small>Family Name: '.$student[0]->last_name.'</small></td>
                    <td style="padding: 5px;" colspan="2"><small>Given Name: '.$student[0]->first_name.'</small></td>
                </tr>
                <tr>
                    <td style="padding: 5px;" colspan="2"><small>Date of Birth: '.$student[0]->dob.'</small></td>
                    <td style="padding: 5px;" colspan="2"><small>Student ID No: </small></td>
                </tr>
                <tr>
                    <td style="padding: 5px; border-bottom: 0px; border-left: 0px; border-right: 0px;" colspan="4">
                    <small>
                    Certificate d`acceptation du Quebec (CAQ) or Ministere de l`Immigration, Diversite et Inclusion (MIDI) letter <br>
                    </small>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0px 5px 5px 5px; border: 0px;">
                        <small>
                            <input style="" type="checkbox"> Yes
                            <input style="" type="checkbox" checked="checked"> No
                        </small>
                    </td>
                    <td style="padding: 0px 5px 5px 5px; border: 0px;">Expiry: N/A</td>
                </tr>
                <tr>
                    <td style="padding: 5px;"><small>Student Full Mailing Address </small></td>
                    <td style="padding: 5px;"><small>PO Box: </small></td>
                    <td style="padding: 5px;"><small>Apt/Unit: </small></td>
                    <td style="padding: 5px;"><small>Street No: </small></td>
                </tr>
                <tr>
                    <td style="padding: 5px;" colspan="2"><small>Street Name: '.$student[0]->address1.'</small></td>
                    <td style="padding: 5px;"><small>City: '.$student[0]->city.'</small></td>
                    <td style="padding: 5px;"><small>Province: '.$student[0]->state_id.'</small></td>
                </tr>
                <tr>
                    <td style="padding: 5px;" colspan="2"><small>Country: '.$student[0]->country_id.'</small></td>
                    <td style="padding: 5px;" colspan="2"><small>Postal/Zip Code: '.$student[0]->postal_code.'</small></td>
                </tr>
            </table>
            <br>
            <small>INSTITUTIONAL INFORMATION</small>
            <table border="1px" style="width: 100%; font-size: x-small;">
                <tr>
                    <td style="padding: 5px;" colspan="2">
                        <small>Full name of institution: <br>Trillium Esthetics and Hair Technology College</small>
                    </td>
                    <td style="padding: 5px;" colspan="2">
                        <small>Designated learning institution number: O19332628162</small>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 5px;" colspan="4"><small>Address of institution </small></td>
                </tr>
                <tr>
                    <td style="padding: 5px;"><small>P.O. Box</small></td>
                    <td style="padding: 5px;"><small>Street no: 989</small></td>
                    <td style="padding: 5px;" colspan="2">
                        <small>Street Name: Derry Road East, Suite 401</small>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 5px;"><small>City: Mississauga</small></td>
                    <td style="padding: 5px;"><small>Province: ON</small></td>
                    <td style="padding: 5px;" colspan="2">
                        <small>Postal Code: L5T 2J8</small>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 5px;"><small>Telephone: <br>(905)-882-0012</small></td>
                    <td style="padding: 5px;"><small>Fax Number: <br>(905)-886-8108</small></td>
                    <td style="padding: 5px;" colspan="2">
                        <small>
                            Type of School/Institute
                            <input type="checkbox"> Public
                            <input type="checkbox" checked="checked"> Private
                        </small>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 5px;" colspan="2"><small>Website: www.trilliumestheticsschool.ca </small></td>
                    <td style="padding: 5px;" colspan="2"><small>Email: info@trilliumestheticsschool.ca</small></td>
                </tr>
                <tr>
                    <td style="padding: 5px;"><small>Name of Contact: <br>Kiranvir Raol</small></td>
                    <td style="padding: 5px;"><small>Position: Administrator</small></td>
                    <td style="padding: 5px;"><small>Telephone Number: <br>(647)-720-5799</small></td>
                    <td style="padding: 5px;"><small>Extension: </small></td>
                </tr>
                <tr>
                    <td style="padding: 5px;"><small>Name of Alternate Contact: <br>Arshdeep Kaur</small></td>
                    <td style="padding: 5px;"><small>Position: Coordinator</small></td>
                    <td style="padding: 5px;"><small>Telephone Number: <br>(647)-612-5899</small></td>
                    <td style="padding: 5px;"><small>Extension: </small></td>
                </tr>
            </table>
            <br>
            <small>PROGRAM INFORMATION</small>
            <table border="1px" style="width: 100%; font-size: x-small;">
                <tr>
                    <td style="padding: 5px;">
                        <small>
                            Academic Status: <br>
                            <input type="checkbox" checked="checked"> Full Time
                            <input type="checkbox">  Part-Time
                        </small>
                    </td>
                    <td style="padding: 5px;">
                        <small>Hours of Institution Per week: <br>20 hours</small>
                    </td>
                    <td style="padding: 5px;">
                        <small>Field/Program of Study: <br>Esthetics Program</small>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 5px;">
                        <small>Level of Study: Diploma</small>
                    </td>
                    <td style="padding: 5px;" colspan="2">
                        <small>
                            Type of Training Program:
                            <input type="checkbox" checked="checked"> Vocational
                            <input type="checkbox"> Academic
                            <input type="checkbox"> Professional
                        </small>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 5px;">
                        <small>
                            Exchange Program:
                            <input type="checkbox"> Yes
                            <input type="checkbox" checked="checked"> No
                        </small>
                    </td>
                    <td style="padding: 5px;" colspan="2">
                        <small>
                            Estimated Tuition Fees for Academic Year: $9000<br>
                            Fees prepaid:
                            <input type="checkbox"> Yes
                            <input type="checkbox" checked="checked"> No
                        </small>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 5px; width: 50%;">
                        <small>
                            Scholarship/Teaching assistantship/Other financial aid: <br>
                            <input type="checkbox"> Yes. Specify: &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="checkbox" checked="checked"> No
                        </small>
                    </td>
                    <td style="padding: 5px;">
                        <small>
                            Internship/Work Permit: <br>
                            <input type="checkbox"> Yes
                            <input type="checkbox" checked="checked"> No
                        </small>
                    </td>
                    <td style="padding: 5px;">
                        <small>
                            Length of Program: <br>
                            1 Year
                        </small>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 5px;" colspan="3">
                        <small>Conditions of acceptance specified as clearly as possible: N/A</small>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 5px; width: 50%;">
                        <small>
                            Length of Program (YYYY/MM/DD): <br>
                            Start Date: 2022/01/01 End Date: 2022/01/01
                        </small>
                    </td>
                    <td style="padding: 5px;" colspan="2">
                        <small>
                            Expiration of letter of acceptance (YYYY/MM/DD)
                        </small>
                    </td>
                </tr>
            </table>
            <br>
            <small>Signature of institution representative (e.g., Registrar): ______________________________________________________</small><br>
            <small>Printed name of institution representative: </small>
            </body>
            </html>';

        $pdf = \App::make('dompdf.wrapper');
        // $pdf = PDF::stream('front.mobile.order.invoice', $data);
        $pdf->loadHTML($html);
        return $pdf->stream('test.pdf');
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
