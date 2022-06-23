@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View Application</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ URL::route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ URL::route('students.new') }}">New Students</a></li>
                        <li class="breadcrumb-item active">View Application</li>
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
                            <h3 class="card-title">Update new application</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" action="{{ route('students.new.update') }}" method="post">
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
                                                <label class="col-form-label">
                                                    <b>{{$student[0]->first_name}}</b>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Gender</label>
                                            <div class="col-sm-9">
                                                <label class="col-form-label">
                                                    <b>{{$student[0]->gender}}</b>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="dob" class="col-sm-2 col-form-label">Date of birth</label>
                                            <div class="col-sm-9">
                                                <label class="col-form-label">
                                                    <b>{{$student[0]->dob}}</b>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group row">
                                            <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                                            <div class="col-sm-9">
                                                <label class="col-form-label">
                                                    <b>{{$student[0]->last_name}}</b>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <label class="col-form-label">
                                                    <b>{{$student[0]->email}}</b>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="passport_number" class="col-sm-2 col-form-label">Passport
                                                No</label>
                                            <div class="col-sm-9">
                                                <label class="col-form-label">
                                                    <b>{{$student[0]->passport_number}}</b>
                                                </label>
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
                                                <label class="col-form-label">
                                                    <b>{{$student[0]->address1}}</b>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="country_id" class="col-sm-2 col-form-label">Country</label>
                                            <div class="col-sm-9">
                                                <label class="col-form-label">
                                                    <b>{{$student[0]->country_id}}</b>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="city" class="col-sm-2 col-form-label">City</label>
                                            <div class="col-sm-9">
                                                <label class="col-form-label">
                                                    <b>{{$student[0]->city}}</b>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group row">
                                            <label for="address2" class="col-sm-2 col-form-label">Address 2</label>
                                            <div class="col-sm-9">
                                                <label class="col-form-label">
                                                    <b>{{$student[0]->address2}}</b>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="province_id" class="col-sm-2 col-form-label">Province /
                                                State</label>
                                            <div class="col-sm-9">
                                                <label class="col-form-label">
                                                    <b>{{$student[0]->state_id}}</b>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="postal_code" class="col-sm-2 col-form-label">Postal Code</label>
                                            <div class="col-sm-9">
                                                <label class="col-form-label">
                                                    <b>{{$student[0]->postal_code}}</b>
                                                </label>
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
                                                <label class="col-form-label">
                                                    <b>{{$student[0]->program_name}}</b>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                        <div class="form-group row">
                                            <label for="intake_id" class="col-sm-2 col-form-label">Intake</label>
                                            <div class="col-sm-9">
                                                <label class="col-form-label">
                                                    <b>{{$student[0]->start_date}} to {{$student[0]->end_date}}</b>
                                                </label>
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
                                                @if($student[0]->study_permit != '' || $student[0]->study_permit != null)
                                                    <label class="col-form-label">
                                                        <a href="{{ Storage::url('documents/'.$student[0]->study_permit) }}"
                                                           download>
                                                            <i class="icon fas fa-download"></i> Download file
                                                        </a>
                                                    </label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if($user_type != 'agent')
                                        <div class="col-lg-12 col-xs-12">
                                            <hr>
                                            <h4><b>Update Status</b></h4>
                                            <hr>
                                            <input type="hidden" name="id" value="{{$student[0]->id}}">
                                            <div class="form-group row">
                                                <label for="status" class="col-sm-2 col-form-label">Choose
                                                    Status</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="status" name="status">
                                                        <option value="approved" selected>Approve</option>
                                                        <option value="rejected">Reject</option>
                                                    </select>
                                                    @if ($errors->has('status'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('status') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="notes" class="col-sm-2 col-form-label">Notes</label>
                                                <div class="col-sm-9">
                                                    <textarea name="notes" id="notes" class="form-control"
                                                              rows="3"></textarea>
                                                    @if ($errors->has('notes'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('notes') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                @if($user_type != 'agent')
                                    <button type="submit" class="btn btn-success">
                                        <i class="icon fas fa-save"></i> Save
                                    </button>
                                @endif
                                <a href="{{ URL::route('students.new') }}" class="btn btn-danger float-right">
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
