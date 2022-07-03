@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Enrolled Students List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ URL::route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Enrolled Students</li>
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
                            <div class="row">
                                <div class="col-12">
                                    <h4>Students List</h4>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Program</th>
                                    <th>Intake</th>
                                    {{--<th>Created By</th>--}}
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$student->first_name}}</td>
                                        <td>{{$student->last_name}}</td>
                                        <td>{{$student->email}}</td>
                                        <td>{{$student->program_name}}</td>
                                        <td>{{$student->start_date}}</td>
                                        {{--<td>{{$student->first_name}}</td>--}}
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <a href="{{ URL::route('students.generate', $student->id) }}"
                                                   class="btn btn-secondary btn-flat">
                                                    <i class="fas fa-file"></i>
                                                </a>
                                                <a href="{{ URL::route('students.enrolled.view', $student->id) }}"
                                                   class="btn btn-info btn-flat">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ URL::route('students.enrolled.edit', $student->id) }}"
                                                   class="btn btn-warning btn-flat">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
