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
                            @if(checkExam($examDateUser->examDate->start, $examDateUser->examDate->end))
                            <a href="{{ route('exam.info', [$examDateUser->exam, $examDateUser->examDate->id]) }}">
                            @endif
                                <div class="fw-bold">{{ $examDateUser->exam->name }}</div>
                                <p><i class="las la-calendar-day"></i>  {{$examDateUser->examDate->start }} <i class="las la-long-arrow-alt-right me-2 ms-2"></i> {{$examDateUser->examDate->end }}</p>
                                @if(checkExam($examDateUser->examDate->start, $examDateUser->examDate->end))
                                    <span class="btn btn-theme btn-theme-red btn-sm mt-3 w-100">SZCZEGÓŁY</span>

                                    <a href="{{ route('exam.index', [$examDateUser->exam, $examDateUser->examDate]) }}" class="btn btn-theme btn-theme-red btn-sm mt-3 w-100">ROZPOCZNIJ TEST</a>
                                @endif
                            @if(checkExam($examDateUser->examDate->start, $examDateUser->examDate->end))
                            </a>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-9">
                    <div class="ps-5">
                        <p>Szanowni Państwo, nasz kurs nie wymaga przyjazdu do Rzeszowa na rozpoczęcie kursu. Po wypełnieniu formularza rejestrowego i automatycznym otrzymaniu linku (UWAGA: może niekiedy pójść do spamu), którego aktywowanie następuje poprzez ponowne wejście na swoje konto, następuje "zapisanie się na kurs" (nie przesyłamy dodatkowych potwierdzeń). Z materiałów szkoleniowych ("materiały dydaktyczne"), będą Państwo mogli korzystać dopiero po uzyskaniu statusu "aktywny", o czym decyduje administrator kursu, po zweryfikowaniu przesłanych przez Państwo danych. Być może będzie to wymagało wylogowania się i ponownego zalogowania na kurs. O ewentualnym nieaktywowaniu zgłoszenia administrator informuje drogą mailową, podając powód. Dostęp do materiałów szkoleniowych będzie aktywny w dniu rozpoczęcia kursu. Dostępna będzie od razu całość wymaganego materiału a korzystać z niego będzie można w dowolnym czasie i miejscu. Materiały video (dwa pliki), dotyczą tylko kursu Zdrowie publiczne! Aby móc rozwiązywać test zaliczeniowy należy poczekać na aktywację dostępu do testu. Wynik testu podświetlony "na zielono" (co najmniej 60% dobrych odp.), świadczy o zaliczeniu testu. Wynik podświetlony "na czerwono" (poniżej 60% dobrych odp.), świadczy o braku zaliczenia. Po zakończeniu kursu Państwa konto zostanie automatycznie anulowane. Bardzo proszę o zapoznanie się z Regulaminem kursu. W razie pytań należy wejść w zakładkę "KONTAKT" i wpisać treść pytania - odpowiedź przyjdzie zwrotnie e-mailem.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
