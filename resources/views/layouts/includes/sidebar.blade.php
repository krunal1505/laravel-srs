@php
$user = Auth::user();
$path = Route::getFacadeRoot()->current()->uri();
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
                    <a href="{{ URL::route('employees') }}" class="nav-link @if($path == 'employees') active @endif">
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
                        <i class="nav-icon fas fa-suitcase"></i>
                        <p>
                            Programs
                        </p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
