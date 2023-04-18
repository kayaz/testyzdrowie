@extends('layouts.auth.layout')

@section('content')
<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="row">
        <div class="col-12 mb-4 mb-sm-5 d-flex justify-content-center align-items-center">
            <img src="{{ asset('/images/logo.png') }}" alt="Podkarpacki Oddział PTMSiZP">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h2 class="section-heading">
                <span class="section-text">Odzyskaj hasło </span>
                <span class="section-dot"></span>
                <span class="section-line"></span>
            </h2>
        </div>
    </div>
    @if (session('status'))
    <div class="row">
        <div class="col-md-8 offset-md-4">
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        </div>
    </div>
    @endif
    <div class="form-group row">
        <label for="email" class="col-12 col-md-4 col-form-label text-md-right">E-mail:</label>
        <div class="col-12 col-md-8">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
            @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-12 col-md-8 offset-md-4">
            <button type="submit" class="btn w-100">Wyślij wiadomość</button>
        </div>
        <div class="col-12">

            <div class="row mt-4">
                @if (Route::has('password.request'))
                    <div class="col-6 text-center border-end p-3">
                        <a href="{{ route('login') }}">Logowanie</a>
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
