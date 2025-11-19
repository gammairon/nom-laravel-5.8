@extends('nominal20.layouts.app')


@section('content')
    <div class="newsPage">
        <div class="container-page">
            {{--<div class="title">
                <h1> Финансовый супермаркет </h1>
                <h4>Финансовый супермаркет Сравнивайте и заказывайте продукты банков</h4>
            </div>--}}
        </div>
        <div class="page">
            <div class="container-page">
                <div class="sidebar sidebar-left">
                    <section class="sidebar-news">
                        <h5 class="sidebar-news__title">Лента новостей</h5>
                        <div class="sidebar-news__list white-box">
                            <ul class="list-news__container">
                                @include('nominal20.partials.blog.feed_news')
                            </ul>
                        </div>
                    </section>
                </div>
                <div class="main-column">
                    <div id="post-list" class="post-list">
                        @include('nominal20.partials.blog.single_post', ['post' => $post])

                        @foreach ($posts as $nextPost)
                            @include('nominal20.partials.blog.single_post', ['post' => $nextPost])
                        @endforeach
                    </div>

                </div>
                <div class="sidebar sidebar-right">
                    <section class="sidebar-news">
                        <h5 class="sidebar-news__title">Полезные статьи</h5>
                        <div class="sidebar-news__list white-box">
                            <ul class="list-news__container">
                                @include('nominal20.partials.blog.last_news')
                            </ul>
                        </div>
                    </section>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('before_scripts')
    <script>
        let loadedPosts =  '@json($loadedPosts)';
    </script>
@endpush
