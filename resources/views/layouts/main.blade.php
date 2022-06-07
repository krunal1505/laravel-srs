<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SRS</title>
    @include('layouts.includes.css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('layouts.includes.header')
    @include('layouts.includes.sidebar')

    <div class="content-wrapper">
    @yield('content')
    </div>

    @include('layouts.includes.footer')

    <!-- Control Sidebar -->
{{--    <aside class="control-sidebar control-sidebar-dark">--}}
{{--    </aside>--}}
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('layouts.includes.js')
</body>
</html>
