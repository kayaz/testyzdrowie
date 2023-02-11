@extends('admin.layout')
@section('meta_title', '- '.$cardTitle)

@section('content')
    @if(Route::is('admin.gallery.edit'))
        <form method="POST" action="{{route('admin.gallery.update', $entry)}}" enctype="multipart/form-data">
        @method('PUT')
    @else
        <form method="POST" action="{{route('admin.gallery.store')}}" enctype="multipart/form-data">
            @endif
            @csrf
            <div class="container">
                <div class="card-head container">
                    <div class="row">
                        <div class="col-12 pl-0">
                            <h4 class="page-title row"><i class="fe-home"></i><a href="{{route('admin.gallery.index')}}" class="p-0">Galeria</a><span class="d-inline-flex ml-2 mr-2">/</span>{{ $cardTitle }}</h4>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    @include('form-elements.back-route-button')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @if(!Request::get('lang'))
                                    @include('form-elements.html-select', ['label' => 'Status', 'name' => 'status', 'selected' => $entry->status, 'select' => ['1' => 'Pokaż na liście', '0' => 'Ukryj na liście']])
                                @endif
                                @include('form-elements.html-input-text', ['label' => 'Nazwa', 'name' => 'name', 'value' => $entry->name, 'required' => 1])
                                @if(!Request::get('lang'))
                                    @include('form-elements.html-input-file', ['label' => 'Zdjęcie', 'sublabel' => '(wymiary: '.config('images.gallery.big_width').'px / '.config('images.gallery.big_height').'px)', 'name' => 'file'])
                                    @include('form-elements.textarea', ['label' => 'Opis', 'name' => 'text', 'value' => $entry->text])
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="lang" value="{{$current_locale}}">
            @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
        </form>
@endsection
