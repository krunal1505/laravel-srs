@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Agent</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ URL::route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ URL::route('agents') }}">Agents</a></li>
                        <li class="breadcrumb-item active">Edit Agent</li>
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
                            <h3 class="card-title">Edit Agent</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" action="{{ route('agents.update', $agent[0]->user_id) }}"
                              method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-xs-12">
                                        <h3><b>Personal Info</b></h3>
                                        <hr>
                                        <div class="form-group row">
                                            <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="first_name"
                                                       name="first_name" value="{{$agent[0]->first_name}}">
                                                @if ($errors->has('first_name'))
                                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="last_name" name="last_name"
                                                       value="{{$agent[0]->last_name}}">
                                                @if ($errors->has('last_name'))
                                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="email" name="email"
                                                       value="{{$agent[0]->email}}" disabled>
                                                @if ($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="phone" name="phone"
                                                       value="{{$agent[0]->phone}}">
                                                @if ($errors->has('phone'))
                                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-2 col-form-label">Status</label>
                                            <div class="col-sm-9">
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" id="active"
                                                           name="status" value="active"
                                                           @if($agent[0]->status == 'active') checked @endif>
                                                    <label for="active" class="custom-control-label">Active</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" id="inactive"
                                                           name="status" value="inactive"
                                                           @if($agent[0]->status == 'inactive') checked @endif>
                                                    <label for="inactive" class="custom-control-label">In-Active</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                        <h3><b>Agency Info</b></h3>
                                        <hr>
                                        <div class="form-group row">
                                            <label for="company_name" class="col-sm-2 col-form-label">Company
                                                Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="company_name"
                                                       name="company_name" value="{{$agent[0]->company_name}}">
                                                @if ($errors->has('company_name'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('company_name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="address1" class="col-sm-2 col-form-label">Address 1</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="address1" name="address1"
                                                       value="{{$agent[0]->address1}}">
                                                @if ($errors->has('address1'))
                                                    <span class="text-danger">{{ $errors->first('address1') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="address2" class="col-sm-2 col-form-label">Address 2</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="address2" name="address2"
                                                       value="{{$agent[0]->address2}}">
                                                @if ($errors->has('address2'))
                                                    <span class="text-danger">{{ $errors->first('address2') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="country_id" class="col-sm-2 col-form-label">Country</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="country_id" name="country_id">
                                                    <option value="" disabled>--- Select One ---</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{$country->id}}"
                                                                @if($agent[0]->country_id == $country->id) selected @endif>{{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('country_id'))
                                                    <span class="text-danger">{{ $errors->first('country_id') }}</span>
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
                                                                @if($agent[0]->province_id == $province->id) selected @endif>{{$province->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('province_id'))
                                                    <span class="text-danger">{{ $errors->first('province_id') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="city" class="col-sm-2 col-form-label">City</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="city"
                                                       name="city" value="{{$agent[0]->city}}">
                                                @if ($errors->has('city'))
                                                    <span class="text-danger">{{ $errors->first('city') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="website" class="col-sm-2 col-form-label">Website</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="website"
                                                       name="website" value="{{$agent[0]->website}}">
                                                @if ($errors->has('website'))
                                                    <span class="text-danger">{{ $errors->first('website') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success"><i class="icon fas fa-save"></i> Save</button>
                                <a href="{{ URL::route('agents') }}" class="btn btn-danger float-right">
                                    <i class="icon fas fa-backspace"></i>  Cancel
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
