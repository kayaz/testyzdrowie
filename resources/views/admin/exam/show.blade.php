@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card-head container-fluid">
            <div class="row">
                <div class="col-6 pl-0">
                    <h4 class="page-title"><i class="fe-book-open"></i><a href="{{ route('admin.exam.index') }}">Egzaminy</a><span class="d-inline-flex me-2 ms-2">/</span>{{$exam->name}}</h4>
                </div>
                <div class="col-6 d-flex justify-content-end align-items-center form-group-submit">
                    <a href="{{route('admin.question.create', $exam)}}" class="btn btn-primary">Dodaj pytanie</a>
                </div>
            </div>
        </div>

        <div class="card-header border-bottom card-nav">
            <nav class="nav">
                <a class="nav-link {{ Request::routeIs('admin.exam.index') ? 'active' : '' }}" href="{{ route('admin.exam.index') }}"><span class="fe-book-open"></span> Lista egzaminów</a>
                <a class="nav-link {{ Request::routeIs('admin.exam.show') ? 'active' : '' }}" href="{{ route('admin.exam.show', $exam) }}"><span class="fe-list"></span> Lista pytań</a>
            </nav>
        </div>

        <div class="card mt-3">
            <div class="card-body card-body-rem p-0">
                <div class="table-overflow">
                    <table class="table mb-0">
                        <thead class="thead-default">
                        <tr>
                            <th>Pytanie</th>
                            <th>Odpowiedz A</th>
                            <th>Odpowiedz B</th>
                            <th>Odpowiedz C</th>
                            <th>Odpowiedz D</th>
                            <th class="text-center">Prawidłowa</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="content">
                        @foreach ($list as $item)
                            <tr id="recordsArray_{{ $item->id }}" class="list-category-{{$item->category_id}}">
                                <td>{{ $item->question }}</td>
                                <td>{{ $item->answer_a }}</td>
                                <td>{{ $item->answer_b }}</td>
                                <td>{{ $item->answer_c }}</td>
                                <td>{{ $item->answer_d }}</td>
                                <td class="text-center">{{ $item->correct }}</td>
                                <td class="option-120">
                                    <div class="btn-group">
                                        <a href="{{route('admin.question.edit', [$exam, $item->id])}}" class="btn action-button me-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edytuj egzamin"><i class="fe-edit"></i></a>
                                        <form method="POST" action="{{route('admin.question.destroy', [$exam, $item->id])}}">
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
                    <a href="{{route('admin.question.create', $exam)}}" class="btn btn-primary">Dodaj pytanie</a>
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
