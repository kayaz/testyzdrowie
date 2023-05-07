@extends('layouts.page')

@section('meta_title', $exam->name)
@section('seo_title', '')
@section('seo_description', '')

@section('pageheader')
    @include('layouts.partials.page-header', ['title' => $exam->name, 'header_file' => 'pageheader.jpg'])
@stop

@section('content')
    <div class="page-text">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-6">
                    <div class="course text-center course-single">
                        @if (session('error'))
                            <div class="alert alert-warning">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success border-0 mb-0">
                                {{ session('success') }}
                            </div>
                        @else
                            @auth
                                @if(!$existRegister)
                                    @can('exam-register')
                                        <form action="{{ route('course.store', [$exam, $examdate]) }}" method="post" class="validateForm">
                                        {{ csrf_field() }}
                                    @endcan
                                @endif
                            @endauth
                                <i class="las la-calendar"></i>
                                <h4 class="mb-4">{{ $exam->name }}</h4>
                                <p>Wybrany termin:</p>
                                <ul class="list-unstyled">
                                    <li class="justify-content-center"><b>{{ $examdate->start }}</b> <i class="las la-long-arrow-alt-right me-2 ms-2"></i> <b>{{ $examdate->end }}</b></li>
                                </ul>
                                @auth
                                    @if(!$existRegister)
                                        @can('exam-register')
                                            <div class="col-12 rules">
                                                <input type="checkbox" id="examRule" name="rules" class="validate[required]" data-prompt-position="topRight:18px">
                                                <label for="examRule">Przeczytałem i akceptuje <a href="#" target="_blank" data-bs-toggle="modal" data-bs-target="#exampleModal">regulamin</a></label>
                                            </div>
                                        @else
                                            <p class="text-danger">Twoje konto wymaga weryfikacji.</p>
                                        @endcan
                                    @endif
                                @endauth
                                <a href="{{ route('course.index') }}" class="btn btn-theme btn-theme-grey mt-4">WRÓĆ DO LISTY</a>
                                @auth
                                    @if(!$existRegister)
                                        @can('exam-register')
                                            <button type="submit" class="btn btn-theme mt-4">ZAPISZ SIĘ</button>
                            </form>
                                        @endcan
                                    @endif
                                @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Regulamin {{ $exam->name }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-rules-body">
                    {!! $exam->statute !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-theme" data-bs-dismiss="modal">ZAMKNIJ</button>
                </div>
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
