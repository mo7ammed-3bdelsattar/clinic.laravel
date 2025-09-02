@include('admin.layouts.header.head')
@include('admin.layouts.header.nav')
@include('doctor.layouts.aside')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @include('admin.layouts.header.pageHeader')
    @yield('content')
</div>
<!-- /.content-wrapper -->
@include('admin.layouts.footer.footer')