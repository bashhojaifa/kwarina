<div id="nav-header" class="navbar navbar-default {{ Request::is('/') ? '' : 'navbar-fixed-top' }}">
    <div class="container-fluid">
        <div class="navbar-header">

            <a href="javascript:void(0);" class="collapsed pull-left" data-toggle="collapse" data-target="#navbar-collapse"></a>
            <a href="javascript:void(0);" class="bars"></a>

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="#">
                <img src="{{ Storage::disk('public')->url('logo/header-logo.png') }}" alt="#">
                <p class="foundation-name">
                    <span class="first-para">বিজ্ঞান সম্মত পদ্ধতিতে ক্বরীয়ানা কুরআনুম মাজীদ শিক্ষা ফাউন্ডেশন</span>
                    <small class="second-para">The Learning of the Holy Quran of the Kwarina Wethod Scientifically</small>
                </p>
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <nav class="shift">
            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('home') }}">HOME</a></li>

                @auth
                    <li class="{{ Request::is('post') ? 'active' : '' }}"><a href="{{ route('post') }}">POST</a></li>
                @endauth
                @guest

                    <li><a class="{{ Request::is('login') ? 'active' : '' }}" href="{{ route('login') }}"> LOGIN</a></li>
                @else

                    <li class="nav-item dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu fade-up">
                            @if(Auth::user()->role_id == 1)
                                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            @endif

                            @if(Auth::user()->role_id == 2)
                                <li><a class="dropdown-item" href="{{ route('author.post.index') }}">Profile</a></li>
                            @endif

                            @if(Auth::user()->role_id == 3)
                                    <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a></li>
                            @endif

                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>

                @endguest

            </ul>
            </nav>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</div>



{{--<div class="navbar navbar-expand-lg navbar-dark navbar-fixed-top">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-12">--}}

{{--                <div class="navbar-header">--}}
{{--                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">--}}
{{--                        <span class="sr-only">Toggle navigation</span>--}}
{{--                        <span class="icon-bar"></span>--}}
{{--                        <span class="icon-bar"></span>--}}
{{--                        <span class="icon-bar"></span>--}}
{{--                    </button>--}}
{{--                    <a class="navbar-brand" href="#">Project name</a>--}}
{{--                </div>--}}

{{--                <div class="navbar-collapse collapse" id="mobile_menu">--}}
{{--                    <nav class="shift">--}}
{{--                    <ul class="nav navbar-nav">--}}
{{--                        <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('home') }}">HOME</a></li>--}}

{{--                        @auth--}}
{{--                            <li class="{{ Request::is('post') ? 'active' : '' }}"><a href="{{ route('auth.post') }}">POST</a></li>--}}
{{--                        @endauth--}}
{{--                        <li class="nav-item dropdown">--}}
{{--                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">ABOUT US <span class="caret"></span></a>--}}
{{--                            <ul class="dropdown-menu fade-up">--}}
{{--                                <li><a class="dropdown-item" href="#"> Submenu item 1</a></li>--}}
{{--                                <li><a class="dropdown-item" href="#"> Submenu item 2 </a></li>--}}
{{--                                <li><a class="dropdown-item" href="#"> Submenu item 3 </a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}


{{--                        @if(Auth::user()->role_id == 1)--}}
{{--                            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">--}}
{{--                                <a href="{{ route('admin.dashboard') }}">--}}
{{--                                    Dashboard--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endif--}}
{{--                    </ul>--}}

{{--                    <ul class="nav navbar-nav">--}}
{{--                        <li>--}}
{{--                            <form action="" class="navbar-form">--}}
{{--                                <div class="form-group">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <input type="search" name="search" id="" placeholder="Search Anything Here..." class="form-control">--}}
{{--                                        <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </li>--}}
{{--                    </ul>--}}

{{--                    <ul class="nav navbar-nav navbar-right">--}}
{{--                        @guest--}}
{{--                            <li><a class="{{ Request::is('login') ? 'active' : '' }}" href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>--}}
{{--                        @else--}}
{{--                            <li class="nav-item dropdown">--}}
{{--                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> {{ Auth::user()->name }} <span class="caret"></span></a>--}}
{{--                                <ul class="dropdown-menu fade-up">--}}
{{--                                    <li><a class="dropdown-item" href="{{ route('author.post.index') }}"> Your Post</a></li>--}}
{{--                                    <li><a class="dropdown-item" href="#"> Setting </a></li>--}}
{{--                                    <li>--}}
{{--                                        <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                                           onclick="event.preventDefault();--}}
{{--                                            document.getElementById('logout-form').submit();">--}}
{{--                                            Logout--}}
{{--                                        </a>--}}
{{--                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--                                            @csrf--}}
{{--                                        </form>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}

{{--                        @endguest--}}

{{--                     </ul>--}}
{{--                    </nav>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

