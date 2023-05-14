@extends('layouts.page')

@section('meta_title', 'Moje kursy')
@section('seo_title', '')
@section('seo_description', '')

@section('pageheader')
    @include('layouts.partials.page-header', ['title' => 'Moje kursy', 'header_file' => 'pageheader.jpg'])
@stop

@section('content')
    <div class="page-text">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <ul class="list-group student-menu">
                        @foreach ($examDateUsers as $examDateUser)
                        <li class="list-group-item">
                            @if(checkExam($examDateUser->examDate->start, $examDateUser->examDate->end))
                            <a href="{{ route('exam.info', [$examDateUser->exam, $examDateUser->examDate->id]) }}">
                            @endif
                                <div class="fw-bold">{{ $examDateUser->exam->name }}</div>
                                <p><i class="las la-calendar-day"></i>  {{$examDateUser->examDate->start }} <i class="las la-long-arrow-alt-right me-2 ms-2"></i> {{$examDateUser->examDate->end }}</p>
                                @if(checkExam($examDateUser->examDate->start, $examDateUser->examDate->end))
                                    <span class="btn btn-theme btn-theme-red btn-sm mt-3 w-100">SZCZEGÓŁY</span>
                                    @if(checkExam($examDateUser->examDate->exam, $examDateUser->examDate->end))
                                        <a href="{{ route('exam.index', [$examDateUser->exam, $examDateUser->examDate]) }}" class="btn btn-theme btn-theme-red btn-sm mt-3 w-100">ROZPOCZNIJ TEST</a>
                                    @endif
                                @endif
                            @if(checkExam($examDateUser->examDate->start, $examDateUser->examDate->end))
                            </a>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-9">
                    <div class="ps-5">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
