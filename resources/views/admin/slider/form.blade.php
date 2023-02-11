@extends('admin.layout')
@section('meta_title', '- '.$cardTitle)

@section('content')
@if(Route::is('admin.slider.edit'))
    <form method="POST" action="{{route('admin.slider.update', $entry->id)}}" enctype="multipart/form-data">
    @method('PUT')
@else
    <form method="POST" action="{{route('admin.slider.store')}}" enctype="multipart/form-data">
@endif
        @csrf
        <div class="container">
            <div class="card">
                <div class="card-head container">
                    <div class="row">
                        <div class="col-12 pl-0">
                            <h4 class="page-title row"><i class="fe-airplay"></i><a href="{{route('admin.slider.index')}}" class="p-0">Slider</a><span class="d-inline-flex ml-2 mr-2">/</span>{{ $cardTitle }}</h4>
                        </div>
                    </div>
                </div>
                @include('form-elements.back-route-button')
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @include('form-elements.html-select', ['label' => 'Status', 'name' => 'active', 'selected' => $entry->active, 'select' => ['1' => 'Aktywny', '2' => 'Nieaktywny']])
                            @include('form-elements.html-select', ['label' => 'Wyciemnienie zdjęcia', 'name' => 'opacity', 'selected' => $entry->opacity, 'select' => [
                                '0' => '0',
                                '0.2' => '0.2',
                                '0.4' => '0.4',
                                '0.6' => '0.6',
                                '0.8' => '0.8',
                                '1.0' => '1',
                            ]])
                            @include('form-elements.html-input-text', ['label' => 'Nazwa', 'name' => 'title', 'value' => $entry->title, 'required' => 1])
                            @include('form-elements.html-input-file', ['label' => 'Zdjęcie', 'sublabel' => '(wymiary: '.config('images.slider_big.width').'px / '.config('images.slider_big.height').'px)', 'name' => 'file'])
                            @include('form-elements.html-input-text', ['label' => 'Atrybut ALT zdjęcia', 'name' => 'file_alt', 'value' => $entry->file_alt])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
    </form>
@endsection
