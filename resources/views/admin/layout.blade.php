<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>kCMS @yield('meta_title')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="robots" content="noindex, nofollow">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Prefetch -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin.min.css') }}">

    @stack('style')

</head>
<body class="lang-pl">
<div id="admin">
    <div class="sidemenu-holder">
        <div id="sidemenu">
            <ul class="list-unstyled mb0">
                <li class="active">
                    <a href="#">
                        <i class="fe-cpu"></i>
                        <span> CMS </span>
                    </a>
                    <ul class="sub-menu">
                        <li {{ Request::routeIs('admin.settings.*') ? 'class=active' : '' }}>
                            <a href="{{ route('admin.settings.seo.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span> Ustawienia</a>
                        </li>

                        <li {{ Request::routeIs('admin.user.*') ? 'class=active' : '' }}>
                            <a href="{{ route('admin.user.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span> Użytkownicy</a>
                        </li>

                        <li {{ Request::routeIs('admin.greylist.*') ? 'class=active' : '' }}>
                            <a href="{{ route('admin.greylist.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span> Blokada dostępu</a>
                        </li>
                    </ul>
                </li>
                <li class="active">
                    <a href="#">
                        <i class="fe-cpu"></i>
                        <span> Testy </span>
                    </a>
                    <ul class="sub-menu">
                        <li {{ Request::routeIs('admin.exam.*') ? 'class=active' : '' }}>
                            <a href="{{ route('admin.exam.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span> Egzaminy</a>
                        </li>
                        <li {{ Request::routeIs('admin.file.*') ? 'class=active' : '' }}>
                            <a href="{{ route('admin.file.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span> Pliki</a>
                        </li>
                        <li {{ Request::routeIs('admin.calendar.*') ? 'class=active' : '' }}>
                            <a href="{{ route('admin.calendar.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span> Kalendarz</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>

    <div id="content">
        <header id="header-navbar">
            <h1><a href="" class="logo"><span>kCMS v4.2</span></a></h1>

            <a href="#" id="togglemenu"><span class="fe-menu"></span></a>

            <div class="user">
                <ul>
                    <li><span class="fe-calendar"></span> <span id="livedate"><?=date('d-m-Y');?></span></li>
                    <li><span class="fe-clock"></span> <span id="liveclock"></span></li>
                    <li><span class="fe-user"></span> Witaj: <b>{{ Auth::user()->name }}</b></li>
                    <li><a title="Idź do strony" href="{{ route('index') }}" target="_blank"><span class="fe-monitor"></span> Idź do strony</a></li>
                    <li>
                        <a title="Wyloguj" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span class="fe-lock"></span> Wyloguj</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </header>
        <div class="content">
            @yield('submenu')

            @yield('content')
        </div>
    </div>
</div>

<!--Google font style-->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- jQuery -->
<script src="{{ asset('/js/jquery.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/bootstrap.bundle.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/jquery-ui.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('/js/cms.min.js') }}" charset="utf-8"></script>

@stack('scripts')

</body>
</html>
