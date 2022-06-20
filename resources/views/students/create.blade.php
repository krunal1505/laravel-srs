@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Register new Student</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ URL::route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Create Student</li>
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
                            <h3 class="card-title">Register new Student</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" action="{{ route('students.save') }}" method="post"
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
                                                       name="first_name">
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
                                                        <input type="radio" id="radioPrimary1" name="gender" checked=""
                                                               value="male">
                                                        <label for="radioPrimary1">Male</label>
                                                    </div>
                                                    <div class="icheck-primary d-inline">
                                                        <input type="radio" id="radioPrimary2" name="gender"
                                                               value="female">
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
                                                <input type="date" class="form-control" id="dob" name="dob">
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
                                                <input type="text" class="form-control" id="last_name" name="last_name">
                                                @if ($errors->has('last_name'))
                                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="email" name="email">
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
                                                       name="passport_number">
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
                                                       name="address1">
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
                                                        <option value="{{$country->id}}">{{$country->name}}</option>
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
                                                       name="city">
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
                                                       name="address2">
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
                                                       name="postal_code">
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
                                                        <option value="{{$program->id}}">{{$program->program_name}}</option>
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
                                                        <option value="{{$intake->id}}">
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
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="passport"
                                                           id="passport">
                                                </div>
                                                @if ($errors->has('passport'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('passport') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="education_documents" class="col-sm-2 col-form-label">Education
                                                documents</label>
                                            <div class="col-sm-9">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control"
                                                           name="education_documents"
                                                           id="education_documents">
                                                </div>
                                                @if ($errors->has('education_documents'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('education_documents') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        @if($user_type == 'admin')
                                            <div class="form-group row">
                                                <label for="is_private" class="col-sm-2 col-form-label">Keep
                                                    private</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="is_private" name="is_private">
                                                        <option value="no" selected>No</option>
                                                        <option value="yes">Yes</option>
                                                    </select>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group row">
                                            <label for="ielts" class="col-sm-2 col-form-label">Ielts</label>
                                            <div class="col-sm-9">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="ielts"
                                                           id="ielts">
                                                </div>
                                                @if ($errors->has('ielts'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('ielts') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="study_permit" class="col-sm-2 col-form-label">Study
                                                permit</label>
                                            <div class="col-sm-9">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="study_permit"
                                                           id="study_permit">
                                                </div>
                                                @if ($errors->has('study_permit'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('study_permit') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success"><i class="icon fas fa-save"></i> Save
                                </button>
                                {{--<a href="{{ URL::route('agents') }}" class="btn btn-danger float-right">
                                    <i class="icon fas fa-backspace"></i> Cancel
                                </a>--}}
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
