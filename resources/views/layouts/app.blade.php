<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light"
    data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Afro Cargo') }}</title>
    <link rel="icon" href="{{ asset('assets/images/AfroCargoLogo.svg') }}" type="image/svg+xml">

    <!-- Favicon -->
    <link rel="shortcut icon" href="">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Font family -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.31.0/dist/tabler-icons.min.css" />

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Feather CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/feather/feather.css') }}">

    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">

    <!-- Datatables CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/scss/layout/select.scss') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap5.min.css') }}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/stylemain.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style5.css') }}">

    <!-- Intl Tell Input CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/css/intlTelInput.css">
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/intlTelInput.min.js"></script>
    <!-- Layout JS -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <script src="{{ asset('assets/js/scriptmain.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

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

    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tabler-icons@1.54.0/iconfont/tabler-icons.min.css">
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
                <div class="card mainCardGlobal mb-0">
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
                @yield('bottomContent')
            </div>
            <!-- footer -->
            @include('partial.footer')
            <!-- /footer -->
        </div>
        <!-- /Page Wrapper -->



    </div>
    <!-- /Main Wrapper -->

    <!-- Theme Setting -->


    <!-- /Theme Setting -->
    <!-- jQuery -->
    @include('partial.loader')
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="{{asset('js/pagination.js')}}"></script>

    <!-- Feather Icon JS -->
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>

    <!-- Slimscroll JS -->
    <script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexchart/chart-data.js') }}"></script>

    {{-- <script src="https://www.gstatic.com/firebasejs/9.6.10/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.6.10/firebase-messaging-compat.js"></script>
    
    <script src="{{ asset('js/fcm.js') }}"></script> --}}

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJFnhTgQa7v75t28FbMgajOv-5mJuMTqI&libraries=places"
        async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <!-- Sweetalert 2 -->
    <script src="{{ asset('assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>

    <script src="{{ asset('js/comman.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <!-- Theme Settings JS -->
    <script src="{{ asset('assets/js/theme-settings.js') }}"></script>
    <script src="{{ asset('assets/js/greedynav.js') }}"></script>
    <script src="{{ asset('select2-4.1/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/admin/select2.js') }}"></script>
    <script src="{{ asset('js/validate.js') }}"></script>
    {{--
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script> --}}

    <!-- Intl Tell Input js -->
    <script src="{{ asset('assets/plugins/intlTelInput/js/intlTelInput-jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/timeline/horizontal-timeline.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('assets/js/status_manage.js') }}"></script>

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>

    @yield('script')

    <script>
        @session('success')
            Swal.fire({
                title: "Good job!"
                , text: "{{ $value }}"
                , icon: "success"
            });
        @endsession
        @session('error')
            Swal.fire({
                title: "Oops..."
                , text: "{{ $value }}"
                , icon: "error"
            });
        @endsession

            function deleteData(self, msg) {
                Swal.fire({
                    title: msg
                    , icon: "question"
                    , showCancelButton: true
                    , showCloseButton: true
                    , confirmButtonText: "Delete"
                    , cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Assuming the button that calls deleteData is inside a form
                        $(self).closest('form').submit(); // Finds the closest form and submits it
                    }
                });
            }

        function alertMsg(msg = '', icon = '') {
            Swal.fire({
                text: msg,
                icon: icon,
                confirmButtonText: 'OK'
            });
        }

        function deleteRaw(url, msg = "You won't be able to revert this!") {
            Swal.fire({
                title: 'Are you sure?',
                text: msg,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545', // Bootstrap btn-danger
                cancelButtonColor: '#6c757d',  // Bootstrap btn-secondary
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit a form or send AJAX request to delete
                    fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                        .then(response => {
                            location.reload();
                        });
                }
            });
        }

        function redirectTo(url) {
            window.location.href = url;
        }

        $(document).on('shown.bs.modal', '.custom-modal', function () {
            const $modal = $(this);

            // Prevent duplicate Select2 initialization
            $modal.find('.js-example-basic-single').each(function () {
                const $select = $(this);

                // Destroy if already initialized
                if ($select.hasClass('select2-hidden-accessible')) {
                    $select.select2('destroy');
                }

                // Initialize Select2 with correct dropdown parent (modal body)
                $select.select2({
                    dropdownParent: $modal,
                    width: '100%',
                    allowClear: true,
                    placeholder: 'Select an option',
                    templateResult: typeof formatCountryOption === 'function' ? formatCountryOption : undefined,
                    templateSelection: typeof formatCountrySelection === 'function' ? formatCountrySelection : undefined
                });
            });

            // Fix tabindex issue inside Bootstrap modal (important for search)
            setTimeout(() => {
                $.fn.modal.Constructor.prototype._enforceFocus = function() {};
            }, 10);
        });


        document.addEventListener("DOMContentLoaded", function () {
            const phoneInput = document.querySelector('input[type="tel"]');

            if (phoneInput) {
                phoneInput.addEventListener("input", function (event) {
                    this.value = this.value.replace(/\D/g, ''); // Remove non-numeric characters
                });

                phoneInput.addEventListener("blur", function () {
                    if (!/^\d+$/.test(this.value)) {
                        this.value = "";
                    }
                });
            }
        });

        function updateStatusValue() {
            let checkbox = document.getElementById('rating_6');

            // If checked, set value to "Inactive", else set to "Active"
            checkbox.value = checkbox.checked ? 'Inactive' : 'Active';
        }

        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".check").forEach(function (checkbox) {
                checkbox.addEventListener("change", function () {
                    this.value = this.checked ? "Inactive" : "Active";
                });

                // Ensure correct value is set on page load
                checkbox.value = checkbox.checked ? "Inactive" : "Active";
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            const refreshUserBtn = document.querySelector(".refeshuser");

            if (refreshUserBtn) {
                refreshUserBtn.addEventListener("click", function () {
                    sessionStorage.setItem("refreshTriggered", "true");
                    location.href = window.location.pathname; // Remove query parameters
                });
            }

            // Check if refresh was triggered
            if (sessionStorage.getItem("refreshTriggered") === "true") {
                sessionStorage.removeItem("refreshTriggered"); // Clear the flag
                location.href = window.location.pathname; // Reload without query parameters
            }
        });

        $(document).ready(function () {
            function formatOption(option) {
                if (!option.id) return option.text;
                var img = $(option.element).data('image');
                var name = $(option.element).data('name');
                var code = $(option.element).data('code');
                return $(
                    '<span><img src="' + img + '" class="customFlags"/> ' + name + ' +' + code + '</span>'
                );
            }

            function formatSelected(option) {
                if (!option.id) return option.text;
                var img = $(option.element).data('image');
                var code = $(option.element).data('code');
                return $(
                    '<span><img src="' + img + '" class="customFlags"/> +' + code + '</span>'
                );
            }

            $('.flag-select').select2({
                templateResult: formatOption
                , templateSelection: formatSelected
                , width: 'style'
            }).on('select2:open', function () {
                $('.select2-results__options').addClass('my-custom-option-class');
            });

            $('.flag-select').on('select2:open', function () {
                let parentContainer = $(this).data('select2').$container;
                parentContainer.addClass('my-custom-container-class');
            });
        });

    </script>

</body>

</html>
