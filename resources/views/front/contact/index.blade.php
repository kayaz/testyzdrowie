@extends('layouts.page')

@section('meta_title', 'Kontakt')
@section('seo_title', '')
@section('seo_description', '')

@section('pageheader')
    @include('layouts.partials.page-header', ['title' => 'Kontakt', 'header_file' => 'pageheader.jpg'])
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <p><span style="text-decoration: underline;"><strong>Adres</strong> siedziby PO PTMSiZP:</span></p>
                <p>35-959 Rzeszów,Al. mjr. W. Kopisto 2a &nbsp;(pok.216)</p>
                <p><strong>NIP</strong>: 517 035 63 65 &nbsp;&nbsp;</p>
                <p><strong>Regon</strong>: 000802662-00030</p>
                <p><strong>KRS</strong>: 0000019917</p>
                <p><span style="text-decoration: underline;">Nr konta bankowego</span>:&nbsp;</p>
                <p><b>56 1020 4391 0000 6502 0077 0529</b></p>
                <p><strong>adres mailowy</strong>:&nbsp;admin@zdrowiepubliczne-rzeszow.pl</p>
            </div>
            <div class="col-6">
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
                <form method="post" id="contact-form" action="{{ route("contact.form") }}" class="validateForm">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-12 col-md-4 form-input">
                            <label for="form_name">Imię <span class="text-danger">*</span></label>
                            <input name="form_name" id="form_name" class="validate[required] form-control @error('form_name') is-invalid @enderror" type="text" value="{{ old('form_name') }}">

                            @error('form_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-4 form-input col-input-important">
                            <label for="form_surname">Nazwisko <span class="text-danger">*</span></label>
                            <input name="form_surname" id="form_surname" class="form-control" type="text" value="{{ old('form_surname') }}">
                        </div>
                        <div class="col-12 col-md-4 form-input">
                            <label for="form_email">E-mail <span class="text-danger">*</span></label>
                            <input name="form_email" id="form_email" class="validate[required] form-control @error('form_email') is-invalid @enderror" type="text" value="{{ old('form_email') }}">

                            @error('form_email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-4 form-input">
                            <label for="form_phone">Telefon</label>
                            <input name="form_phone" id="form_phone" class="form-control @error('form_phone') is-invalid @enderror" type="text" value="{{ old('form_phone') }}">

                            @error('form_phone')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-12 mt-1 form-input">
                            <label for="form_message">Treść wiadomości <span class="text-danger">*</span></label>
                            <textarea rows="5" cols="1" name="form_message" id="form_message" class="validate[required] form-control @error('form_message') is-invalid @enderror">{{ old('form_message') }}</textarea>

                            @error('form_message')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <div class="form-input mb-0">
                                <input name="form_page" type="hidden" value="homepage">
                                <script type="text/javascript">
                                    document.write("<button class=\"btn btn-theme\" type=\"submit\">WYŚLIJ WIADOMOŚĆ</button>");
                                </script>
                                <noscript><p><b>Do poprawnego działania, Java musi być włączona.</b><p></noscript>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/validation.js') }}" charset="utf-8"></script>
    <script src="{{ asset('js/pl.js') }}" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".validateForm").validationEngine({
                validateNonVisibleFields: true,
                updatePromptsPosition:true,
                promptPosition : "topRight:-137px"
            });
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