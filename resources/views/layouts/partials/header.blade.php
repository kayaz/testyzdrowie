<header>
    <div id="header">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <a href="/" class="d-flex justify-content-center align-items-center">
                        <div id="logo"><img src="{{ asset('/images/logo.png') }}" alt=""></div>
                        <h1>Podkarpacki Oddział PTMSiZP</h1>
                    </a>
                </div>
                <div class="col-7">
                    <nav>
                        <ul class="list-unstyled mb-0 d-flex justify-content-end">
                            <li class="active"><a href="/">Witamy</a></li>
                            <li><a href="{{ route("about") }}">O nas</a></li>
                            <li><a href="">Konferencje i szkolenia</a></li>
                            <li><a href="{{ route("course.index") }}">Kursy</a></li>
                            <li><a href="{{ route("contact.index") }}">Kontakt</a></li>
                        </ul>
                    </nav>
                </div>
                @guest
                <div class="col-2 d-flex justify-content-center align-items-center">
                    <a href="{{ route("course.index") }}" class="btn btn-theme w-100">ZAPISZ SIĘ</a>
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
                        <li><a href="">Informacje</a></li>
                        <li><a href="">Materiały dydaktyczne</a></li>
                        <li><a href="">Materiały wideo</a></li>
                        <li><a href=""><b>Rozwiąż test</b></a></li>
                        <li><a href="">Zmień hasło</a></li>
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