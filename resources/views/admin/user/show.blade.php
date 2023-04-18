@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="card-head container-fluid">
            <div class="row">
                <div class="col-6 pl-0">
                    <h4 class="page-title"><i class="fe-users"></i>Użytkownicy</h4>
                </div>
                <div class="col-6 d-flex justify-content-end align-items-center form-group-submit">
                    <a href="{{route('admin.user.edit', $user)}}" class="btn btn-primary">Edytuj użytkownika</a>
                </div>
            </div>
        </div>

        <div class="card-header border-bottom card-nav">
            <nav class="nav">
                <a class="nav-link {{ Request::routeIs('admin.user.index') ? 'active' : '' }}" href="{{route('admin.user.index')}}"><span class="fe-list"></span> Lista użytkowników</a>
                <a class="nav-link" href="{{route('admin.role.index')}}"><span class="fe-shield"></span> Grupy użytkowników</a>
            </nav>
        </div>

        <div class="card mt-3">
            <div class="card-body card-body-rem">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 col-xl-6 pb-5">
                            <table class="table m-0">
                                <tr>
                                    <td colspan="2" class="colspan">
                                        <div class="section">
                                            <div class="row">
                                                <div class="col-12">
                                                    Dane kontaktowe
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr><th>Imię i Nazwisko</th><td>{{ $user->name }} {{ $user->surname }}</td></tr>
                                <tr><th>E-mail</th><td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td></tr>
                                <tr><th>Telefon</th><td><a href="tel:{{ $user->phone }}">{{ $user->phone }}</a></td></tr>
                                <tr>
                                    <td colspan="2" class="colspan">
                                        <div class="section">
                                            <div class="row">
                                                <div class="col-12">
                                                    Dane osobiste
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr><th>PESEL</th><td>{{ $user->pesel }}</td></tr>
                                <tr><th>PWZ</th><td>{{ $user->practice }}</td></tr>
                                <tr><th>Specjalizacja</th><td>{{ $user->specialization }}</td></tr>
                                <tr><th>Stopień / tytył naukowy</th><td>{{ $user->degree }}</td></tr>
                                <tr>
                                    <td colspan="2" class="colspan">
                                        <div class="section">
                                            <div class="row">
                                                <div class="col-12">
                                                    Dane zamieszkania
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr><th>Miasto</th><td>{{ $user->city }}</td></tr>
                                <tr><th>Kod pocztowy</th><td>{{ $user->postcode }}</td></tr>
                                <tr><th>Adres</th><td>{{ $user->address }}</td></tr>
                                <tr>
                                    <td colspan="2" class="colspan">
                                        <div class="section">
                                            <div class="row">
                                                <div class="col-12">
                                                    Lista kursów
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr><th>Kurs i data</th><td>Do zrobienia</td></tr>
                                <tr><th>Kurs i data</th><td>Do zrobienia</td></tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group form-group-submit">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <a href="{{route('admin.user.edit', $user)}}" class="btn btn-primary">Edytuj użytkownika</a>
                </div>
            </div>
        </div>
    </div>
@endsection
