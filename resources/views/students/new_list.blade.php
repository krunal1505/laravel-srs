@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">New Students List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ URL::route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">New Students</li>
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
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-check"></i> Success!</h5>
                                {{session('success')}}
                            </div>
                        @endif
                        @if(session('danger'))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                {{session('danger')}}
                            </div>
                        @endif
                        <div class="card-header">
                            <h3 class="card-title">Students List</h3>
                            {{--<div class="row">
                                <div class="col-12">
                                    <h4></h4>
                                </div>
                            </div>--}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Program</th>
                                    <th>Intake</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $("#table").DataTable({
                responsive: true, lengthChange: false, autoWidth: false,
                processing: true,
                serverSide: true,
                searching: true,
                ordering: true,
                ajax: "{{route('students.new_list_ajax')}}",
                columns: [
                    {data: 'id'},
                    {data: 'first_name'},
                    {data: 'last_name'},
                    {data: 'email'},
                    {data: 'program'},
                    {data: 'start_date'},
                    {data: 'action'},
                ]
            });
        });
    </script>
@endsection
