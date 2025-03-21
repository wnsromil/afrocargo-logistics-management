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
                <div class="col-md-12 d-flex text-center ps-4 ms-5">
                    <div id="click"></div>
                    <button id="adminBtn" type="button" class="border-0 th-font fw-semiBold p-1 pe-2 faded"
                        onclick="toggleLoginForm('admin')">Admin</button>

                    <button id="managerBtn" type="button" class="border-0 th-font fw-semiBold p-1 ps-2 faded"
                        onclick="toggleLoginForm('manager')">Warehouse Manager</button>
                </div>

                <!-- <div class="border-bottom border-1 border-dark border-opacity-50 mb-4 login-border-width"></div> -->
                <!-- First Border -->
                <div class="border-bottom border-1 border-dark border-opacity-50 mb-4 login-border-width"></div>


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


            <div class="input-group input-group-lg bg-color2 my-4">
                <input id="email" type="email" name="email" :value="old('email')" required autofocus
                    autocomplete="username"
                    class="form-control border-1 form-control-lg profileUpdateFont input-placeholder" type="text"
                    placeholder="Username or email address" aria-label=".form-control-lg example">
                <span class="input-group-text border border-dark border-opacity-25 border-start-0"
                    id="inputGroup-sizing-lg">
                    <i class="fa-regular fa-user" style="color: #595C5F"></i>
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
                <span class="input-group-text border border-dark border-opacity-25 border-start-0"
                    id="inputGroup-sizing-lg">
                    <i class="fe fe-unlock border-start" style="color: #595C5F" data-bs-toggle="tooltip"
                        title="fe fe-unlock"></i>
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

                <x-primary-button class="btn w-100 justify-content-center border rounded-0 text-capitalize login-btn">
                    {{ __('Login') }}
                </x-primary-button>
            </div>
        </form>

        <!-- -------------------------------------- manager login page ---------------------------------------- -->
        <form method="POST" action="{{ route('login') }}" id="manager" style="display:none;">
            @csrf
            <!-- 
            <div class="input-group mb-3 border rounded mt-4">
                <input id="warehouse_code" type="text" name="warehouse_code" :value="old('warehouse_code')"
                    class="form-control rounded border-0" required autofocus autocomplete="warehouse_code"
                    placeholder="Enter warehouse code">
                <span class="input-group-text bg-color border-start">
                    <img src="../assets/images/warehouse.svg" alt="#">
                </span>
            </div> -->

            <div class="input-group input-group-lg bg-color2 my-4">
                <input id="warehouse_code" type="text" name="warehouse_code" :value="old('warehouse_code')" required
                    autofocus autocomplete="username"
                    class="form-control border-1 form-control-lg profileUpdateFont input-placeholder" type="text"
                    placeholder="Enter warehouse code" aria-label=".form-control-lg example">
                <span class="input-group-text border border-dark border-opacity-25 border-start-0"
                    id="inputGroup-sizing-lg">
                    <img src="../assets/images/warehouse.svg" alt="#">
                </span>
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
                <span class="input-group-text border border-dark border-opacity-25 border-start-0"
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
                <input id="password" type="password" name="password" :value="old('email')" required
                    autocomplete="current-password" placeholder="Password"
                    class="form-control border-1 form-control-lg profileUpdateFont input-placeholder" type="text"
                    aria-label=".form-control-lg example">
                <span class="input-group-text border border-dark border-opacity-25 border-start-0"
                    id="inputGroup-sizing-lg">
                    <i class="fe fe-eye border-start" style="color: #595C5F" data-bs-toggle="tooltip"
                        title="fe fe-eye"></i>
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

                <x-primary-button class="btn w-100 justify-content-center border rounded-0 text-capitalize login-btn">
                    {{ __('Login') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <script>

        function toggleLoginForm(type) {
            if (type === 'admin') {
                document.getElementById('admin').style.display = 'block';
                document.getElementById('manager').style.display = 'none';
                document.getElementById('adminBtn').classList.add('active1');
                document.getElementById('managerBtn').classList.remove('active1');

            } else if (type === 'manager') {
                document.getElementById('admin').style.display = 'none';
                document.getElementById('manager').style.display = 'block';
                document.getElementById('adminBtn').classList.remove('active1');
                document.getElementById('managerBtn').classList.add('active1');
            }
        }

        window.onload = function () {
            toggleLoginForm('admin');
        };


    </script>

    <!-- -------------------------------------------------------------------------------------------------- -->

    <!-- Session Status -->
    <!-- <x-auth-session-status class="mb-4" :status="session('status')" /> -->

    <!-- <form method="POST" action="{{ route('login') }}">
        @csrf -->

    <!-- Email Address -->
    <!-- <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div> -->

    <!-- Password -->
    <!-- <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div> -->

    <!-- Remember Me -->
    <!-- <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div> -->

    <!-- <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif -->

    <!-- <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form> -->
</x-guest-layout>