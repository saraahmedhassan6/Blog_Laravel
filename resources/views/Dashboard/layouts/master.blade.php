<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog|Dashboard</title>

    @include('Dashboard.layouts.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="Dashboard/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    @include('Dashboard.layouts.main-header')

    <!-- Main Sidebar Container -->
    @include('Dashboard.layouts.main-siderbar')

    <!-- Content Wrapper. Contains page content -->
    @yield('dashContent')
    <!-- /.content-wrapper -->
    @include('Dashboard.layouts.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
@include('Dashboard.layouts.footer-scripts')
</body>
</html>
