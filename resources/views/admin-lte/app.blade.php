
<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin-lte/header')
    @livewireStyles
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">

  <!-- Preloader -->
    @include('admin-lte/preloader')

  <!-- Navbar -->
    @include('admin-lte/navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    @include('admin-lte/sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        @include('admin-lte/main-header')
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
            @yield('content')
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    @include('admin-lte/footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('admin-lte/javascript')

@yield('script')

@livewireScripts

@yield('chart-script')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))

<script>
    Swal.fire({
        icon: 'success',
        title: 'berhasil diperbarui',
        text: '{{ session('success') }}',
        confirmButtonColor: '#2563eb',
        timer: 2500,
        showConfirmButton: false
    });
</script>

@endif

</body>
</html>