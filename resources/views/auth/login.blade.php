@extends('layouts.auth.layout')

@section('content')
<form method="POST" action="{{ route('login') }}" autocomplete="off">
    @csrf
    <div class="row">
        <div class="col-12 mb-4 mb-sm-5 d-flex justify-content-center align-items-center">
            <img src="{{ asset('/images/logo.png') }}" alt="Podkarpacki Oddział PTMSiZP">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h2 class="section-heading">
                <span class="section-text">Logowanie </span>
                <span class="section-dot"></span>
                <span class="section-line"></span>
            </h2>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if ($message = session('message'))
                <div class="alert alert-info">
                    {{ $message }}
                </div>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-12 col-md-4 col-form-label text-md-right">Adres e-mail</label>
        <div class="col-12 col-md-8">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
            @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-12 col-md-4 col-form-label text-md-right">Hasło</label>
        <div class="col-12 col-md-8">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
            @error('password')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <div class="col-12 col-md-8 offset-md-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">Zapamiętaj mnie</label>
            </div>
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-12 col-md-8 offset-md-4">
            <button type="submit" class="btn">Zaloguj się</button>
        </div>
        <div class="col-12">

            <div class="row mt-4">
                @if (Route::has('password.request'))
                <div class="col-6 text-center border-end p-3">
                    <a href="{{ route('password.request') }}">Zapomniałeś hasła?</a>
                </div>
                @endif
                <div class="col-6 text-center p-3">
                    <a href="{{ route("course.form") }}">Utwórz nowe konto</a>
                </div>
            </div>

        </div>
    </div>
</form>
@endsection
