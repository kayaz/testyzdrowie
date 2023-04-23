<header>
    <div id="header">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <a href="/" class="d-flex justify-content-center align-items-center" title="{!! settings()->get("page_logo_title") !!}">
                        <div id="logo"><img src="{{ asset('/images/logo.png') }}" alt="{!! settings()->get("page_logo_alt") !!}"></div>
                        <h1>Podkarpacki Oddział PTMSiZP</h1>
                    </a>
                </div>
                <div class="col-7">
                    <nav>
                        <ul class="list-unstyled mb-0 d-flex justify-content-end">
                            <li><a href="/">Witamy</a></li>
                            <li {{ Request::routeIs('about') ? 'class=active' : '' }}><a href="{{ route("about") }}">O nas</a></li>
                            <li {{ Request::routeIs('article') ? 'class=active' : '' }}><a href="{{ route("article") }}">Konferencje i szkolenia</a></li>
                            <li {{ Request::routeIs('course.*') ? 'class=active' : '' }}><a href="{{ route("course.index") }}">Kursy</a></li>
                            <li {{ Request::routeIs('contact.*') ? 'class=active' : '' }}><a href="{{ route("contact.index") }}">Kontakt</a></li>
                        </ul>
                    </nav>
                </div>
                @guest
                <div class="col-2 d-flex justify-content-center align-items-center">
                    <a href="{{ route("course.form") }}" class="btn btn-theme w-100">ZAPISZ SIĘ</a>
                </div>
                @endguest

                @auth
                <div class="col-2 d-flex justify-content-end align-items-center">
                    Witaj:&nbsp;&nbsp;<b>{{ Auth::user()->name }}</b>
                </div>
                @endauth
                <div class="col-12">
                    <ul id="user-nav" class="list-unstyled mb-0">
                        @guest
                        <li><a href="{{ route('login') }}">Zaloguj się</a></li>
                        @endguest
                        @auth
                        @if($examDateUsers->count() > 0)
                            <li><a href="{{ route('student.index') }}">Moje kursy</a></li>
                        @endif
                        <li><a href="">Zmień hasło</a></li>
                        @can('admin-panel')
                        <li><a href="/admin" class="text-danger">Administrator</a></li>
                        @endcan
                        <li>
                            <a title="Wyloguj" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Wyloguj się</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>