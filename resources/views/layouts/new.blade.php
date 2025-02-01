<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <link href="{{asset('bootstrap-5.3.3/dist/css/bootstrap.css')}}" rel="stylesheet">
        <script src="{{asset('bootstrap-5.3.3/dist/js/bootstrap.bundle.min.js')}}"></script>

        <link href="{{asset('select2-4.1/dist/css/select2.min.css')}}" rel="stylesheet" />
        <script src="{{asset('select2-4.1/dist/js/select2.min.js')}}"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.min.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />


        <link href="https://demo.dashboardpack.com/architectui-html-free/main.css" rel="stylesheet">
        @yield('style')

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        
        <!--footer-->
        @include('partial.header')
        <!--end_footer-->
        
        <div class="app-main">
            <!--footer-->
            @include('partial.sidebar')
            <!--end_footer-->
            <div class="app-main__outer">
                <div class="app-main__inner">
                     <!-- Page Content -->
                    @isset($slot)
                        {{ $slot }}
                    @endisset

                    @isset($card)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-header">
                                        @isset($cardHeaderLeft)
                                            {{ $cardHeaderLeft }}
                                        @endisset
                                        <div class="btn-actions-pane-right">
                                            @isset($cardHeaderRigth)
                                                {{ $cardHeaderRigth }}
                                            @endisset
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        @isset($cardBody)
                                            {{ $cardBody }}
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endisset
                </div>
                <!--footer-->
                @include('partial.footer')
                <!--end_footer-->
            </div>
            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
    <script type="text/javascript" src="https://demo.dashboardpack.com/architectui-html-free/assets/scripts/main.js">
    </script>

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
    </script>

    @yield('script')
</body>

</html>