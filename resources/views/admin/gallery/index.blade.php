@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-6 pl-0">
                        <h4 class="page-title"><i class="fe-image"></i>Galeria</h4>
                    </div>
                    <div class="col-6 d-flex justify-content-end align-items-center form-group-submit">
                        <a href="{{route('admin.gallery.create')}}" class="btn btn-primary">Dodaj galerię</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body card-body-rem p-0">
                <div class="table-overflow">
                    <table id="sortable" class="table mb-0">
                        <thead class="thead-default">
                        <tr>
                            <th>Nazwa</th>
                            <th>Opis</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Ilość zdjęć</th>
                            <th>Data modyfikacji</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="content">
                        @foreach ($list as $p)
                            <tr id="recordsArray_{{ $p->id }}">
                                <td><a href="{{ route('admin.gallery.show', $p) }}">{{ $p->name }}</a></td>
                                <td>@if($p->text){{ $p->text }}@endif</td>
                                <td class="text-center">{!! status($p->status) !!}</td>
                                <td class="text-center">{{ $p->photos->count() }}</td>
                                <td>{{ $p->updated_at }}</td>
                                <td class="option-120">
                                    <div class="btn-group">
                                        <a href="{{route('admin.gallery.edit', [$p->id, 'lang' => 'en'])}}" class="btn action-button lang-button me-1" data-toggle="tooltip" data-placement="top" title="Edytuj"><img src="{{ asset('/cms/flags/en.png') }}" alt="Tłumaczenie: en"></a>
                                    </div>
                                </td>
                                <td class="option-120">
                                    <div class="btn-group">
                                        <span class="btn action-button move-button me-1"><i class="fe-move"></i></span>
                                        <a href="{{route('admin.gallery.edit', $p->id)}}" class="btn action-button me-1" data-bs-toggle="tooltip" data-placement="top" data-bs-title="Edytuj wpis"><i class="fe-edit"></i></a>
                                        <form method="POST" action="" class="d-none">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button
                                                type="submit"
                                                class="btn action-button confirm"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                data-bs-title="Usuń wpis"
                                                data-id="{{ $p->id }}"
                                            ><i class="fe-trash-2"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group form-group-submit">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <a href="{{route('admin.gallery.create')}}" class="btn btn-primary">Dodaj galerię</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $("#sortable tbody.content").sortuj('{{route('admin.gallery.sort')}}');
        });
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        @if (session('success')) toastr.options={closeButton:!0,progressBar:!0,positionClass:"toast-bottom-right",timeOut:"3000"};toastr.success("{{ session('success') }}"); @endif
    </script>
@endpush
