<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('assets/images/AfroCargoLogo.svg') }}" type="image/svg+xml">

    <!-- Favicon -->
    <link rel="shortcut icon" href="">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">

    <!-- Font family -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">

    <!-- Feather CSS -->
    <link rel="stylesheet" href="{{asset('assets/plugins/feather/feather.css')}}">

    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">

    <!-- Datatables CSS -->
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables/datatables.min.css')}}">


    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/stylemain.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style5.css')}}">

    <!-- Intl Tell Input CSS -->
    <link rel="stylesheet" href="{{asset('assets/plugins/intlTelInput/css/intlTelInput.css')}}">

    <!-- Layout JS -->
    <script src="{{asset('assets/js/layout.js')}}"></script>
    <script src="{{asset('assets/js/scriptmain.js')}}"></script>
    
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



<!-- Red Rose Font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Red+Rose:wght@300..700&display=swap" rel="stylesheet">




    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    @yield('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.28.1/tabler-icons.min.css"
        integrity="sha512-UuL1Le1IzormILxFr3ki91VGuPYjsKQkRFUvSrEuwdVCvYt6a1X73cJ8sWb/1E726+rfDRexUn528XRdqrSAOw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @stack('head')
</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        @include('partial.header')
        <!-- /Header -->

        <!-- Sidebar -->
        @include('partial.sidebar')
        <!-- /Sidebar -->

        <!-- Page Wrapper -->
        <div class="page-wrapper" style="margin-top:0px">
            <div class="content container-fluid screen-width">
                @yield('content')
                <div class="card mb-0">
                    <div class="card-body">
                        <!-- Page Header -->
                        <div class="page-header">
                            <div class="content-page-header">
                                @isset($cardTitle)
                                    {{$cardTitle}}
                                @endisset
                            </div>
                            @isset($cardHeader)
                                {{$cardHeader}}
                            @endisset
                        </div>
                        <!-- /Page Header -->				
                        <div class="row">
                            <div class="col-md-12">
                                @isset($slot)
                                    {{ $slot }}
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->

    <!-- Theme Setting -->


    <!-- /Theme Setting -->
    <!-- jQuery -->
    <script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"><script/>

    <!-- Bootstrap Core JS -->
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Feather Icon JS -->
    <script src="{{asset('assets/js/feather.min.js')}}"></script>

    <!-- Slimscroll JS -->
    <script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

    <!-- Chart JS -->
    <script src="{{asset('assets/plugins/apexchart/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/plugins/apexchart/chart-data.js')}}"></script>


    <script src="{{asset('js/comman.js')}}"></script>
    <script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>

    <!-- Theme Settings JS -->
    <script src="{{asset('assets/js/theme-settings.js')}}"></script>
    <script src="{{asset('assets/js/greedynav.js')}}"></script>
    <script src="{{asset('select2-4.1/dist/js/select2.min.js')}}"></script>
    <script src="{{asset('js/admin/select2.js')}}"></script>

    <!-- Intl Tell Input js -->
    <script src="{{asset('assets/plugins/intlTelInput/js/intlTelInput-jquery.min.js')}}"></script>

    <!-- Slimscroll JS -->
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Timeline JS -->
    <script src="assets/plugins/timeline/horizontal-timeline.js"></script>


    <!-- jQuery (required by FullCalendar) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Moment.js (required by FullCalendar) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- FullCalendar JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.js"></script>


    

    <!-- Custom JS -->
    <script src="{{asset('assets/js/script.js')}}"></script>
    // <!-- Bootstrap JS (ensure this is included) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        @session('success')
            Swal.fire({
                title: "Good job!",
                text: "{{ $value }}",
                icon: "success"
            });
        @endsession
        @session('error')
            Swal.fire({
                title: "Oops...",
                text: "{{ $value }}",
                icon: "error"
            });
        @endsession

        function deleteData(self, msg) {
            Swal.fire({
                title: msg,
                icon: "question",
                showCancelButton: true,
                showCloseButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Assuming the button that calls deleteData is inside a form
                    $(self).closest('form').submit(); // Finds the closest form and submits it
                }
            });
        }

        function redirectTo(url){
            window.location.href= url;
        }
    </script>

    @yield('script')

</body>

</html>