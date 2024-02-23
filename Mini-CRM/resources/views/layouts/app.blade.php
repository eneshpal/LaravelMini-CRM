<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
	<!-- DataTables -->
      <link rel="stylesheet" href="{{asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
      <link rel="stylesheet" href="{{asset('dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
      <link rel="stylesheet" href="{{asset('dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    @yield('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" style="left: inherit; right: 0px;">
                    <a href="{{ route('profile.show') }}" class="dropdown-item">
                        <i class="mr-2 fas fa-file"></i>
                        {{ __('My profile') }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="dropdown-item"
                           onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="mr-2 fas fa-sign-out-alt"></i>
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <img src="{{ asset('images/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        @include('layouts.navigation')
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<!-- AdminLTE App -->

<script src="{{ asset('js/adminlte.min.js') }}" defer></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="{{asset('js/popper.js')}}"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

 <!-- DataTables  & Plugins -->
      <script src="{{asset('dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
      <script src="{{asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
      <script src="{{asset('dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
      <script src="{{asset('dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
      <script src="{{asset('dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
      <script src="{{asset('dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
      <script src="{{asset('dashboard/plugins/jszip/jszip.min.js')}}"></script>
      <script src="{{asset('dashboard/plugins/pdfmake/pdfmake.min.js')}}"></script>
      <script src="{{asset('dashboard/plugins/pdfmake/vfs_fonts.js')}}"></script>
      <script src="{{asset('dashboard/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
      <script src="{{asset('dashboard/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
      <script src="{{asset('dashboard/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
	  
      <!-- Page specific script -->
	 <script>
         $(function () {
         $("#example1").DataTable({
         "responsive": true, "lengthChange": false, "autoWidth": false,
         // "buttons": ["csv", "excel", "pdf", "print"]
         }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
         
         $('#example2').DataTable({
         "paging": true,
         "lengthChange": false,
         "searching": false,
         "ordering": true,
         "info": true,
         "autoWidth": false,
         "responsive": true,
         });
         });
      </script>
	  
<script>
   function showmodal(id, name, email, image, website){ 
      $("#id").val(id);
      $("#editname").val(name); 
      $("#editemail").val(email); 
     // $("#editlogo").val(image); 
      $("#editwebsite").val(website); 
   }
</script>

@yield('scripts')
</body>
</html>
