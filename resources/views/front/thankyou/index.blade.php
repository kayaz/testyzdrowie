@extends('layouts.page')

@section('meta_title', 'Nowe konto')
@section('seo_title', '')
@section('seo_description', '')

@section('pageheader')
    @include('layouts.partials.page-header', ['title' => 'Nowe konto', 'header_file' => 'pageheader.jpg'])
@stop

@section('content')
    <div class="page-text">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-heading text-center">
                        <span class="section-text">Dziękujemy za rejestrację </span>
                        <span class="section-dot"></span>
                        <span class="section-line"></span>
                    </h2>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-12 text-center">
                    <p>Dziękujemy za dokonanie rejestracji w serwisie Podkarpacki Oddział PTMSiZP. Twoje konto wymaga weryfikacji przez administratora. Po aktywacji konta, na podany podczas rejestracji adres e-mail otrzymasz wiadomość.</p>
                </div>
                <div class="col-6 text-center">
                    <hr class="mt-5 mb-5">
                    <p>Oczekując na aktywacje konta, zapoznaj się z naszymi kursami.</p>
                    <a href="{{ route("course.index") }}" class="btn btn-theme btn-md mt-4">Kursy</a>
                </div>
            </div>
        </div>
    </div>
@endsection