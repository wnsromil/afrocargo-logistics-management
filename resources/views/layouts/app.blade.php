<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Kanakku provides clean Admin Templates for managing Sales, Payment, Invoice, Accounts and Expenses in HTML, Bootstrap 5, ReactJs, Angular, VueJs and Laravel.">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@dreamstechnologies">
    <meta name="twitter:title" content="Finance & Accounting Admin Website Templates | Kanakku">
    <meta name="twitter:description"
        content="Kanakku is a Sales, Invoices & Accounts Admin template for Accountant or Companies/Offices with various features for all your needs. Try Demo and Buy Now.">
    <meta name="twitter:image" content="https://kanakku.dreamstechnologies.com/assets/img/kanakku.jpg">
    <meta name="twitter:image:alt" content="Kanakku">

    <!-- Facebook -->
    <meta property="og:url" content="https://kanakku.dreamstechnologies.com/">
    <meta property="og:title" content="Finance & Accounting Admin Website Templates | Kanakku">
    <meta property="og:description"
        content="Kanakku is a Sales, Invoices & Accounts Admin template for Accountant or Companies/Offices with various features for all your needs. Try Demo and Buy Now.">
    <meta property="og:image" content="https://kanakku.dreamstechnologies.com/assets/img/kanakku.jpg">
    <meta property="og:image:secure_url" content="https://kanakku.dreamstechnologies.com/assets/img/kanakku.jpg">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

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

    <!-- Layout JS -->
    <script src="{{asset('assets/js/layout.js')}}"></script>
    
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.min.css">


    @yield('style')

    

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
        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="card mb-0">
                    <div class="card-body">
                        <!-- Page Header -->
                        <div class="page-header">
                            <div class="content-page-header" style="border-bottom: 1px solid #f0f0f0;">
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
    <script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Feather Icon JS -->
    <script src="{{asset('assets/js/feather.min.js')}}"></script>

    <!-- Slimscroll JS -->
    <script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

    <!-- Chart JS -->
    <script src="{{asset('assets/plugins/apexchart/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/plugins/apexchart/chart-data.js')}}"></script>

    <!-- Theme Settings JS -->
    <script src="{{asset('assets/js/theme-settings.js')}}"></script>
    <script src="{{asset('assets/js/greedynav.js')}}"></script>

    <!-- Custom JS -->
    <script src="{{asset('assets/js/script.js')}}"></script>

    <script src="{{asset('js/comman.js')}}"></script>
    <script src="{{asset('select2-4.1/dist/js/select2.min.js')}}"></script>
    <script src="{{asset('js/admin/select2.js')}}"></script>
        
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
    </script>

    @yield('script')

</body>

</html>