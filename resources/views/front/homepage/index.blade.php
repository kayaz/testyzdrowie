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
                            @foreach($articles as $article)
                            <article class="row">
                                <div class="col-2">
                                    <div class="article-date">
                                        <span class="bigDate">09</span>
                                        <span class="smallDate">12.2022</span>
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