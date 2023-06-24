@extends('layouts.page')

@section('meta_title', 'Ankieta ewaluacyjna')
@section('seo_title', '')
@section('seo_description', '')

@section('pageheader')
    @include('layouts.partials.page-header', ['title' => 'Ankieta ewaluacyjna', 'header_file' => 'contact.jpg'])
@stop

@section('content')
    <div class="page-text">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p>Organizator kursu – <b>Pracownia Organizacji i Zarządzania, Katedra Zdrowia Publicznego Wydziału Medycznego UR</b>, pragnie poznać Państwa opinie o kursie, w którym Państwo uczestniczyli. Opinie te będą pomocne w dalszym doskonaleniu jakości kształcenia lekarzy na naszej uczelni, dlatego prosimy o wypełnienie poniższego krótkiego kwestionariusza</p>
                </div>
            </div>

            <div class="row justify-content-center mt-5">
                @if($questionnaire == 0)
                <div class="col-12 col-md-9 col-lg-7 col-xl-5">
                    @if (session('success'))
                        <div class="alert alert-success border-0">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning border-0">
                            {{ session('warning') }}
                        </div>
                    @endif

                    <form action="" class="course pt-2" method="post">
                        {{ csrf_field() }}
                        <div class="mt-4">
                            <label for="organisationSelect" class="form-label">Jak ocenia Pani/Pan organizację kursu w trybie e-learningu?</label>
                            <select id="organisationSelect" class="form-select" name="organisation">
                                <option value="6">6</option>
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                                <option value="0">0</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="intelligibilitySelect" class="form-label">Jak ocenia Pani/Pan jasność i zrozumiałość komunikatów?</label>
                            <select id="intelligibilitySelect" class="form-select" name="intelligibility">
                                <option value="6">6</option>
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                                <option value="0">0</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="registrationSelect" class="form-label">Jak ocenia Pani/Pan łatwość zarejestrowania się na kurs (w serwisie)?</label>
                            <select id="registrationSelect" class="form-select" name="registration">
                                <option value="6">6</option>
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                                <option value="0">0</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="qualityTMaterials" class="form-label">Jak ocenia Pani/Pan jakość materiałów dydaktycznych (pisanych)?</label>
                            <select id="qualityTMaterials" class="form-select" name="tmaterials">
                                <option value="6">6</option>
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                                <option value="0">0</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="qualityVMaterials" class="form-label">Jak ocenia Pani/Pan jakość materiałów dydaktycznych video? </label>
                            <select id="qualityVMaterials" class="form-select" name="vmaterials">
                                <option value="6">6</option>
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                                <option value="0">0</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="difficultySelect" class="form-label">Jak ocenia Pani/Pan trudność testu zaliczeniowego?</label>
                            <select id="difficultySelect" class="form-select" name="difficulty">
                                <option value="latwy">Łatwy</option>
                                <option value="raczej-latwy">Raczej łatwy</option>
                                <option value="sredni">Średni</option>
                                <option value="raczej-trudny">Raczej trudny</option>
                                <option value="trudny">Trudny</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="timeSelect" class="form-label">Czy czas trwania kursu – na zapoznanie się z materiałami dydaktycznymi – jest odpowiedni?</label>
                            <select id="timeSelect" class="form-select" name="time">
                                <option value="raczej-za-dlugi">Raczej za długi</option>
                                <option value="tak-odpowiedni">Tak - odpowiedni</option>
                                <option value="raczej-za-krotki">Raczej za krótki</option>
                                <option value="nie–za-krotki ">Nie – za krótki</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="text" class="form-label">Proszę wpisać tutaj ewentualne swoje uwagi dotyczące tego kursu:</label>
                            <textarea name="dodatkowe" id="text" class="form-control" style="height:180px"></textarea>
                        </div>
                        <div class="form-input mt-4 mb-0">
                            <button type="submit" class="btn btn-theme">WYŚLIJ ANKIETĘ</button>
                        </div>
                    </form>
                </div>
                @else
                    <div class="col-12 text-center">
                        <h4 class="text-center text-success d-block">Dziękujemy za wypełnienie formularza.</h4>
                        @if($examDateUsers->count() > 0)
                            <a href="{{ route('student.index') }}" class="btn-big btn btn-theme mt-5">MOJE KURSY</a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        @if (session('success')||session('warning'))
        $(window).load(function() {
            const aboveHeight = $('header').outerHeight();
            $('html, body').stop().animate({
                scrollTop: $('.alert').offset().top-aboveHeight
            }, 1500, 'easeInOutExpo');
        });
        @endif
    </script>
@endpush
