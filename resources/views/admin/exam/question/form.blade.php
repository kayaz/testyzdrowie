@extends('admin.layout')
@section('meta_title', '- '.$cardTitle)

@section('content')
    @if(Route::is('admin.question.edit'))
        <form method="POST" action="{{route('admin.question.update', [$exam, $entry])}}" enctype="multipart/form-data">
            @method('PUT')
            @else
                <form method="POST" action="{{route('admin.question.store', $exam)}}" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="container">
                        <div class="card-head container">
                            <div class="row">
                                <div class="col-12 pl-0">
                                    <h4 class="page-title row"><i class="fe-home"></i><a href="{{route('admin.exam.show', $exam)}}" class="p-0">Egzaminy</a><span class="d-inline-flex ml-2 mr-2">/</span>{{ $cardTitle }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            @include('form-elements.back-route-button')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        @include('form-elements.html-input-text', ['label' => 'Pytanie', 'name' => 'question', 'value' => $entry->question, 'class' => 'col-9', 'required' => 1])
                                        @include('form-elements.html-input-text', ['label' => 'Odpowiedź A', 'name' => 'answer_a', 'value' => $entry->answer_a, 'class' => 'col-9', 'required' => 1])
                                        @include('form-elements.html-input-text', ['label' => 'Odpowiedź B', 'name' => 'answer_b', 'value' => $entry->answer_b, 'class' => 'col-9', 'required' => 1])
                                        @include('form-elements.html-input-text', ['label' => 'Odpowiedź C', 'name' => 'answer_c', 'value' => $entry->answer_c, 'class' => 'col-9', 'required' => 1])
                                        @include('form-elements.html-input-text', ['label' => 'Odpowiedź D', 'name' => 'answer_d', 'value' => $entry->answer_d, 'class' => 'col-9', 'required' => 1])
                                        @include('form-elements.html-select', ['label' => 'Prawidłowa odpowiedź', 'name' => 'correct', 'selected' => $entry->correct, 'select' => ['1' => 'Odpowiedź A', '2' => 'Odpowiedź B', '3' => 'Odpowiedź C', '4' => 'Odpowiedź D']])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
                </form>
        @endsection
