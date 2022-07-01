@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update Student</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ URL::route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Update Student</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-md-center">
                <div class="col-lg-12 col-xs-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Update Student</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" action="{{ route('students.rejected_update', $student[0]->id) }}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12">
                                        <h4><b>Student Info</b></h4>
                                        <hr>
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group row">
                                            <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="first_name"
                                                       name="first_name" value="{{$student[0]->first_name}}">
                                                @if ($errors->has('first_name'))
                                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Gender</label>
                                            <div class="col-sm-9">
                                                <div class="form-group clearfix mt-2 mb-0">
                                                    <div class="icheck-primary d-inline">
                                                        <input type="radio" id="radioPrimary1" name="gender"
                                                               value="male"
                                                               @if($student[0]->gender == 'male') checked @endif>
                                                        <label for="radioPrimary1">Male</label>
                                                    </div>
                                                    <div class="icheck-primary d-inline">
                                                        <input type="radio" id="radioPrimary2" name="gender"
                                                               value="female"
                                                               @if($student[0]->gender == 'female') checked @endif>
                                                        <label for="radioPrimary2">Female</label>
                                                    </div>
                                                </div>
                                                @if ($errors->has('gender'))
                                                    <span class="text-danger">{{ $errors->first('gender') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="dob" class="col-sm-2 col-form-label">Date of birth</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" id="dob" name="dob"
                                                       value="{{$student[0]->dob}}">
                                                @if ($errors->has('dob'))
                                                    <span class="text-danger">{{ $errors->first('dob') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group row">
                                            <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="last_name" name="last_name"
                                                       value="{{$student[0]->last_name}}">
                                                @if ($errors->has('last_name'))
                                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="email" name="email"
                                                       value="{{$student[0]->email}}" disabled>
                                                @if ($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="passport_number" class="col-sm-2 col-form-label">Passport
                                                No</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="passport_number"
                                                       name="passport_number" value="{{$student[0]->passport_number}}">
                                                @if ($errors->has('passport_number'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('passport_number') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-xs-12">
                                        <hr>
                                        <h4><b>Residential Details</b></h4>
                                        <hr>
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group row">
                                            <label for="address1" class="col-sm-2 col-form-label">Address 1</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="address1"
                                                       name="address1" value="{{$student[0]->address1}}">
                                                @if ($errors->has('address1'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('address1') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="country_id" class="col-sm-2 col-form-label">Country</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="country_id" name="country_id">
                                                    <option value="" disabled selected>--- Select One ---</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{$country->id}}"
                                                                @if($student[0]->country_id == $country->id) selected @endif>{{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('country_id'))
                                                    <span class="text-danger">{{ $errors->first('country_id') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="city" class="col-sm-2 col-form-label">City</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="city"
                                                       name="city" value="{{$student[0]->city}}">
                                                @if ($errors->has('city'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('city') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group row">
                                            <label for="address2" class="col-sm-2 col-form-label">Address 2</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="address2"
                                                       name="address2" value="{{$student[0]->address2}}">
                                                @if ($errors->has('address2'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('address2') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="province_id" class="col-sm-2 col-form-label">Province /
                                                State</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="province_id" name="province_id">
                                                    @foreach($provinces as $province)
                                                        <option value="{{$province->id}}"
                                                                @if($student[0]->state_id == $province->id) selected @endif>{{$province->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('province_id'))
                                                    <span class="text-danger">{{ $errors->first('province_id') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="postal_code" class="col-sm-2 col-form-label">Postal Code</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="postal_code"
                                                       name="postal_code" value="{{$student[0]->postal_code}}">
                                                @if ($errors->has('postal_code'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('postal_code') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-xs-12">
                                        <hr>
                                        <h4><b>Program Details</b></h4>
                                        <hr>
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group row">
                                            <label for="program_id" class="col-sm-2 col-form-label">Program</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="program_id" name="program_id">
                                                    <option value="" disabled selected>--- Select One ---</option>
                                                    @foreach($programs as $program)
                                                        <option
                                                            value="{{$program->id}}" @if($student[0]->program_id == $program->id) selected @endif>
                                                            {{$program->program_name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('program_id'))
                                                    <span class="text-danger">{{ $errors->first('program_id') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group row">
                                            <label for="intake_id" class="col-sm-2 col-form-label">Intake</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="intake_id" name="intake_id">
                                                    <option value="" disabled selected>--- Select One ---</option>
                                                    @foreach($intakes as $intake)
                                                        <option value="{{$intake->id}}" @if($student[0]->intake_id == $intake->id) selected @endif>
                                                            {{$intake->start_date}} to {{$intake->end_date}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('intake_id'))
                                                    <span class="text-danger">{{ $errors->first('intake_id') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-xs-12">
                                        <hr>
                                        <h4><b>Documents</b></h4>
                                        <hr>
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group row">
                                            <label for="passport" class="col-sm-2 col-form-label">Passport</label>
                                            <div class="col-sm-9">
                                                <label class="col-form-label">
                                                    <a href="{{ Storage::url('documents/'.$student[0]->passport) }}"
                                                       download>
                                                        <i class="icon fas fa-download"></i> Download file
                                                    </a>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="education_documents" class="col-sm-2 col-form-label">Education
                                                documents</label>
                                            <div class="col-sm-9">
                                                <label class="col-form-label">
                                                    <a href="{{ Storage::url('documents/'.$student[0]->education_documents) }}"
                                                       download>
                                                        <i class="icon fas fa-download"></i> Download file
                                                    </a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group row">
                                            <label for="ielts" class="col-sm-2 col-form-label">Ielts</label>
                                            <div class="col-sm-9">
                                                <label class="col-form-label">
                                                    <a href="{{ Storage::url('documents/'.$student[0]->ielts) }}"
                                                       download>
                                                        <i class="icon fas fa-download"></i> Download file
                                                    </a>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="study_permit" class="col-sm-2 col-form-label">Study
                                                permit</label>
                                            <div class="col-sm-9">
                                                <label class="col-form-label">
                                                    <a href="{{ Storage::url('documents/'.$student[0]->study_permit) }}"
                                                       download>
                                                        <i class="icon fas fa-download"></i> Download file
                                                    </a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success"><i class="icon fas fa-save"></i> Save
                                </button>
                                <a href="{{ URL::route('students.rejected') }}" class="btn btn-danger float-right">
                                    <i class="icon fas fa-backspace"></i> Cancel
                                </a>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#country_id').on('change', function () {
                var idCountry = this.value;
                $("#province_id").html('');
                $.ajax({
                    url: "{{ URL::route('fetch-provinces') }}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#province_id').html('<option value="" selected disabled>--- Select State ---</option>');
                        $.each(result.provinces, function (key, value) {
                            $("#province_id").append(
                                `<option value="${value.id}">${value.name}</option>`
                            );
                        });
                    }
                });
            });
        });
    </script>
@endsection
