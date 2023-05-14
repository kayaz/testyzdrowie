@extends('admin.layout')
@section('meta_title', '- '.$cardTitle)

@section('content')
    @if(Route::is('admin.exam.edit'))
        <form method="POST" action="{{route('admin.exam.update', $entry)}}" enctype="multipart/form-data">
            @method('PUT')
            @else
                <form method="POST" action="{{route('admin.exam.store')}}" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="container">
                        <div class="card-head container">
                            <div class="row">
                                <div class="col-12 pl-0">
                                    <h4 class="page-title"><i class="fe-home"></i><a href="{{route('admin.exam.index')}}" class="p-0">Kursy</a><span class="d-inline-flex me-2 ms-2">/</span>{{ $cardTitle }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            @include('form-elements.back-route-button')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        @include('form-elements.html-select', ['label' => 'Status', 'name' => 'active', 'selected' => $entry->active, 'select' => ['1' => 'Aktywny', '0' => 'Nieaktywny']])
                                        @include('form-elements.html-input-text', ['label' => 'Nazwa', 'name' => 'name', 'value' => $entry->name, 'required' => 1])
                                        @include('form-elements.html-input-text', ['label' => 'Limit czasu', 'sublabel' => 'Tylko cyfry', 'name' => 'time_limit', 'value' => $entry->time_limit, 'required' => 1])
                                        @include('form-elements.html-select', ['label' => 'Ilość prób', 'name' => 'attempts', 'selected' => $entry->attempts, 'select' => ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6']])
                                        @include('form-elements.html-input-text', ['label' => 'Ilość losowych pytań', 'sublabel' => 'Tylko cyfry', 'name' => 'question', 'value' => $entry->question, 'required' => 1])
                                        @include('form-elements.html-input-text', ['label' => 'Ilość punktów na zaliczenie', 'sublabel' => 'Tylko cyfry', 'name' => 'pass', 'value' => $entry->pass, 'required' => 1])
                                        <!--
                                        @include('form-elements.html-input-text', ['label' => 'Terminy rozpoczęcia', 'name' => 'date_start', 'value' => $entry->date_start, 'required' => 1])
                                        @include('form-elements.html-input-date', ['label' => 'Terminy zakończenia', 'name' => 'date_end', 'value' => $entry->date_end, 'required' => 1])
                                        -->

                                        @include('form-elements.textarea-fullwidth', [
                                            'label' => 'Informacja dla kursantów',
                                            'name' => 'text',
                                            'value' => $entry->text,
                                            'rows' => 21,
                                            'class' => 'tinymce',
                                            'required' => 1
                                        ])
                                        @include('form-elements.textarea-fullwidth', [
                                            'label' => 'Regulamin',
                                            'name' => 'statute',
                                            'value' => $entry->statute,
                                            'rows' => 21,
                                            'class' => 'tinymce',
                                            'required' => 1
                                        ])
                                        @include('form-elements.textarea-fullwidth', [
                                            'label' => 'Wideo',
                                            'name' => 'video',
                                            'value' => $entry->video,
                                            'rows' => 21,
                                            'class' => 'tinymce',
                                            'required' => 1
                                        ])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
                </form>
        @include('form-elements.tintmce')
            @push('scripts')
                <script src="{{ asset('/js/datepicker/bootstrap-datepicker.min.js') }}" charset="utf-8"></script>
                <script src="{{ asset('/js/datepicker/bootstrap-datepicker.pl.min.js') }}" charset="utf-8"></script>
                <link href="{{ asset('/js/datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
                <script>
                    $("#date_end, #date_start").datepicker({
                        format: 'yyyy-mm-dd',
                        language: 'pl',
                        autoclose: true,
                        templates: {
                            leftArrow: '<i class="las la-angle-left"></i>',
                            rightArrow: '<i class="las la-angle-right"></i></i>'
                        }
                    });
                </script>
            @endpush
        @endsection
