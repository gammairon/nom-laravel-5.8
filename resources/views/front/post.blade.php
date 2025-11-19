@extends('layouts.news_app')


@section('content')
    <div class="container container-page d-md-flex content-all-page">
        <div class="col left-part-page">
            <div class="row d-flex news-content">
                <section id="post-list" class="col-lg-12 col-xl-8 news-detail post-list">
                    @include('front.partials.single_post', ['post' => $post])

                    @foreach ($posts as $nextPost)
                        @include('front.partials.single_post', ['post' => $nextPost])
                    @endforeach
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
        let loadedPosts =  '@json($loadedPosts)';
    </script>
@endpush
