@extends('layouts.page')

@section('meta_title', 'Rozwiąż test')
@section('seo_title', '')
@section('seo_description', '')

@section('pageheader')
    @include('layouts.partials.page-header', ['title' => 'Rozwiąż test', 'header_file' => 'contact.jpg'])
@stop

@section('content')
    <div id="exam" class="page-text">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if($exam)
                        <h2 class="section-heading">
                            <span class="section-text">{{ $exam->name }} </span>
                            <span class="section-dot"></span>
                            <span class="section-line"></span>
                        </h2>
                        {!! $exam->text !!}

                        <div class="alert alert-danger mt-5 text-center" role="alert">PRZECZYTAJ UWAŻNIE</div>

                        <p>Po wciśnięciu przycisku "Zaliczenie testowe" przejdziesz do strony z testem. Jednocześniej zostanie uruchomiony zegar odliczający czas do końca egzaminu. <b>Odświeżenie strony będzie traktowane jako kolejne podejście do testu!</b></p>
                        @if($attempt->count() >= $exam->attempts)
                            <p class="mt-5 text-center"><b class="text-danger">Wykorzystałeś już limit podejść do egzaminu.</b></p>
                        @else
                        <div class="text-center mt-5">
                            <a href="{{ route('exam.show', [$exam, $date]) }}" class="btn btn-theme btn-big">Zaliczenie testowe</a>
                        </div>
                        @endif
                    @else
                        Brak opisu egzaminu
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
