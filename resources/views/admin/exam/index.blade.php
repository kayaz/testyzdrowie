@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card-head container-fluid">
            <div class="row">
                <div class="col-6 pl-0">
                    <h4 class="page-title"><i class="fe-book-open"></i>Egzaminy</h4>
                </div>
                <div class="col-6 d-flex justify-content-end align-items-center form-group-submit">
                    <a href="{{route('admin.exam.create')}}" class="btn btn-primary">Dodaj egzamin</a>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body card-body-rem p-0">
                <div class="table-overflow">
                    <table class="table mb-0">
                        <thead class="thead-default">
                        <tr>
                            <th>Nazwa egzaminu</th>
                            <th class="text-center">Ilość pytań</th>
                            <th class="text-center">Próby</th>
                            <th class="text-center">Zaliczenie</th>
                            <th class="text-center">Data rozpoczęcia</th>
                            <th class="text-center">Data zakończenia</th>
                            <th class="text-center">Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="content">
                        @foreach ($list as $item)
                            <tr id="recordsArray_{{ $item->id }}" class="list-category-{{$item->category_id}}">
                                <td><a href="{{ route('admin.exam.show', $item) }}">{{ $item->name }}</a></td>
                                <td class="text-center">{{ $item->questions()->count() }}</td>
                                <td class="text-center">{{ $item->attempts }}</td>
                                <td class="text-center">{{ $item->pass }}</td>
                                <td class="text-center">{{ $item->date_start }}</td>
                                <td class="text-center">{{ $item->date_end }}</td>
                                <td class="text-center">{!! status($item->active) !!}</td>
                                <td class="option-120">
                                    <div class="btn-group">
                                        <a href="{{route('admin.exam.show', $item->id)}}" class="btn action-button me-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Pokaż pytania"><i class="fe-folder"></i></a>
                                        <a href="{{route('admin.exam.edit', $item->id)}}" class="btn action-button me-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edytuj egzamin"><i class="fe-edit"></i></a>
                                        <form method="POST" action="{{route('admin.exam.destroy', $item->id)}}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn action-button confirm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Usuń egzamin" data-id="{{ $item->id }}"><i class="fe-trash-2"></i></button>
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
                    <a href="{{route('admin.exam.create')}}" class="btn btn-primary">Dodaj egzamin</a>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
            @if (session('success')) toastr.options={closeButton:!0,progressBar:!0,positionClass:"toast-bottom-right",timeOut:"3000"};toastr.success("{{ session('success') }}"); @endif
        </script>
    @endpush
@endsection
