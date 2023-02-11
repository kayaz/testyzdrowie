@extends('layouts.auth.layout')

@section('content')
<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <div class="row">
        <div class="col-12 mb-4 mb-sm-5 d-flex justify-content-center align-items-center">
            <img src="{{ asset('/images/logo.png') }}" alt="Podkarpacki Oddział PTMSiZP">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h2 class="section-heading">
                <span class="section-text">Nadaj nowe hasło </span>
                <span class="section-dot"></span>
                <span class="section-line"></span>
            </h2>
        </div>
    </div>
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">Adres e-mail</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required>
            @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">Hasło</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

            @error('password')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Powtórz hasło</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn">Zmień hasło</button>
        </div>
    </div>
</form>
@endsection
