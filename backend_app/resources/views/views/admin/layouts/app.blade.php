<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ url('/') }}" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <title>Dashboard admin - {{ config('app.name') }}</title>
    <!-- Select2 CSS -->
    <link href="{{ asset('xtreme-admin/assets/libs/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <!-- Toast -->
    <link href="{{ asset('xtreme-admin/assets/libs/toastr/build/toastr.min.css') }}" rel="stylesheet">

    <link href="{{ asset('xtreme-admin/dist/css/style.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('xtreme-admin/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/date-time/jquery.datetimepicker.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- Custom CSS -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet" type="text/css">
    @yield('css')
</head>

<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
{{--<div id="main-wrapper">--}}
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full" data-sidebartype="mini-sidebar" class="mini-sidebar">
    @include('admin.components.topbar')
    @include('admin.components.left-sidebar')
    <div class="page-wrapper">
        @include('admin.components.breadcrumb')
        @yield('content')
        @include('admin.components.footer')
    </div>
    </div>
{{--</div>--}}
@include('admin.components.aside-right')
{{--@routes--}}
<div class="chat-windows"></div>
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{ asset('xtreme-admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('xtreme-admin/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('xtreme-admin/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- apps -->
<script src="{{ asset('xtreme-admin/dist/js/app.min.js') }}"></script>
<script src="{{ asset('xtreme-admin/dist/js/app.init.light-sidebar.js') }}"></script>
<script src="{{ asset('xtreme-admin/dist/js/app-style-switcher.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('xtreme-admin/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('xtreme-admin/assets/extra-libs/sparkline/sparkline.js') }}"></script>
<!--Wave Effects -->
{{--<script src="{{ asset('xtreme-admin/dist/js/waves.js') }}"></script>--}}
<!--Menu sidebar -->
<script src="{{ asset('xtreme-admin/dist/js/sidebarmenu.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('xtreme-admin/dist/js/custom.min.js') }}"></script>


<script src="{{ asset('xtreme-admin/assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('xtreme-admin/assets/libs/select2/dist/js/select2.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- Toast -->
<script src="{{ asset('xtreme-admin/assets/libs/toastr/build/toastr.min.js') }}"></script>

<script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>

<script src="{{ asset('js/admin.js') }}"></script>
<script>
    var BASE_URL = $('base').attr('href');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // $('div.alert').not('.alert-important').delay(8000).fadeOut(350);
    $(".select2").select2();
    // jQuery('.mydatepicker, #datepicker, .input-group.date').datepicker();
    // jQuery('#datetimepicker').datetimepicker({
    //     format: 'MM/DD/YYYY H:mm',
    //     disabledHours: false,
    //     icons: {
    //         time: 'fa fa-clock-o',
    //         date: 'fa fa-calendar',
    //         up: 'fa fa-chevron-up',
    //         down: 'fa fa-chevron-down',
    //         previous: 'fa fa-chevron-left',
    //         next: 'fa fa-chevron-right',
    //         today: 'fa fa-arrows ',
    //         clear: 'fa fa-trash',
    //         close: 'fa fa-times'
    //     }
    // });
    // $('#datetimepicker').datetimepicker({
    //     format:'m/d/Y H:i',
    //     allowTimes:[
    //         '1:00', '1:30', '2:00', '2:30',
    //         '3:00', '3:30', '4:00', '4:30',
    //         '5:00', '5:30', '6:00', '6:30',
    //         '7:00', '7:30', '8:00', '8:30',
    //         '9:00', '9:30', '10:00', '10:30',
    //         '11:00', '11:30', '12:00', '12:30'
    //     ]
    // });
    $("#datetimepicker").flatpickr({
        enableTime: true,
        dateFormat: "d/m/Y H:i",
    });
    // $('#datepicker').datepicker({
    //     format:'dd/mm/yyyy',
    // });
</script>
@yield('script')
</body>

</html>
