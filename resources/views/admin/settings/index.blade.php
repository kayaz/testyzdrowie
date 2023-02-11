@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card-head container-fluid">
            <div class="row">
                <div class="col-12 pl-0">
                    <h4 class="page-title row"><i class="fe-sliders"></i>Ustawienia</h4>
                </div>
            </div>
        </div>

        <div class="card-header border-bottom card-nav">
            <nav class="nav">
                <a class="nav-link {{ Request::routeIs('admin.settings.seo.index') ? 'active' : '' }}" href="{{ route('admin.settings.seo.index') }}"><span class="fe-globe"></span> Główne ustawienia</a>
                <a class="nav-link {{ Request::routeIs('admin.log.*') ? 'active' : '' }}" href="{{route('admin.log.index')}}"><span class="fe-hard-drive"></span> Logi PA</a>
                <a class="nav-link {{ Request::routeIs('admin.settings.popup.index') ? 'active' : '' }}" href="{{route('admin.settings.popup.index')}}"><span class="fe-airplay"></span> Baner na start</a>
            </nav>
        </div>
        <div class="card mt-3">
            <div class="card-body card-body-rem p-0">
                <div class="table-overflow">
                    @yield('settings')
                </div>
            </div>
        </div>
    </div>
@endsection
