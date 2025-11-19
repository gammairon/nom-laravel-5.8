@extends('layouts.news_app')


@section('content')
    <div class="container container-page d-md-flex content-all-page">
        <div class="col left-part-page">

            <div class="row news-content">
                <section class="col-lg-12 col-xl-8 all-news">
                    @isset ($author)
                        <h1 class="mb-3">{{$author->name}}</h1>
                        <div class="author-page-info clearfix" >
                            <picture>
                                <source media="(min-width: 767px)">
                                <img src="{{$author->getPrimary()->getUrl('middle')}}" class="lazyload" data-src="{{$author->getPrimaryUrl()}}" alt="{{$author->getPrimaryAlt()}}" title="{{$author->getPrimaryTitle()}}" >
                            </picture>
                            <div class="author-desc">{!! $author->description !!}</div>
                        </div>
                    @endisset
                    <div class="load-container">
                        @include('front.partials.category_post', ['posts' => $posts])
                    </div>

                    @if ($posts->hasMorePages())
                        <div class="button-c">
                            <a href="javascript:void(0);" class="button load-more">
                                <span>Загрузить ещё</span>
                                <i class="fa fa-spinner fa-spin"></i>
                            </a>
                        </div>
                    @endif

                </section>
                <section class="col-4 last-news">
                    @include('front.partials.last_news')
                </section>
            </div>
        </div>
        @include('front.partials.sidebar_news')
    </div>
@endsection

@push('before_scripts')
    <script>
        let nextPageUrl =  '{{$posts->nextPageUrl()}}';
    </script>
@endpush
