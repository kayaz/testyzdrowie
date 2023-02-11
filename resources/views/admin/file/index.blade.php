@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-head container-fluid">
                <div class="row">
                    <div class="col-6 pl-0">
                        <h4 class="page-title"><i class="fe-grid"></i>Pliki</h4>
                    </div>
                    <div class="col-6 d-flex justify-content-end align-items-center form-group-submit">
                        <a href="{{route('admin.file.create')}}" class="btn btn-primary me-1">Dodaj plik</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="table-overflow">
                <table id="sortable" class="table mb-0">
                    <thead class="thead-default">
                    <tr>
                        <th style="width: 25px"></th>
                        <th>Nazwa</th>
                        <th>Opis</th>
                        <th class="text-center">Rozmiar</th>
                        <th class="text-center">Pobrania</th>
                        <th>Data dodania</th>
                        <th>Data modyfikacji</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="content">
                    @foreach ($list as $item)
                        <tr id="recordsArray_{{ $item->id }}">
                            <td>
                                @if($item->mime)
                                    <i class="mime-icon {{ mime2icon($item->mime) }}"></i>
                                @endif
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td class="text-center">
                                {{ parseFilesize($item->size) }}
                            </td>
                            <td class="text-center">
                                @if($item->type == 1)
                                    {{ $item->download }}
                                @endif
                            </td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->updated_at }}</td>
                            <td class="option-120">
                                <div class="btn-group">
                                    <a href="{{route('admin.file.edit', $item->id)}}" class="btn action-button me-1" data-toggle="tooltip" data-placement="top" title="Edytuj wpis"><i class="fe-edit"></i></a>

                                    <form method="POST" action="{{route('admin.file.destroy', $item->id)}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button
                                                type="submit"
                                                class="btn action-button confirm"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Usuń wpis"
                                                data-id="{{ $item->id }}"
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
    <div class="form-group form-group-submit">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <a href="{{route('admin.file.create')}}" class="btn btn-primary me-1">Dodaj plik</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        @if (session('success')) toastr.options={closeButton:!0,progressBar:!0,positionClass:"toast-bottom-left",timeOut:"3000"};toastr.success("{{ session('success') }}"); @endif
    </script>
@endpush
