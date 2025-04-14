<div class="header header-one nav-head shadow d-flex col-md-12 logopin align-items-center ">

    <div
        class="main-logo d-inline float-start d-lg-flex align-items-center align-center d-none d-sm-none d-md-none shadow col-md-8">
        <div class="dash-logo logopin">
            <img src="{{asset('assets/images/AfroCargoLogo.svg')}}" alt="">
        </div>

    </div>

    <div class="d-flex justify-content-between w-100">

        <div class="ps-3">
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
    


        <!-- Sidebar Toggle -->
        <div class="dash2 countFontSize2 header-heading">
            <h5 style="color: #ffffff">
                @isset($header)
                    {{ $header }}
                @endisset
            </h5>
        </div>
</div>
        <!-- /Sidebar Toggle -->

        <!-- Search -->

        <!-- /Search -->

        <!-- Mobile Menu Toggle -->

        <!-- /Mobile Menu Toggle -->

        <!-- Header Menu -->

        <!-- -------------- Notification ------------------------------ -->
        <div class="d-flex align-items-center float-end me-4">

            <a class="nav-link mt-1 me-2 pt-2" href="{{route('admin.notification.index')}}">
                <!-- <i class="fe fe-bell" style="font-size:30px; color:white"></i> <span class="badge rounded-pill"></span> -->
                <img src="{{asset('../assets/images/notification BTN.svg')}}" alt="..." />
            </a>


            <div class="nav-profile">
                <button class="btn profile dropdown-toggle btnColor1" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <span><i class="fe fe-user" style="color:rgb(255, 255, 255)"></i></span>

                </button>
                <ul class="dropdown-menu profileDropdown" aria-labelledby="dropdownMenuButton1">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                            <i class="ti ti-user-search"></i>
                            <span class="drop-span">{{ __('Profile') }}</span>
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="#" onclick="event.preventDefault();
                this.closest('form').submit();">
                                <i class="ti ti-power"></i>
                                <Span class="drop-span">{{ __('Log Out') }}</Span>

                            </a>
                        </form>

                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
