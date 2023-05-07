@extends('layouts.page')

@section('meta_title', 'Konferencje i  szkolenia')
@section('seo_title', '')
@section('seo_description', '')

@section('pageheader')
    @include('layouts.partials.page-header', ['title' => 'Konferencje i  szkolenia', 'header_file' => 'pageheader.jpg'])
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="articles">
                    <div class="container p-0">
                        @foreach($articles as $article)
                            <article class="row">
                                <div class="col-2 pe-4">
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
    </div>
@endsection