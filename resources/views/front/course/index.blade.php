@extends('layouts.page')

@section('meta_title', 'Lista dostępnych kursów')
@section('seo_title', '')
@section('seo_description', '')

@section('pageheader')
    @include('layouts.partials.page-header', ['title' => 'Dostępne kursy', 'header_file' => 'pageheader.jpg'])
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

                @if (session('error'))
                <div class="col-12 alert-container">
                    <div class="alert alert-warning mb-5">
                        {{ session('error') }}
                    </div>
                </div>
                <script>setTimeout(function(){$(".alert-container").slideUp(500,function(){$(this).remove()})},3000)</script>
                @endif

                @foreach($list as $course)
                <div class="col-4">
                    <div class="course">
                        <i class="las la-calendar"></i>
                        <h3>{{ $course->name }}</h3>
                        @if($course->availableDates->count() > 0)
                            <p>Dostępne terminy:</p>
                            @auth
                            <form action="{{ route('course.check') }}" method="post" class="validateForm">
                            {{ csrf_field() }}
                            @endauth

                                <ul class="list-unstyled">
                                    @foreach($course->availableDates as $exam_date)
                                        <li>
                                            @auth
                                                @can('exam-register')
                                            <label for="exam_id_{{ $exam_date->id }}">
                                            <input type="radio" name="date" id="exam_id_{{ $exam_date->id }}" value="{{ $exam_date->id }}" class="validate[required]">
                                                @endcan
                                            @endauth
                                                <i class="las la-calendar-day"></i> {{ $exam_date->start }}
                                                <i class="las la-long-arrow-alt-right me-2 ms-2"></i> {{ $exam_date->end }}
                                            @auth
                                            </label>
                                            @endauth
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="course-footer text-center">
                                    @auth
                                        @can('exam-register')
                                        <input type="hidden" name="exam_id" value="{{ $course->id }}">
                                        <button type="submit" class="btn btn-theme">ZAPISZ SIĘ</button>
                                        @else
                                            <p class="text-danger">Twoje konto wymaga weryfikacji.</p>
                                        @endcan
                                    @endauth
                                    @guest
                                        <p class="text-danger">Zaloguj się, aby zapisać się na kurs.</p>
                                    @endguest
                                </div>

                            @auth
                            </form>
                            @endauth
                        @else
                            <div class="course-footer text-center">
                                <p class="text-danger">Brak terminów</p>
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@auth
@push('scripts')
    <script src="{{ asset('js/validation.js') }}" charset="utf-8"></script>
    <script src="{{ asset('js/pl.js') }}" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".validateForm").validationEngine({
                validateNonVisibleFields: true,
                updatePromptsPosition:true,
                focusFirstField:false,
                scroll:false,
                promptPosition : "topLeft:0"
            });
        });
    </script>
@endpush
@endauth