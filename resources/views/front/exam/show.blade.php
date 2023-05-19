@extends('layouts.page')

@section('meta_title', 'Rozwiąż test')
@section('seo_title', '')
@section('seo_description', '')

@section('pageheader')
    @include('layouts.partials.page-header', ['title' => 'Rozwiąż test', 'header_file' => 'contact.jpg'])
@stop

@section('content')
    <div class="page-text">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if($exam)
                        <h2 class="section-heading">
                            <span class="section-text">{{ $exam->name }} </span>
                            <span class="section-dot"></span>
                            <span class="section-line"></span>
                        </h2>
                        <p>Należy wybrać tylko jedną prawidłową odpowiedź i zaznaczyć ją. <b class="text-danger">Odświeżenie strony będzie traktowane jako kolejne podejście do testu!</b></p>
                        <div class="timer-holder">
                            <div id="timer"></div>
                            <p>Zaznaczone odpowiedzi: <span id="qTimer">0</span> / {{ $exam->question }}</p>
                        </div>
                        <form method="post" action="{{ route('exam.store', [$exam, $date]) }}" class="test" id="form">
                            {{ csrf_field() }}
                            <ol class="list-unstyled mb-0">
                                @foreach($questions as $k => $q)
                                    <h3><?=$k+1;?>. {{ $q->question }}:</h3>
                                    <li>
                                        <label for="radio{{$q->id}}_1">
                                            <input class="qa" type="radio" name="pytanie{{$q->id}}" id="radio{{$q->id}}_1" value="1" disabled="disabled">
                                                {{ $q->answer_a }}
                                        </label>
                                        <label for="radio{{$q->id}}_2">
                                            <input class="qa" type="radio" name="pytanie{{$q->id}}" id="radio{{$q->id}}_2" value="2" disabled="disabled">
                                            {{ $q->answer_b }}
                                        </label>
                                        <label for="radio{{$q->id}}_3">
                                            <input class="qa" type="radio" name="pytanie{{$q->id}}" id="radio{{$q->id}}_3" value="3" disabled="disabled">
                                            {{ $q->answer_c }}
                                        </label>
                                        <label for="radio{{$q->id}}_4">
                                            <input class="qa" type="radio" name="pytanie{{$q->id}}" id="radio{{$q->id}}_4" value="4" disabled="disabled">
                                            {{ $q->answer_d }}
                                        </label>
                                    </li>
                                @endforeach
                            </ol>
                            <input type="hidden" name="attempt" value="{{ $examAttempt }}">
                            <input type="submit" value="Wyślij odpowiedzi" disabled="disabled" class="btn btn-theme btn-big mt-5">
                        </form>
                    @else
                        Brak opisu egzaminu
                    @endif
                </div>
            </div>
        </div>
    </div>
    <noscript>This page needs JavaScript activated to work.<style>.test { display:none; }</style></noscript>
@endsection

@push('scripts')
    <script src="{{ asset('js/validation.js') }}" charset="utf-8"></script>
    <script src="{{ asset('js/pl.js') }}" charset="utf-8"></script>
    <script src="{{ asset('js/exam.js') }}" charset="utf-8"></script>
    <script type="text/javascript">

        const all_checkbox = document.getElementsByClassName("qa");
        for ( let i = 0; i < all_checkbox.length; i++ ) {
            all_checkbox[i].addEventListener( "change", () => {
                document.getElementById('qTimer').innerText = document.querySelectorAll('input[type="radio"]:checked').length;
            });
        }

        $(document).ready(function(){
            $('#timer').backward_timer({
                seconds: {{ $exam->time_limit }},
                on_start: function() {
                    $('input[type=radio]').attr('disabled', false);
                    $('input[type=submit]').fadeIn().attr('disabled', false);
                },
                on_exhausted: function() {
                    $('#form').submit();
                }
            });
            $('#timer').backward_timer('start');
        });
    </script>
@endpush
