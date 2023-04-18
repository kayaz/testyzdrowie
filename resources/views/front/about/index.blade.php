@extends('layouts.page')

@section('meta_title', 'O nas')
@section('seo_title', '')
@section('seo_description', '')

@section('pageheader')
    @include('layouts.partials.page-header', ['title' => 'O nas', 'header_file' => 'pageheader.jpg'])
@stop

@section('content')
<div class="page-text">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p><strong>Podkarpacki Oddział Polskiego Towarzystwa Medycyny Społecznej i Zdrowia Publicznego </strong>z siedzibą w Rzeszowie został utworzony na mocy <em>Uchwały Nr 1/2007 Zarządu Głównego PTMSiZP z dnia <strong>30 maja 2007 r.</strong></em></p>
                <p>&nbsp;</p>
                <p><span style="text-decoration: underline;">Obecnie w skład<strong> Zarządu&nbsp;</strong></span><span style="text-decoration: underline;"><strong>PO PTMSiZP</strong></span>, na podstawie <em>Uchwały Nr 1/2016 z dnia 31.03.2016 r.</em>, wchodzą następujące osoby:</p>
                <ul>
                    <li>dr n. med. Wacław Kruk - Prezes</li>
                    <li>dr n. o zdr. Grażyna Hejda - V-ce Prezes</li>
                    <li>dr hab. n. o zdr. Monika Binkowska- Bury - V-ce Prezes</li>
                    <li>mgr Iwona Kuźniar - Sekretarz</li>
                    <li>mgr Paweł Kuna - Skarbnik</li>
                    <li>dr n. med. Beata Penar- Zadarko - Członek Zarządu</li>
                    <li>dr n. o zdr. Filip Osuchowski - Członek Zarządu</li>
                </ul>
                <p>&nbsp;</p>
                <p><span style="text-decoration: underline;">W skład <strong>Komisji Rewizyjnej</strong> wchodzą:</span></p>
                <ul>
                    <li>dr adw. Małgorzata Paszkowska - Przewodnicząca</li>
                    <li>dr n. med. Małgorzata Marć - Sekretarz</li>
                    <li>dr n. o zdr. Zdzisława Chmieli - Członek</li>
                </ul>
                <p>&nbsp;</p>
                <p><span style="text-decoration: underline;"><strong>Celem</strong> Towarzystwa jest:</span></p>
                <ol>
                    <li>Pogłębienie społecznego charakteru ochrony zdrowia ludności oraz rozwijanie i upowszechnianie metod i osiągnięć naukowych w dziedzinie medycyny społecznej i zdrowia publicznego.</li>
                    <li>Zachęcanie i wdrażanie swych członków do pracy naukowej w zakresie dyscyplin związanych z działalnością Towarzystwa.</li>
                    <li>Podnoszenie poziomu zawodowego, naukowego i etycznego członków Towarzystwa.</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection