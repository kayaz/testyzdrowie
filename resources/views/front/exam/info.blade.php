@extends('layouts.page')

@section('meta_title', 'Moje kursy')
@section('seo_title', '')
@section('seo_description', '')

@section('pageheader')
    @include('layouts.partials.page-header', ['title' => 'Moje kursy', 'header_file' => 'pageheader.jpg'])
@stop

@section('content')
    <div class="page-text">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <ul class="list-group student-menu">
                        @foreach ($examDateUsers as $examDateUser)
                            <li class="list-group-item">
                                <a href="{{ route('exam.info', [$examDateUser->exam, $examDateUser->examDate->id]) }}">
                                    <div class="fw-bold">{{ $examDateUser->exam->name }}</div>
                                    <p><i class="las la-calendar-day"></i>  {{$examDateUser->examDate->start }} <i class="las la-long-arrow-alt-right me-2 ms-2"></i> {{$examDateUser->examDate->end }}</p>
                                    <span class="btn btn-theme btn-theme-red btn-sm mt-3 w-100">SZCZEGÓŁY</span>
                                    @if(checkExam($examDateUser->examDate->exam, $examDateUser->examDate->end))
                                        <a href="{{ route('exam.index', [$examDateUser->exam, $examDateUser->examDate]) }}" class="btn btn-theme btn-theme-red btn-sm mt-3 w-100">ZALICZENIE TESTOWE</a>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-9">
                    <div class="ps-5">
                        <h2 class="text-center">{{ $exam->name }}</h2>
                        <h4 class="text-center mt-3"><i class="las la-calendar-day"></i>  {{$date->start }} <i class="las la-long-arrow-alt-right me-2 ms-2"></i> {{$date->end }}</h4>
                        <h4 class="text-center mt-3"><i class="las la-graduation-cap"></i> {{$date->exam }} <i class="las la-long-arrow-alt-right me-2 ms-2"></i> {{$date->end }}</h4>

                        @if(checkExam($date->exam, $date->end))
                        <div class="row mt-5 mb-4">
                            <div class="col-12 text-center">
                                <a href="{{ route('exam.index', [$exam, $date]) }}" class="btn btn-theme btn-theme-red btn-big">ZALICZENIE TESTOWE</a>
                            </div>
                        </div>
                        @endif

                        <ul class="nav nav-tabs mt-5" id="examTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc-tab-pane" type="button" role="tab" aria-controls="desc-tab-pane" aria-selected="true">Regulamin kursu</button>
                            </li>
                            @if(checkExam($date->start, $date->end))
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="files-tab" data-bs-toggle="tab" data-bs-target="#files-tab-pane" type="button" role="tab" aria-controls="files-tab-pane" aria-selected="false">Pliki do pobrania</button>
                            </li>
                            @endif
                            @if($exam->video && checkExam($date->start, $date->end))
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="video-tab" data-bs-toggle="tab" data-bs-target="#video-tab-pane" type="button" role="tab" aria-controls="video-tab-pane" aria-selected="false">Wideo</button>
                            </li>
                            @endif
                        </ul>
                        <div class="tab-content" id="examTabContent">
                            <div class="tab-pane fade show active" id="desc-tab-pane" role="tabpanel" aria-labelledby="desc-tab" tabindex="0">
                                {!! $exam->statute !!}
                            </div>
                            @if(checkExam($date->start, $date->end))
                            <div class="tab-pane fade" id="files-tab-pane" role="tabpanel" aria-labelledby="files-tab" tabindex="0">
                                @if($files->count() > 0)
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nazwa</th>
                                        <th>Opis</th>
                                        <th class="text-center">Rozmiar</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($files as $f)
                                        <tr>
                                            <td>
                                                @if($f->mime)
                                                    <i class="mime-icon {{ mime2icon($f->mime) }}"></i>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $f->name }}
                                            </td>
                                            <td>
                                                {{ $f->description }}
                                            </td>
                                            <td class="text-center">
                                                {{ parseFilesize($f->size) }}
                                            </td>
                                            <td>
                                                @if($f->extension == 'pdf')
                                                <button class="btn btn-sm btn-theme btn-pdf-modal" data-bs-toggle="modal" data-bs-target="#pdfModal" data-url="{{ asset('uploads/storage/'.$f->file) }}">Czytaj</button>
                                                @else
                                                    <a href="{{ asset('uploads/storage/'.$f->file) }}" class="btn btn-sm btn-theme" target="_blank">Pobierz</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>
                            @endif
                            @if($exam->video && checkExam($date->start, $date->end))
                            <div class="tab-pane fade" id="video-tab-pane" role="tabpanel" aria-labelledby="video-tab" tabindex="0">
                                {!! $exam->video !!}
                            </div>
                            @endif
                        </div>
                        <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="pdfModalLabel">Podgląd pliku</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <object id="pdfObject" data="" type="application/pdf" width="100%" height="600px">
                                            <iframe id="pdfIframe" src="" style="width:100%;height:100%;border:0"></iframe>
                                            <p>Przepraszamy, Twoja przeglądarka nie obsługuje plików PDF. <a href="{{ asset('uploads/storage/'.$f->file) }}">Pobierz plik</a>.</p>
                                        </object>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        const pdfModal = document.getElementById('pdfModal');
        const pdfObject = pdfModal.querySelector('#pdfObject');
        const pdfIframe = pdfModal.querySelector('#pdfIframe');

        pdfModal.addEventListener('shown.bs.modal', function (e) {
            const url = $(e.relatedTarget).data('url');
            pdfObject.setAttribute('data', url);
            pdfIframe.setAttribute('src', url);
        })

        pdfModal.addEventListener('hidden.bs.modal', function(e) {
            pdfIframe.removeAttribute('src');
            pdfObject.removeAttribute('data');
        });
    </script>
@endpush
