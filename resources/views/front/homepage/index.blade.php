@extends('layouts.homepage')

@section('content')
<div id="slider">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <img src="https://via.placeholder.com/1380x776" alt="">
            </div>
        </div>
    </div>
</div>

<div id="content" class="mt-5 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="left-column">
                    <h2 class="section-heading">
                        <span class="section-text">Aktualności </span>
                        <span class="section-dot"></span>
                        <span class="section-line"></span>
                    </h2>

                    <div id="articles">
                        <div class="container p-0">
                            <article class="row">
                                <div class="col-2">
                                    <div class="article-date">
                                        <span class="bigDate">09</span>
                                        <span class="smallDate">12.2022</span>
                                    </div>
                                </div>
                                <div class="col-10 ps-4">
                                    <div class="article-header">
                                        <h2><a href="#">Terminy kursów</a></h2>
                                    </div>
                                    <div class="article-entry">
                                        <p><strong>UWAGA</strong>: Przy rejestrowaniu sie na <strong>dwa kursy</strong>, proszę to robic <span>z dw&oacute;ch r&oacute;żnych adres&oacute;w mailowych!</span></p>
                                        <p><span><strong>Terminy kurs&oacute;w:</strong></span></p>
                                        <p><strong>Zdrowie publiczne - modułowy </strong>(organizator- <strong>Rzeszowska OIL</strong>):</p>
                                        <p>2023-01-11 do 2023-01-20; 2023-05-08 do 2023-05-17; 2023-10-04 do 2023-10-13;</p>
                                        <p><strong>Prawo medyczne - modułowy<strong>&nbsp;</strong></strong>(organizator- <strong>Rzeszowska OIL</strong>):</p>
                                        <p>2023-02-01 do 2023-02-03; 2023-05-24 do 2023-05-26; 2023-10-25 do 2023-10-27;</p>
                                        <p>......................................................................................................................</p>
                                        <p><strong>Prawo medyczne - dla Lubelskiej Izby Lekarskiej:</strong></p>
                                        <p>&nbsp;</p>
                                        <p><strong>Zdrowie publiczne modułowy - dla Lubelskiej Izby Lekarskiej:</strong></p>
                                        <p>&nbsp;</p>
                                    </div>
                                    <div class="article-footer d-flex justify-content-end">
                                        <a href="#" class="btn btn-theme btn-small">CZYTAJ WIĘCEJ</a>
                                    </div>
                                </div>
                                <meta itemprop="datePublished" content="2023-01-02">
                                <meta itemprop="author" content="Agencja 4DL.pl">
                            </article>

                            <article class="row">
                                <div class="col-2">
                                    <div class="article-date">
                                        <span class="bigDate">25</span>
                                        <span class="smallDate">01.2018</span>
                                    </div>
                                </div>
                                <div class="col-10 ps-4">
                                    <div class="article-header">
                                        <h2><a href="#">UWAGA ! rejestracja na kursy jest możliwa po uprzednim zarejestrowaniu się w CMKP - system SMK. Konieczność uzyskania zgody (kwalifikacji) nie dotyczy członków: rzeszowskiej, lubelskiej i świętokrzyskiej OIL, które są organizatorami kursów.</a></h2>
                                    </div>
                                    <div class="article-entry">
                                        <p>Szanowni Państwo!</p>
                                        <p>Szczegółowe informacje o kursie e-learningowym można znaleźć już po zarejestrowaniu się, w zakładce -&nbsp;<em><strong>I</strong><strong>nformacje </strong>lub w<strong> Regulaminie </strong>(przy rejestrowaniu się).</em></p>
                                        <p><em><strong>Uwaga! </strong>Pisząc maila do<strong> Administratora </strong>(adres w<strong>&nbsp;</strong>zakładce<strong> Kontakt</strong>)<strong>, </strong><span style="text-decoration: underline;">proszę zanaczyć w temacie wiadomości<strong>&nbsp; </strong>odpowiednio:<strong>&nbsp;kurs ZP, kurs modułowy ZP l</strong>ub<strong> PM, specjalizacja.</strong></span></em></p>
                                    </div>
                                    <div class="article-footer d-flex justify-content-end">
                                        <a href="#" class="btn btn-theme btn-small">CZYTAJ WIĘCEJ</a>
                                    </div>
                                </div>
                                <meta itemprop="datePublished" content="2023-01-02">
                                <meta itemprop="author" content="Agencja 4DL.pl">
                            </article>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-4">
                <div class="right-column">
                    <h2 class="section-heading">
                        <span class="section-text">Ważne informacje </span>
                        <span class="section-dot"></span>
                        <span class="section-line"></span>
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection