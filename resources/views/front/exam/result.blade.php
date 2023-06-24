@extends('layouts.page')

@section('meta_title', 'Wyniki egzaminu')
@section('seo_title', '')
@section('seo_description', '')

@section('pageheader')
    @include('layouts.partials.page-header', ['title' => 'Wyniki egzaminu', 'header_file' => 'contact.jpg'])
@stop

@section('content')
    <div class="page-text">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div id="foo" class="d-flex justify-content-center"></div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-5">
                    <ul class="list-group mb-5">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Poprawne odpowiedzi
                            <span class="float-end"><b>{{ $attempt->answers_correct }}</b></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Złe odpowiedzi
                            <span class="float-end">{{ $attempt->answers_wrong }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Puste odpowiedzi
                            <span class="float-end">{{ $attempt->answers_empty }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Czas
                            <span class="float-end">{{ convertSec2Min($attempt->time) }}</span>
                        </li>
                    </ul>
                    @if($attempt->score >= $exam->pass)
                        <h2 class="text-center text-success">Egzamin zaliczony</h2>
                    @else
                        <h2 class="text-center text-danger">Egzamin niezaliczony</h2>

                        @if($attempts < $exam->attempts)
                            <a href="{{ route('exam.index', [$exam, $date]) }}" class="btn btn-theme btn-theme-red btn-big mt-3 w-100">SPRÓBUJ JESZCZE RAZ</a>
                        @endif
                    @endif

                    @if($questionnaire == 0)
                        <hr class="mt-4 mb-3">
                        <p>Uprzejmie prosimy o wypełnienie naszej ankiety, która mogłaby wpłynąć na podniesienie poziomu jakości kursów, w którym Państwo uczestniczyli. <a href="{{ route('ankieta.index', [$exam, $date]) }}">Ankieta</a></p>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/exam.js') }}" charset="utf-8"></script>
    <script type="text/javascript">
        const knob = pureknob.createKnob(300, 300);
        knob.setProperty('angleStart', -0.75 * Math.PI);
        knob.setProperty('angleEnd', 0.75 * Math.PI);
        @if($attempt->score >= $exam->pass)
        knob.setProperty('colorFG', '#008500');
        @else
        knob.setProperty('colorFG', '#b90000');
        @endif
        knob.setProperty('colorBG', '#f0f0f0');
        knob.setProperty('trackWidth', 0.4);
        knob.setProperty('valMin', 0);
        knob.setProperty('valMax', 100);
        knob.setProperty('readonly', true);

        knob.setValue({{ $attempt->score }});
        const node = knob.node();
        const elem = document.getElementById('foo');
        elem.appendChild(node);
    </script>
@endpush
