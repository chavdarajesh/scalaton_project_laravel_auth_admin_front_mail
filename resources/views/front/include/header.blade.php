@php $current_route_name=Route::currentRouteName() @endphp
<!-- ======= Header ======= -->
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="{{ route('front.homepage') }}" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="{{ asset('assets/front/img/logo.png') }}" alt=""> -->
            <h1>{{ env('APP_NAME', 'Laravel App') }}</h1>
        </a>

        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a href="{{ route('front.homepage') }}"
                        class="{{ $current_route_name == 'front.homepage' ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('front.aboutpage') }}"
                        class="{{ $current_route_name == 'front.aboutpage' ? 'active' : '' }}">About</a></li>
                <li><a href="{{ route('front.servicespage') }}"
                        class="{{ $current_route_name == 'front.servicespage' ? 'active' : '' }}">Services</a></li>
                <li><a href="{{ route('front.contactpage') }}"
                        class="{{ $current_route_name == 'front.contactpage' ? 'active' : '' }}">Contact</a></li>
                <li><a href="{{ route('front.blogpage') }}" class="">Blogs</a></li>


                <li class="dropdown"><a href="#"
                        class=" {{ $current_route_name == 'front.profilepage' ? 'active' : '' }} "><span>Account</span>
                        <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        @if (Auth::check())
                            @if (Auth::check() && Auth::user()->is_admin == 1)
                                <li><a target="_blank" href="{{ route('admin.login') }}"
                                        class="{{ $current_route_name == 'admin.login' ? 'active' : '' }}">Admin
                                        Panel</a></li>
                            @endif
                            <li><a href="{{ route('front.profilepage') }}" class="active">Profile</a></li>
                            <li>
                                <form action="{{ route('front.post.logout') }}" method="POST">
                                    @csrf
                                    <button class="logout-btn"
                                        style="padding: 10px 20px; font-size: 15px; text-transform: none; font-weight: 400;  background-color: unset; border: unset;"
                                        type="submit">
                                        Log Out
                                    </button>
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('front.register') }}"
                                    class="{{ $current_route_name == 'front.register' ? 'active' : '' }}">Register</a>
                            </li>
                            <li><a href="{{ route('front.login') }}"
                                    class="{{ $current_route_name == 'front.login' ? 'active' : '' }}">Login</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
<!-- End Header -->
