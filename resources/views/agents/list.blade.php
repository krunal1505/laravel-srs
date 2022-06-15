@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Agents</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ URL::route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Agents</li>
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
                                <div class="col-6">
                                    <h4>Agents List</h4>
                                </div>
                                <div class="col-6">
                                    <div class="float-right">
                                        <a href="{{ URL::route('agents-create') }}"
                                           class="btn btn-success"><i class="icon fas fa-plus"></i>   Create</a>
                                    </div>
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
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($agents as $agent)
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$agent->first_name}}</td>
                                        <td>{{$agent->last_name}}</td>
                                        <td>{{$agent->email}}</td>
                                        <td>{{$agent->phone}}</td>
                                        <td>
                                            @if($agent->status == 'active')
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">In-Active</span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <a href="{{ URL::route('agents-edit', $agent->id) }}"
                                                   class="btn btn-warning btn-flat">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{URL::route('agents.destroy', $agent->id)}}"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        class="btn btn-danger btn-flat"
                                                        onclick="return confirm('Are you sure you want to delete this field?');"
                                                        type="submit"
                                                    >
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
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
