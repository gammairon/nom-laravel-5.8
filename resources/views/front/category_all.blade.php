@extends('layouts.news_app')


@section('content')
    <div class="container container-page d-md-flex content-all-page">
        <div class="col left-part-page">
            @if (isset($category))
                <h1 class="mb-5">{{$category->name}}</h1>
            @else
                <h1 class="mb-5">Все новости</h1>
            @endif

            <div class="row news-content">
                <section class="col-lg-12 col-xl-8 all-news">
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
