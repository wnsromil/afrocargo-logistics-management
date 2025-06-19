<div class="header header-one nav-head shadow d-flex col-md-12 logopin align-items-center ">

    <div class="main-logo d-inline float-start d-lg-flex align-items-center align-center d-none d-sm-none d-md-none shadow col-md-8">
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
        <div class="d-flex align-items-center float-end me-3 me-sm-4">

            <a class="nav-link height-52 p-2" href="{{route('admin.notification.index')}}">
                <!-- <i class="fe fe-bell" style="font-size:30px; color:white"></i> <span class="badge rounded-pill"></span> -->
                {{-- <img src="{{asset('../assets/images/notification BTN.svg')}}" alt="..." /> --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-bell">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                    <path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
            </a>


            <div class="nav-profile">
                <button class="nav-link btn height-52 profile dropdown-toggle btnColor1 p-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
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

            <!-- Mobile Menu Toggle -->
            <a class="nav-link height-52 d-block d-sm-none text-white position-relative p-2 pe-1" id="mobile_btn">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="32"  height="32"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-align-right-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 4v16" /><path d="M4 6h12" /><path d="M10 12h6" /><path d="M6 18h10" /></svg>
            </a>
            <!-- /Mobile Menu Toggle -->
        </div>
    </div>
</div>
