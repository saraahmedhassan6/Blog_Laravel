<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="{{url('/')}}" class="logo d-flex align-items-center justify-content-center" >
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1 style="color: #a3cef1 ;">SaraBlog</h1>
        </a>


        <nav id="navbar" class="navbar">
            <pre></pre><pre></pre>
            <ul >

                <li><a href="{{url('/')}}">Home</a></li>

                <li><a href="{{url('Blogs')}}">Blogs</a></li>

                <li><a href="{{url('project')}}">Projects</a></li>


                <li><a href="{{url('Team')}}">Authors</a></li>




                <li class="dropdown"><a >  <img src="{{asset('assets/img/OIP.JPG')}}" alt="" style="width: 30px"          ><i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        @guest
                        @else
                        <a href="{{url('Dashbord')}}">Dashboard</a>
                        @endguest
                        @guest
                            <a class="no-underline hover:underline" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                                <a class="no-underline hover:underline" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @else
                            <a >{{Auth::user()->name}}</a>
                            <a href="{{ route('logout') }}"
                               class="no-underline hover:underline"
                               onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>
                        @endguest

                    </ul>
                </li>


            </ul>
        </nav><!-- .navbar -->

        <div class="position-relative">
            <a href="https://www.facebook.com/profile.php?id=100026431260579" class="mx-2"><span class="bi-facebook"></span></a>
            <a href="https://twitter.com/Saraahmedhassn" class="mx-2"><span class="bi-twitter"></span></a>
            <a href="https://www.instagram.com/sara.ahmed93/" class="mx-2"><span class="bi-instagram"></span></a>

            <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </div>

            <!-- ======= Search Form ======= -->
            <div class="search-form-wrap js-search-form-wrap">
                <form action="" class="search-form">
                    <span class="icon bi-search"></span>
                    <input type="text" placeholder="Search" class="form-control">
                    <button class="btn js-search-close"><span class="bi-x"></span></button>
                </form>
            </div><!-- End Search Form -->


    </div>

</header>
