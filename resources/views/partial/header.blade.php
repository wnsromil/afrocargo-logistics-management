<div class="header header-one nav-head shadow d-flex col-md-12 align-items-center justify-content-between">

    <div class="main-logo d-inline float-start d-lg-flex align-items-center d-none d-sm-none d-md-none shadow col-md-8">
        <div class="dash-logo logopin">
            <img src="{{asset('assets/images/AfroCargoLogo.svg')}}" alt="">
        </div>

    </div>
    <div>
        <!-- <a href="javascript:void(0);" class="side-toggle" id="toggle_btn">
            <span class="toggle-bars">
                <span class="bar-icons"></span>
                <span class="bar-icons"></span>
                <span class="bar-icons"></span>
                <span class="bar-icons"></span>
            </span>
        </a> -->
        <a href="javascript:void(0);" id="toggle_btn" class="side-toggle">
            <span class="toggle-bars">
                <span class="bar-icons"></span>
                <span class="bar-icons"></span>
                <span class="bar-icons"></span>
                <span class="bar-icons"></span>
            </span>
        </a>
    </div>

    <!-- Sidebar Toggle -->
    <div class="dash2">
        <h5 style="color: #ffffff">
            @isset($header)
                {{ $header }}
            @endisset
        </h5>
    </div>
    <!-- /Sidebar Toggle -->

    <!-- Search -->

    <!-- /Search -->

    <!-- Mobile Menu Toggle -->

    <!-- /Mobile Menu Toggle -->

    <!-- Header Menu -->

    <!-- -------------- Notification ------------------------------ -->
    <div class="col-md-6 d-flex align-items-center justify-content-end me-4">

        <a class="nav-link mt-1 me-2" href="{{route('admin.notification.index')}}">
            <!-- <i class="fe fe-bell" style="font-size:30px; color:white"></i> <span class="badge rounded-pill"></span> -->
            <img src="../assets/images/notification BTN.svg" alt="..." />
        </a>


        <div class="nav-profile">
            <button class="btn profile dropdown-toggle btnColor1" type="button" id="dropdownMenuButton1"
                data-bs-toggle="dropdown" aria-expanded="false">
                <span><i class="fa-regular fa-user" style="color: #ffffff; font-size:25px;"></i></span>

            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li>
                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                        <img class="mr-3" src="{{asset('assets/images/myprofile.svg')}}" alt="">
                        <span class="drop-span">{{ __('Profile') }}</span>
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="#" onclick="event.preventDefault();
                this.closest('form').submit();">
                            <img class="mr-3" src="{{asset('assets/images/logout.svg')}}" alt="">
                            <Span class="drop-span">{{ __('Log Out') }}</Span>

                        </a>
                    </form>

                </li>

            </ul>
        </div>
    </div>
</div>