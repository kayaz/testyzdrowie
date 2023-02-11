@extends('layouts.page')

@section('meta_title', 'O nas')
@section('seo_title', '')
@section('seo_description', '')

@section('pageheader')
    @include('layouts.partials.page-header', ['page' => '', 'header_file' => 'contact.jpg'])
@stop

@section('content')
    <div class="page-text">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-heading">
                        <span class="section-text">Wybierz kurs </span>
                        <span class="section-dot"></span>
                        <span class="section-line"></span>
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="course">
                        <i class="las la-calendar"></i>
                        <h3><a href="{{ route("course.form") }}">Kurs dla lekarzy rzeszowskiej OIL - Zdrowie publiczne</a></h3>
                        <p>Dostępne terminy:</p>
                        <ul class="list-unstyled">
                            <li><i class="las la-calendar-day"></i> 2023-01-11 do 2023-01-20</li>
                            <li><i class="las la-calendar-day"></i> 2023-05-08 do 2023-05-17</li>
                            <li><i class="las la-calendar-day"></i> 2023-10-04 do 2023-10-13</li>
                        </ul>
                        <div class="course-footer text-center">
                            <a href="{{ route("course.form") }}" class="btn btn-theme">ZAPISZ SIĘ</a>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="course">
                        <i class="las la-calendar"></i>
                        <h3><a href="{{ route("course.form") }}">Kurs dla lekarzy rzeszowskiej OIL - Zdrowie publiczne</a></h3>
                        <p>Dostępne terminy:</p>
                        <ul class="list-unstyled">
                            <li><i class="las la-calendar-day"></i> 2023-01-11 do 2023-01-20</li>
                            <li><i class="las la-calendar-day"></i> 2023-05-08 do 2023-05-17</li>
                            <li><i class="las la-calendar-day"></i> 2023-10-04 do 2023-10-13</li>
                        </ul>
                        <div class="course-footer text-center">
                            <a href="{{ route("course.form") }}" class="btn btn-theme">ZAPISZ SIĘ</a>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="course">
                        <i class="las la-calendar"></i>
                        <h3><a href="{{ route("course.form") }}">Kurs dla lekarzy rzeszowskiej OIL - Zdrowie publiczne</a></h3>
                        <p>Dostępne terminy:</p>
                        <ul class="list-unstyled">
                            <li><i class="las la-calendar-day"></i> 2023-01-11 do 2023-01-20</li>
                            <li><i class="las la-calendar-day"></i> 2023-05-08 do 2023-05-17</li>
                            <li><i class="las la-calendar-day"></i> 2023-10-04 do 2023-10-13</li>
                        </ul>
                        <div class="course-footer text-center">
                            <a href="{{ route("course.form") }}" class="btn btn-theme">ZAPISZ SIĘ</a>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="course">
                        <i class="las la-calendar"></i>
                        <h3><a href="{{ route("course.form") }}">Kurs dla lekarzy rzeszowskiej OIL - Zdrowie publiczne</a></h3>
                        <p>Dostępne terminy:</p>
                        <ul class="list-unstyled">
                            <li><i class="las la-calendar-day"></i> 2023-01-11 do 2023-01-20</li>
                            <li><i class="las la-calendar-day"></i> 2023-05-08 do 2023-05-17</li>
                            <li><i class="las la-calendar-day"></i> 2023-10-04 do 2023-10-13</li>
                        </ul>
                        <div class="course-footer text-center">
                            <a href="{{ route("course.form") }}" class="btn btn-theme">ZAPISZ SIĘ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection