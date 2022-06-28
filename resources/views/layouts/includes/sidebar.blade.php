@php
    $user = Auth::user();
    $path = Route::getFacadeRoot()->current()->uri();
    /*dd($path);*/
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="javascript:void(0)" class="d-block">{{$user->first_name}} {{$user->last_name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ URL::route('dashboard') }}" class="nav-link @if($path == '/') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if($user->user_type == 'admin')
                    <li class="nav-item">
                        <a href="{{ URL::route('employees') }}"
                           class="nav-link @if($path == 'employees') active @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Employees
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ URL::route('agents') }}" class="nav-link @if($path == 'agents') active @endif">
                            <i class="nav-icon fas fa-suitcase"></i>
                            <p>
                                Agents
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ URL::route('programs') }}" class="nav-link @if($path == 'programs') active @endif">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Programs
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ URL::route('intakes') }}" class="nav-link @if($path == 'intakes') active @endif">
                            <i class="nav-icon fas fa-calendar"></i>
                            <p>
                                Intakes
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item ">
                    <a href="#"
                       class="nav-link @if($path == 'students/create' || $path == 'students/new' || $path == 'students/enrolled') active @endif"> {{--active--}}
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>
                            Students
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview"
                        style="@if($path == 'students/create' || $path == 'students/new' || $path == 'students/enrolled') display: block; @endif">
                        <li class="nav-item">
                            <a href="{{ URL::route('students.create') }}"
                               class="nav-link @if($path == 'students/create') active @endif"> {{--active--}}
                                <i class="far fa-registered nav-icon"></i>
                                <p>Register Student</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::route('students.new') }}"
                               class="nav-link @if($path == 'students/new') active @endif">
                                <i class="fas fa-plus-square nav-icon"></i>
                                <p>New Students</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL::route('students.enrolled') }}"
                               class="nav-link @if($path == 'students/enrolled') active @endif">
                                <i class="fas fa-university nav-icon"></i>
                                <p>Enrolled Students</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index3.html" class="nav-link">
                                <i class="fas fa-ban nav-icon"></i>
                                <p>Rejected Students</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
