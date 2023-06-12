@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card-head container-fluid">
            <div class="row">
                <div class="col-6 pl-0">
                    <h4 class="page-title"><i class="fe-book-open"></i>{{ $exam->name }} - Termin: {{ $examdate->start }} <i class="las la-long-arrow-alt-right me-2 ms-2"></i> {{ $examdate->end }}</h4>
                </div>
                <div class="col-6 d-flex justify-content-end align-items-center form-group-submit">

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
                            <th class="text-center">Specjalizacja</th>
                            <th class="text-center">PWZ</th>
                            <th class="text-center">Pesel</th>
                            <th class="text-center">E-mail</th>
                            <th class="text-center">Telefon</th>
                            <th class="text-center">Uczestnik</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="content">
                            @foreach($examdateusers as $item)
                                <tr>
                                    <td></td>
                                    <td>@if($item->users->first()->surname) {{ $item->users->first()->surname }} @endif</td>
                                    <td class="text-center">{{ $item->users->first()->specialization }}</td>
                                    <td class="text-center">{!! checkPwz($item->users->first()->practice) !!}</td>
                                    <td class="text-center">{!! checkPesel($item->users->first()->pesel) !!}</td>
                                    <td class="text-center">{{ $item->users->first()->email }}</td>
                                    <td class="text-center">{{ $item->users->first()->phone }}</td>
                                    <td class="text-center">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input toggle-switch" type="checkbox" role="switch" id="toggleSwitch{{ $item->id }}" data-id="{{ $item->id }}" @if($item->active) checked @endif>
                                        </div>
                                    </td>
                                    <td class="option-120">
                                        <div class="btn-group">
                                            <form method="POST" action="{{route('admin.examdate.destroyRegister', ['examdate' => $examdate, 'examdateuser' => $item])}}">
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

            document.addEventListener('DOMContentLoaded', function() {
                const toggleSwitches = document.querySelectorAll('.toggle-switch');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                toggleSwitches.forEach(function(switchElement) {
                    switchElement.addEventListener('change', function() {
                        const dataId = parseInt(switchElement.dataset.id, 10);
                        const isChecked = switchElement.checked ? 1 : 0;
                        const xhr = new XMLHttpRequest();

                        xhr.open('POST', '{{ route('admin.examdate.user') }}', true);
                        xhr.setRequestHeader('Content-Type', 'application/json');
                        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    // Handle the AJAX response
                                    console.log(xhr.responseText);
                                } else {
                                    // Handle AJAX error
                                    console.error('Request error:', xhr.status);
                                }
                            }
                        };
                        const data = JSON.stringify({dataId: dataId, isChecked: isChecked});
                        xhr.send(data);
                    });
                });
            });
        </script>
    @endpush
@endsection
