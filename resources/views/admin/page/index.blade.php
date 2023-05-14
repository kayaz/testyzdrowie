@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-6 pl-0">
                        <h4 class="page-title row"><i class="fe-file-text"></i>Menu</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body card-body-rem p-0">
                <div class="table-overflow">
                    @if (session('success'))
                        <div class="alert alert-success border-0 mb-0">
                            {{ session('success') }}
                            <script>setTimeout(function(){$(".alert").slideUp(500,function(){$(this).remove()})},3000)</script>
                        </div>
                    @endif
                    <table class="table mb-0">
                        <thead class="thead-default">
                        <tr>
                            <th>Nazwa</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Typ</th>
                            <th>Ścieżka</th>
                            <th class="text-center">Data utworzenia</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="content">
                        @foreach($list as $page)
                            <tr>
                                <td>{{$page->title}}</td>
                                <td class="text-center">{!! status($page->active) !!}</td>
                                <td class="text-center">{!! page_type($page->type) !!}</td>
                                @if($page->type == 1)
                                    <td>{{$page->title}}</td>
                                @else
                                    <td>{{$page->url}}@if($page->url_target) ({{$page->url_target}})@endif</td>
                                @endif
                                <td class="text-center">{{$page->created_at->format('Y-m-d H:i')}}</td>
                                <td class="option-120">
                                    <div class="btn-group">
                                        <a href="{{route('admin.page.edit', $page->id)}}" class="btn action-button me-1" data-toggle="tooltip" data-placement="top" title="Edytuj"><i class="fe-edit"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @if($page->children->count() > 0)
                                @include('admin.page.children', array('pages' => $page->children))
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
