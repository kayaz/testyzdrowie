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

        <div class="card-header border-bottom card-nav">
            <nav class="nav">
                <a class="nav-link {{ Request::routeIs('admin.exam.index') ? 'active' : '' }}" href="{{route('admin.exam.index')}}"><span class="fe-list"></span> Lista egzaminów</a>
            </nav>
        </div>

        <div class="card mt-3">
            <div class="card-body card-body-rem p-0">
                <div class="table-overflow">

                    <div class="modal fade" id="bootstrapmodal" tabindex="-1" role="dialog" aria-labelledby="uploadlabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <form action="" method="post" id="modalForm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="uploadlabel">Dodaj termin</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fe-x"></i></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-danger" style="display:none"></div>
                                        <div class="modal-form container">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <label for="inputDateStart" class="col-5 col-form-label control-label required text-end">Data rozpoczęcia</label>
                                                        <div class="col-7">
                                                            <input type="text" value=""
                                                                   class="validate[required] form-control @error('start') is-invalid @enderror"
                                                                   id="inputDateStart" name="start">
                                                            @if($errors->first('start'))
                                                                <div class="invalid-feedback d-block">{{ $errors->first('start') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputDateEnd" class="col-5 col-form-label control-label required text-end">Data zakończenia</label>
                                                        <div class="col-7">
                                                            <input type="text" value=""
                                                                   class="validate[required] form-control @error('end') is-invalid @enderror"
                                                                   id="inputDateEnd" name="end">
                                                            @if($errors->first('end'))
                                                                <div class="invalid-feedback d-block">{{ $errors->first('end') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="exam_id" value="" id="inputExamId">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                                        <button type="submit" class="btn btn-primary">Zapisz</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <table class="table mb-0">
                        <thead class="thead-default">
                        <tr>
                            <th>Nazwa egzaminu</th>
                            <th class="text-center">Ilość pytań</th>
                            <th class="text-center">Próby</th>
                            <th class="text-center">Zaliczenie</th>
                            <th class="text-center">Status</th>
                            <th class="text-center w-250">Terminy</th>
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
                                <td class="text-center">{!! status($item->active) !!}</td>
                                <td class="text-center table-dates">
                                    @if($item->dates->count() > 0)
                                        <ul class="list-unstyled mb-0 w-250">
                                            @foreach($item->dates as $date)
                                            <li>
                                                <a href="{{route('admin.examdate.show', $date)}}">{{ $date->start }} <i class="las la-long-arrow-alt-right"></i> {{ $date->end }}</a>
                                                @if($date->users()->count() == 0)
                                                <form method="POST" action="{{route('admin.examdate.destroy', $date)}}" class="float-end">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn action-button action-button-sm confirm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Usuń termin" data-id="{{ $date->id }}"><i class="las la-calendar-times"></i></button>
                                                </form>
                                                @endif
                                            </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>
                                <td class="option-120">
                                    <div class="btn-group">
                                        <button type="button" class="btn action-button me-1" data-bs-toggle="modal" data-bs-tooltip="tooltip" data-bs-placement="top" data-exam="{{$item->id}}" data-bs-trigger="hover" data-bs-title="Dodaj termin" data-bs-target="#bootstrapmodal" ><i class="fe-calendar"></i></button>
                                        <a href="{{route('admin.exam.show', $item->id)}}" class="btn action-button me-1" data-bs-tooltip="tooltip" data-bs-placement="top" data-bs-title="Pokaż pytania"><i class="fe-folder"></i></a>
                                        <a href="{{route('admin.exam.edit', $item->id)}}" class="btn action-button me-1" data-bs-tooltip="tooltip" data-bs-placement="top" data-bs-title="Edytuj egzamin"><i class="fe-edit"></i></a>
                                        <form method="POST" action="{{route('admin.exam.destroy', $item->id)}}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn action-button confirm" data-bs-tooltip="tooltip" data-bs-placement="top" data-bs-title="Usuń egzamin" data-id="{{ $item->id }}"><i class="fe-trash-2"></i></button>
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
        <script src="{{ asset('/js/datepicker/bootstrap-datepicker.min.js') }}" charset="utf-8"></script>
        <script src="{{ asset('/js/datepicker/bootstrap-datepicker.pl.min.js') }}" charset="utf-8"></script>
        <link href="{{ asset('/js/datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
        <script>
            const modal = document.getElementById('bootstrapmodal'),
                eventModal = new bootstrap.Modal(modal),
                form = document.getElementById('modalForm'),
                start = $('#inputDateStart'),
                exam_id = $('#inputExamId'),
                end = $('#inputDateEnd');
            modal.addEventListener('shown.bs.modal', function (e) {
                form.reset();
                const exam = $(e.relatedTarget).data('exam');
                $(e.currentTarget).find('input[name="exam_id"]').val(exam);

                start.datepicker({
                    format: 'yyyy-mm-dd',
                    language: 'pl',
                    autoclose: true
                });
                end.datepicker({
                    format: 'yyyy-mm-dd',
                    language: 'pl',
                    autoclose: true
                });
            })
            modal.addEventListener('hidden.bs.modal', function () {
                exam_id.val('');
                form.reset();
            })

            const alert = $('.alert-danger');
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.examdate.store') }}",
                    method: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'start': start.val(),
                        'end': end.val(),
                        'exam_id': exam_id.val()
                    },
                    success: function () {
                        // eventModal.hide();
                        // toastr.options =
                        //     {
                        //         "closeButton": true,
                        //         "progressBar": true
                        //     }
                        // toastr.success("Wpis został poprawnie dodany");
                        window.location.reload();
                    },
                    error: function (result) {
                        if (result.responseJSON.data) {
                            alert.html('');
                            $.each(result.responseJSON.data, function (key, value) {
                                alert.show();
                                alert.append('<span>' + value + '</span>');
                            });
                        }
                    }
                });
            });


            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-tooltip="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
            @if (session('success')) toastr.options={closeButton:!0,progressBar:!0,positionClass:"toast-top-right",timeOut:"3000"};toastr.success("{{ session('success') }}"); @endif
        </script>
    @endpush
@endsection
