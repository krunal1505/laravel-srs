@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Programs</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ URL::route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Programs</li>
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
                                    <h4>Programs List</h4>
                                </div>
                                <div class="col-6">
                                    <div class="float-right">
                                        <button type="button" class="btn btn-success"
                                                data-toggle="modal" data-target="#addProgram">Create
                                        </button>
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
                                    <th>Program Name</th>
                                    <th>Fees</th>
                                    <th>Status</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($programs as $program)
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$program->program_name}}</td>
                                        <td>${{$program->fees}}</td>
                                        <td>
                                            @if($program->status == 'active')
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">In-Active</span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                {{--<a href="{{ URL::route('programs-edit', $program->id) }}"
                                                   class="btn btn-warning btn-flat">
                                                    <i class="fas fa-edit"></i>
                                                </a>--}}
                                                <button id="editProgram" class="btn btn-warning btn-flat editProgram" program="{{$program->id}}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="{{URL::route('programs.destroy', $program->id)}}"
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

    <!-- Add Program modal start -->
    <div class="modal fade" id="addProgram" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form class="form-horizontal" action="{{ route('programs.save') }}" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add a new Program</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group row">
                            <label for="program_name" class="col-sm-2 col-form-label">Program Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="program_name" name="program_name">
                                @if ($errors->has('program_name'))
                                    <span class="text-danger">{{ $errors->first('program_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fees" class="col-sm-2 col-form-label">Fees</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="fees" name="fees" min="0">
                                @if ($errors->has('fees'))
                                    <span class="text-danger">{{ $errors->first('fees') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="active"
                                           name="status" value="active" checked="checked">
                                    <label for="active" class="custom-control-label">Active</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="inactive"
                                           name="status" value="inactive">
                                    <label for="inactive" class="custom-control-label">In-Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Add Program modal end -->

    <!-- Edit Program modal start -->
    <div class="modal fade" id="editProgramModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form class="form-horizontal" action="{{ route('programs.update') }}" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add a new Program</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="form-group row">
                            <label for="program_name" class="col-sm-2 col-form-label">Program Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_program_name" name="program_name">
                                @if ($errors->has('program_name'))
                                    <span class="text-danger">{{ $errors->first('program_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fees" class="col-sm-2 col-form-label">Fees</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="edit_fees" name="fees" min="0">
                                @if ($errors->has('fees'))
                                    <span class="text-danger">{{ $errors->first('fees') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="editactive"
                                           name="status" value="active" checked="checked">
                                    <label for="editactive" class="custom-control-label">Active</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="editinactive"
                                           name="status" value="inactive">
                                    <label for="editinactive" class="custom-control-label">In-Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Edit Program modal end -->

    <script>
        $(document).ready(function () {
            $('.editProgram').on('click', function () {
                let program_id = this.getAttribute('program');

                $.ajax({
                    url: "{{ URL::route('programs-edit') }}",
                    type: "POST",
                    data: {
                        program_id: program_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#editProgramModel').modal('show')
                        $('#id').val(result[0].id);
                        $('#edit_program_name').val(result[0].program_name);
                        $('#edit_fees').val(result[0].fees);
                    }
                });
            });
        });
    </script>
@endsection
