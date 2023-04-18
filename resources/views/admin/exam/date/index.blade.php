@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card-head container-fluid">
            <div class="row">
                <div class="col-6 pl-0">
                    <h4 class="page-title"><i class="fe-book-open"></i>{{ $exam->name }} - Termin: {{ $examdate->start }} <i class="las la-long-arrow-alt-right me-2 ms-2"></i> {{ $examdate->end }}</h4>
                </div>
                <div class="col-6 d-flex justify-content-end align-items-center form-group-submit">
                    <a href="{{route('admin.examdate.export', $examdate)}}" class="btn btn-primary">Export</a>
                </div>
            </div>
        </div>

        <div class="card-header border-bottom card-nav">
            <nav class="nav">
                <a class="nav-link {{ Request::routeIs('admin.exam.index') ? 'active' : '' }}" href="{{ route('admin.exam.index') }}"><span class="fe-book-open"></span> Lista egzaminów</a>
                <a class="nav-link {{ Request::routeIs('admin.examdate.show') ? 'active' : '' }}" href="{{route('admin.examdate.show', $examdate)}}"><span class="fe-list"></span> Zapisane osoby</a>
                <a class="nav-link {{ Request::routeIs('admin.examdate.index') ? 'active' : '' }}" href="{{route('admin.examdate.index', $examdate)}}"><span class="fe-server"></span> Wyniki</a>
            </nav>
        </div>

        <div class="card mt-3">
            <div class="card-body card-body-rem p-0">
                <div class="table-overflow">
                    <table class="table mb-0">
                        <thead class="thead-default">
                        <tr>
                            <th>Imię</th>
                            <th>Nazwisko</th>
                            <th class="text-center">Wynik</th>
                            <th class="text-center">Prawidłowe <br>odpowiedzi</th>
                            <th class="text-center">Złe <br>odpowiedzi</th>
                            <th class="text-center">Puste <br>odpowiedzi</th>
                            <th class="text-center">Data rozpoczęcia</th>
                            <th class="text-center">Data zakończenia</th>
                            <th class="text-center">Czas trwania</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="content">
                        @foreach($exameAttempts as $item)
                            <tr @if($item->score >= $exam->pass) class="row-pass" @else class="row-fail" @endif>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->user->surname }}</td>
                                <td class="text-center">{{ $item->score }}</td>
                                <td class="text-center">{{ $item->answers_correct }}</td>
                                <td class="text-center">{{ $item->answers_wrong }}</td>
                                <td class="text-center">{{ $item->answers_empty }}</td>
                                <td class="text-center">{{ $item->date_start }}</td>
                                <td class="text-center">{{ $item->date_end }}</td>
                                <td class="text-center">{{ convertSec2Min($item->time) }}</td>
                                <td class="option-120">
                                    <div class="btn-group">
                                        <form method="POST" action="">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn action-button confirm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Usuń zapis" data-id="{{ $item->id }}"><i class="fe-trash-2"></i></button>
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

    </div>
    @push('scripts')
        <script>
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-tooltip="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
            @if (session('success')) toastr.options={closeButton:!0,progressBar:!0,positionClass:"toast-top-right",timeOut:"3000"};toastr.success("{{ session('success') }}"); @endif
        </script>
    @endpush
@endsection
