<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.31.0/dist/tabler-icons.min.css" />
<x-guest-layout>
    <style>
        .w-100 {
            width: 100%;
        }

        .bg-image-login {
            background-image: url('../assets/images/Loginimage.jpeg');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .login-border-width {
            width: 243px;
            margin-left: 72px;
            position: absolute;
        }

        .active1 {
            text-decoration: none;
            border-bottom: 4px solid #203A5F !important;
            font-weight: 800px !important;
            color: #203A5F !important;
            position: relative !important;
        }

        /* .active1.active-border{
            border-bottom: 4px solid #203A5F !important;
            position: relative !important;
        } */

        .backgroundImage {
            background-image: url('../assets/images/Background.svg');
            background-repeat: no-repeat;
            background-size: cover;
            margin-right: 10px;
            padding: 0px;
            background-position: absolute;
            border: none;
            width: 100%;
        }

        .font-size2 {
            font-size: 25px;
            /* font-family: "Poppins", serif; */
            font-weight: 700px;
        }
    </style>

    <div class="backgroundImage align-items-center login-card login-container p-5">
        <div class="container row">
            <div class="container col col-lg-12 d-flex red-rose align-items-center bg-white">
                <div class="col col-md-2">
                    <img src="../assets/images/AfroCargoLogo.svg" alt="#" class="setSize">
                </div>
                <div class="col">
                    <p class="red-rose-fontSet fw-bold">Afro Cargo Express</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-2">
            <p class="font-size2 fw-bold setStyle">Login</p>
        </div>

        <div class="row mt-3 mb-2">
            <div class="d-block">
                 <div class="d-flex text-center authTabDiv">

                    <div id="click"></div>

                    <button id="adminBtn" type="button" class="btnBorder th-font fw-semiBold col737 me-3 activity-feed" onclick="toggleLoginForm('admin')">Admin</button>

                    <button id="managerBtn" type="button" class="btnBorder th-font fw-semiBold col737" onclick="toggleLoginForm('manager')">Warehouse Manager</button>

                </div>

                <!-- <div class="border-bottom border-1 border-dark border-opacity-50 mb-4 login-border-width"></div> -->
                <!-- First Border -->
                {{-- <div class="border-bottom border-1 border-dark border-opacity-50 mb-4 login-border-width"></div> --}}


            </div>
        </div>

        <!-- Session Status -->
        <x-auth-session-status :status="session('status')" />

        <!-- ----------------------------------- admin login page ------------------------------------------ -->
        <form method="POST" action="{{ route('login') }}" id="admin" style="display:none;">
            @csrf

            <!-- <div class="input-group mb-4 border rounded mt-4">
                <input id="email" type="email" name="email" :value="old('email')" class="form-control rounded border-0"
                    required autofocus autocomplete="username" placeholder="Username or email address">
                <span class="input-group-text">
                    <i class="fa-regular fa-user border-start"></i>
                </span>
            </div> -->


            <div class="input-group input-group-lg bg-color2 my-4 border  border-opacity-25">
                <input id="email" type="email" name="email" :value="old('email')" required autofocus
                    autocomplete="username"
                    class="form-control border-1 form-control-lg profileUpdateFont" type="text"
                    placeholder="Username or email address" aria-label=".form-control-lg example">
                <span class="input-group-text border border-dark border-start-0"
                    id="inputGroup-sizing-lg">
                     <i class="fe fe-user" style="color: #595C5F"></i>
                </span>
            </div>

            <!--     <div class="input-group mb-4 border rounded my-4">
                <input id="password" type="password" name="password" :value="old('email')"
                    class="form-control rounded border-0" required autocomplete="current-password"
                    placeholder="Password">
                <span class="input-group-text">
                    <i class="fe fe-unlock border-start" data-bs-toggle="tooltip" title="fe fe-unlock"></i>
                </span>
            </div> -->
            <div class="input-group input-group-lg bg-color2">
                <input id="password" type="password" name="password" :value="old('email')" required
                    autocomplete="current-password" placeholder="Password"
                    class="form-control border-1 form-control-lg profileUpdateFont input-placeholder" type="text"
                    aria-label=".form-control-lg example">
                <span class="input-group-text border border-dark border-start-0"
                    id="inputGroup-sizing-lg">
                    <span toggle="#password" class="ti ti-eye field-icon toggle-password1"></span>
                </span>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                @endif

                <x-primary-button class="btn w-100 btn-primary authBTN">
                    {{ __('Login') }}
                </x-primary-button>
            </div>
        </form>

        <!-- -------------------------------------- manager login page ---------------------------------------- -->
        <form method="POST" action="{{ route('login') }}" id="manager" style="display:none;">
            @csrf
            <div class="input-group input-group-lg bg-color2 mt-4 position-relative">
                <input id="warehouse_code" type="text" name="warehouse_code" :value="old('warehouse_code')"
                    class="form-control border-1 form-control-lg profileUpdateFont input-placeholder"
                     required autofocus autocomplete="off"
                    placeholder="Enter warehouse code">
                <span class="input-group-text border border-dark border-start-0">
                    <i class="ti ti-building-warehouse"></i>
                </span>

                <!-- ✅ Dropdown Jo Input Ke Niche Dikhe -->
                <ul id="warehouseDropdown" class="dropdown-menu position-absolute w-100"
                    style="display: none; z-index: 1000; top: 42px;">
                </ul>
                @if ($errors->has('warehouse_code'))
                    <div class="text-danger mt-2">
                        <strong>{{ $errors->first('warehouse_code') }}</strong>
                    </div>
                @endif

            </div>

            <!-- <div class="input-group mb-3 border rounded my-4">
                <input id="email" type="email" name="email" :value="old('email')"
                    class="form-control rounded border-0 bg-light" required autofocus autocomplete="username"
                    placeholder="Username or email address">
                <span class="input-group-text">
                    <i class="fa-regular fa-user border-start"></i>
                </span>
            </div> -->
            <div class="input-group input-group-lg bg-color2 my-4">
                <input id="email" type="email" name="email" :value="old('email')" required autofocus
                    autocomplete="username"
                    class="form-control border-1 form-control-lg profileUpdateFont input-placeholder" type="text"
                    placeholder="Username or email address" aria-label=".form-control-lg example">
                <span class="input-group-text border border-dark border-start-0"
                    id="inputGroup-sizing-lg">
                    <!-- <i class="fa-regular fa-user" style="color: #595C5F"></i> -->
                    <i class="fe fe-user" style="color: #595C5F"></i>
                </span>
            </div>

            <!-- <div class="input-group mb-3 border rounded my-4">
                <input id="password" type="password" name="password" :value="old('email')"
                    class="form-control rounded bg-color border-0" required autocomplete="current-password"
                    placeholder="Password">
                <span class="input-group-text">
                    <i class="fe fe-eye border-start" data-bs-toggle="tooltip" title="fe fe-eye"></i>
                </span>
            </div> -->

            <div class="input-group input-group-lg bg-color2">
                <input id="password1" type="password" name="password" :value="old('email')" required
                    autocomplete="current-password" placeholder="Password"
                    class="form-control border-1 form-control-lg profileUpdateFont input-placeholder" type="text"
                    aria-label=".form-control-lg example">
                <span class="input-group-text border border-dark border-start-0"
                    id="inputGroup-sizing-lg">
                    <span toggle="#password1" class="ti ti-eye field-icon toggle-password1"></span>
                </span>
                </span>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                @endif

                <x-primary-button class="btn w-100 btn-primary authBTN">
                    {{ __('Login') }}
                </x-primary-button>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#warehouse_code").on("keyup", function() {
                let query = $(this).val();

                if (query.length >= 3) { // 🔹 Jab 3 letters type karega
                    $.ajax({
                        url: "/api/warehouse-list",
                        method: "POST",
                        data: {
                            warehouse_code: query,
                            _token: "{{ csrf_token() }}" // 🔹 Laravel CSRF Protection
                        },
                        success: function(response) {
                            console.log(response.data);
                            let dropdown = $("#warehouseDropdown");
                            dropdown.empty(); // 🔹 Pehle ka data clear karo

                            if (response.data.length > 0) { // ✅ Sahi tarike se length check
                                response.data.forEach(warehouse => {
                                    dropdown.append(
                                        `<li class="dropdown-item warehouse-option" data-code="${warehouse.warehouse_code}">${warehouse.warehouse_code}</li>`
                                    );
                                });

                                // ✅ Dropdown Show + Position Fix
                                dropdown.show();
                            } else {
                                dropdown.hide();
                            }
                        }
                    });
                } else {
                    $("#warehouseDropdown").hide();
                }

            });

            // 🔹 Select Option Click Kare To Input Me Set Ho Jaye
            $(document).on("click", ".warehouse-option", function() {
                $("#warehouse_code").val($(this).data("code"));
                $("#warehouseDropdown").hide();
            });
        });
    </script>
    <script>
        function toggleLoginForm(type) {
            if (type === 'admin') {
                document.getElementById('admin').style.display = 'block';
                document.getElementById('manager').style.display = 'none';
                document.getElementById('adminBtn').classList.add('active1');
                document.getElementById('managerBtn').classList.remove('active1');
                updateURL('admin');
            } else if (type === 'manager') {
                document.getElementById('admin').style.display = 'none';
                document.getElementById('manager').style.display = 'block';
                document.getElementById('adminBtn').classList.remove('active1');
                document.getElementById('managerBtn').classList.add('active1');
                updateURL('manager');
            }
        }

        // Function to update URL without reloading the page
        function updateURL(type) {
            let newUrl = window.location.pathname + "?id=" + type;
            window.history.pushState({
                path: newUrl
            }, "", newUrl);
        }

        // Function to check URL parameters on page load
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const formType = urlParams.get('id') || 'admin'; // Default 'admin'
            toggleLoginForm(formType);
        };
    </script>
    <script>
    $(".toggle-password1").click(function() {

        $(this).toggleClass("ti-eye-off");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

</script>
    <!-- -------------------------------------------------------------------------------------------------- -->
</x-guest-layout>