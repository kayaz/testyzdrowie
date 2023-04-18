@extends('admin.layout')
@section('content')
    @if(Route::is('admin.role.edit'))
        <form method="POST" action="{{route('admin.role.update', $entry->id)}}" enctype="multipart/form-data">
            @method('PUT')
            @else
                <form method="POST" action="{{route('admin.role.store')}}" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="container">
                        <div class="card">
                            <div class="card-head container">
                                <div class="row">
                                    <div class="col-12 pl-0">
                                        <h4 class="page-title"><i class="fe-home"></i><a href="{{route('admin.role.index')}}">Role użytkowników</a><span class="d-inline-flex me-2 ms-2">/</span>{{ $cardTitle }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            @include('form-elements.back-route-button')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        @include('form-elements.input-text', ['label' => 'Nazwa', 'name' => 'name', 'value' => $entry->name, 'required' => 1])

                                        <div class="form-group row">
                                            <label for="form_permission" class="col-2 col-form-label control-label"><div class="text-right">Zezwolenie na:</div></label>
                                            <div class="col-10">
                                                <div class="role-list">
                                                    @foreach($permission as $value)
                                                        <div class="form-check form-check-inline">
                                                            <input
                                                                    class="form-check-input"
                                                                    name="permission[]"
                                                                    type="checkbox"
                                                                    id="permission_{{ $value->id }}"
                                                                    value="{{ $value->id }}"
                                                                    @if(in_array($value->id, $rolePermissions))
                                                                        checked
                                                                    @endif
                                                            >
                                                            <label class="form-check-label" for="permission_{{ $value->id }}">@lang('permission.'.$value->name)</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @if($errors->first('permission'))<div class="invalid-feedback d-block">{{ $errors->first('permission') }}</div>@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(Route::is('admin.article.edit'))
                        <input type="hidden" name="article_id" value="{{$entry->id}}">
                    @endif
                    @include('form-elements.submit', ['name' => 'submit', 'value' => 'Zapisz'])
                </form>
        @include('form-elements.tintmce')
@endsection
