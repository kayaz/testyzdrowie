@extends('admin.layout')
@section('content')
    @if(Route::is('admin.user.edit'))
        <form method="POST" action="{{route('admin.user.update', $entry->id)}}" enctype="multipart/form-data">
            @method('PUT')
            @else
                <form method="POST" action="{{route('admin.user.store')}}" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="container">
                        <div class="card-head container">
                            <div class="row">
                                <div class="col-12 pl-0">
                                    <h4 class="page-title"><i class="fe-home"></i><a href="{{route('admin.user.index')}}">Lista użytkowników</a><span class="d-inline-flex me-2 ms-2">/</span>{{ $cardTitle }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            @include('form-elements.back-route-button')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        @include('form-elements.html-select', ['label' => 'Status', 'name' => 'active', 'selected' => $entry->active, 'select' => ['1' => 'Aktywny', '2' => 'Nieaktywny']])
                                        @include('form-elements.html-input-text', ['label' => 'Imię', 'name' => 'name', 'value' => $entry->name, 'required' => 1])
                                        @include('form-elements.html-input-text', ['label' => 'Nazwisko', 'name' => 'surname', 'value' => $entry->surname, 'required' => 1])
                                        @include('form-elements.html-input-text', ['label' => 'E-mail', 'name' => 'email', 'value' => $entry->email, 'required' => 1])
                                        @include('form-elements.html-password', ['label' => 'Hasło', 'name' => 'password', 'value' => $entry->password, 'required' => 1])
                                        @include('form-elements.html-password', ['label' => 'Powtórz hasło', 'name' => 'confirm-password', 'required' => 1])

                                        @isset($selected)
                                        @include('form-elements.html-select-multiple', ['label' => 'Role', 'name' => 'roles', 'select' => $roles, 'selected' => $selected, 'required' => 1])
                                            @else
                                        @include('form-elements.html-select-multiple', ['label' => 'Role', 'name' => 'roles', 'select' => $roles, 'required' => 1])
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(Route::is('admin.user.edit'))
                        <input type="hidden" name="article_id" value="{{$entry->id}}">
                    @endif
                    @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
                </form>
        @include('form-elements.tintmce')
@endsection
