<div class="header header-one nav-head">

    <div class="main-logo d-inline float-start d-lg-flex align-items-center d-none d-sm-none d-md-none">
        <div class="dash-logo">
            <img src="{{asset('assets/images/AfroCargoLogo.svg')}}" alt="">
        </div>

    </div>
    <div>
        <a href="javascript:void(0);" class="side-toggle" id="toggle_btn">
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
    <div class="nav-profile">
        <button class="btn profile dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
            aria-expanded="false">
            <div class="">
                <span><i class="fa-regular fa-user" style="color: #ffffff;"></i></span>
            </div>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li>
                <a class="dropdown-item" href="{{route('profile.edit')}}">
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