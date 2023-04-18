@extends('layouts.page')

@section('meta_title', 'Nowe konto')
@section('seo_title', '')
@section('seo_description', '')

@section('pageheader')
    @include('layouts.partials.page-header', ['title' => 'Nowe konto', 'header_file' => 'pageheader.jpg'])
@stop

@section('content')
    <div class="page-text">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-heading">
                        <span class="section-text">Utwórz nowe konto </span>
                        <span class="section-dot"></span>
                        <span class="section-line"></span>
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
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
                    <form method="post" id="contact-form" action="{{ route('register') }}" class="validateForm">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-3 form-input">
                                <label for="form_degree">Stopień / tytył naukowy <span class="text-danger">*</span></label>
                                <select name="form_degree" id="form_degree" class="form-control">
                                    <option value="lek.med_lek.stom">lek. med. / lek. stom.</option>
                                    <option value="dr">dr</option>
                                    <option value="dr_hab">dr hab.</option>
                                    <option value="prof">prof.</option>
                                </select>
                            </div>
                            <div class="col-3 form-input">
                                <label for="form_specialization">Nazwa nowej specjalizacji <span class="text-danger">*</span></label>
                                <input name="form_specialization" id="form_specialization" class="validate[required] form-control @error('form_specialization') is-invalid @enderror" type="text" value="{{ old('form_specialization') }}" autofocus>

                                @error('form_specialization')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-3 form-input">
                                <label for="form_practice">Nr. prawa wykonywania zawodu <span class="text-danger">*</span></label>
                                <input name="form_practice" id="form_practice" class="validate[required] form-control @error('form_practice') is-invalid @enderror" type="text" value="{{ old('form_practice') }}">

                                @error('form_practice')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <h4 class="section-heading">
                                    <span class="section-text">Dane osobowe </span>
                                    <span class="section-dot"></span>
                                    <span class="section-line"></span>
                                </h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3 form-input">
                                <label for="form_name">Imię <span class="text-danger">*</span></label>
                                <input name="form_name" id="form_name" class="validate[required] form-control @error('form_name') is-invalid @enderror" type="text" value="{{ old('form_name') }}">

                                @error('form_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-3 form-input">
                                <label for="form_surname">Nazwisko <span class="text-danger">*</span></label>
                                <input name="form_surname" id="form_surname" class="validate[required] form-control @error('form_surname') is-invalid @enderror" type="text" value="{{ old('form_surname') }}">

                                @error('form_surname')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-3 form-input">
                                <label for="form_pesel">Pesel <span class="text-danger">*</span></label>
                                <input name="form_pesel" id="form_pesel" class="validate[required] form-control @error('form_pesel') is-invalid @enderror" type="text" value="{{ old('form_pesel') }}">

                                @error('form_pesel')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3 form-input">
                                <label for="form_postcode">Kod pocztowy <span class="text-danger">*</span></label>
                                <input name="form_postcode" id="form_postcode" class="validate[required] form-control @error('form_postcode') is-invalid @enderror" type="text" value="{{ old('form_postcode') }}">

                                @error('form_postcode')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-3 form-input">
                                <label for="form_city">Miasto <span class="text-danger">*</span></label>
                                <input name="form_city" id="form_city" class="validate[required] form-control @error('form_city') is-invalid @enderror" type="text" value="{{ old('form_city') }}">

                                @error('form_city')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-3 form-input">
                                <label for="form_address">Ulica / dom / mieszkanie <span class="text-danger">*</span></label>
                                <input name="form_address" id="form_address" class="validate[required] form-control @error('form_address') is-invalid @enderror" type="text" value="{{ old('form_address') }}">

                                @error('form_address')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3 form-input">
                                <label for="form_email">E-mail <span class="text-danger">*</span></label>
                                <input name="form_email" id="form_email" class="validate[required,custom[email]] form-control @error('form_email') is-invalid @enderror" type="text" value="{{ old('form_email') }}" autocomplete="email">

                                @error('form_email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-3 form-input">
                                <label for="form_phone">Telefon <span class="text-danger">*</span></label>
                                <input name="form_phone" id="form_phone" class="validate[required,custom[phone]] form-control @error('form_phone') is-invalid @enderror" type="text" value="{{ old('form_phone') }}">

                                @error('form_phone')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <h4 class="section-heading">
                                    <span class="section-text">Hasło </span>
                                    <span class="section-dot"></span>
                                    <span class="section-line"></span>
                                </h4>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-3 form-input">
                                <label for="form_password">Hasło <span class="text-danger">*</span></label>
                                <input name="form_password" id="form_password" class="validate[required] form-control @error('form_password') is-invalid @enderror" type="password" autocomplete="new-password">

                                @error('form_password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-3 form-input">
                                <label for="form_password_confirmation">Powtórz hasło <span class="text-danger">*</span></label>
                                <input name="form_password_confirmation" id="form_password_confirmation" class="validate[required,equals[form_password]] form-control" type="password" autocomplete="new-password">
                            </div>

                            <div class="col-12 d-flex justify-content-start mt-4">
                                <div class="form-input mb-0">
                                    <input name="form_page" type="hidden" value="homepage">
                                    <script type="text/javascript">
                                        document.write("<button class=\"btn btn-theme\" type=\"submit\">ZAREJESTRUJ SIĘ</button>");
                                    </script>
                                    <noscript><p><b>Do poprawnego działania, Java musi być włączona.</b><p></noscript>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/validation.js') }}" charset="utf-8"></script>
    <script src="{{ asset('js/pl.js') }}" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            // $(".validateForm").validationEngine({
            //     validateNonVisibleFields: true,
            //     updatePromptsPosition:true,
            //     promptPosition : "topRight:-137px"
            // });
        });
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