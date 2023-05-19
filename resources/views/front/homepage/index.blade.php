@extends('layouts.homepage')

@section('content')
<div id="slider">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="mb-0 list-unstyled">
                    <li>
                        <picture>
                            <source srcset="{{ asset('/images/slider-1.webp') }}" type="image/webp">
                            <source srcset="{{ asset('/images/slider-1.jpg') }}" type="image/jpeg">
                            <img src="{{ asset('/images/slider-1.jpg') }}" loading="lazy" width="1380" height="776" class="w-100">
                        </picture>
                        <div class="slider-apla">Zapraszamy na kursy Zdrowie publiczne oraz Prawo medyczne</div>
                    </li>
                </ul>
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
                            @foreach($articles as $article)
                            <article class="row">
                                <div class="col-2">
                                    <div class="article-date">
                                        <span class="bigDate">{{ date("d", strtotime($article->date)) }}</span>
                                        <span class="smallDate">{{ date("m", strtotime($article->date)) }}.{{ date("Y", strtotime($article->date)) }}</span>
                                    </div>
                                </div>
                                <div class="col-10 ps-4 pt-4 pb-4">
                                    <div class="article-header">
                                        <h2>{{ $article->title }}</h2>
                                    </div>
                                    <div class="article-entry">
                                        {!! $article->content !!}
                                    </div>
                                </div>
                                <meta itemprop="datePublished" content="{{ $article->date }}">
                                <meta itemprop="author" content="Podkarpacki Oddział PTMSiZP">
                            </article>
                            @endforeach
                        </div>
                    </div>
                    <div class="pagination">
                        {{ $articles->links() }}
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