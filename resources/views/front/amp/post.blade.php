@extends('layouts.app-amp')


@section('content')
    <div class="single-post">
        <div class="post-header">
            <ul class="post-categories">
                @if ($post->categories)
                    @foreach ($post->categories as $category)
                        <li><a href="{{ route('categories.single', ['slug' => $category->slug]) }}" title="{{$category->name}}">{{$category->name}}</a></li>
                    @endforeach
                @endif
            </ul>
            <div class="post-date info" title="{{$post->public_date->format('d/m/Y')}}">
                {{$post->public_date->diffForHumans()}}, {{$post->public_date->format('H:i')}}
            </div>
            <div class="post-author">
                <a href="{{ route('author.single', ['slug' => $post->user->slug]) }}" title="автор">{{$post->user->name}}</a>
            </div>
            <div class="post-views info">
                <span>Просмотры: {{$post->views}} раз</span>
            </div>
        </div>
        <div class="post-content">
            <div class="title-news-detail">
                <h1>{{$post->name}}</h1>
            </div>
            <div class="img-detail-post">
                <amp-img src="{{url($post->getPrimary()->getUrl('middle'))}}" alt="{{$post->getPrimaryAlt()}}" title="{{$post->getPrimaryTitle()}}" width="650" height="350" layout="responsive" ></amp-img>
            </div>
            {!!$ampContent!!}
        </div>
        <div class="post-footer">

            <div class="post-tags">
                <strong>Теги: </strong>
                @if ($post->tags)
                    @foreach ($post->tags as $tag)
                        @if ($loop->last)
                            <a href="{{ route('tag.single', ['slug' => $tag->slug]) }}" title="{{$tag->name}}">{{$tag->name}}</a>
                        @else
                            <a href="{{ route('tag.single', ['slug' => $tag->slug]) }}" title="{{$tag->name}}">{{$tag->name}}</a>,
                        @endif

                    @endforeach
                @endif
            </div>
            <div class="share">
                <div class="share-buttons" >
                    <a href="https://www.facebook.com/sharer.php?u={{$post->seo->canonical}}" class="share-btn facebook"></a>
                    <a href="https://twitter.com/intent/tweet?url={{$post->seo->canonical}}" class="share-btn twitter"></a>
                    <a href="https://telegram.me/share/url?url={{$post->seo->canonical}}" class="share-btn telegram"></a>
                </div>
            </div>

            <div class="advert-amp">
                <amp-ad width="auto" height="480" type="idealmedia" data-publisher="nominal.com.ua" data-widget="690009" data-container="M417237ScriptRootC690009" ></amp-ad>
            </div>

            <div class="popular-posts">
                <h3>ПОПУЛЯРНЫЕ НОВОСТИ</h3>
                <ul class="list-popular-post">
                    @if ($popularPosts = $post->popularPostsByTag())
                        @foreach ($popularPosts as $popularPost)
                            <li class="popular-post-item">

                                <div class="img-detail-news">
                                    <a href="{{ route('page_news', ['slug' => $popularPost->slug]) }}" class="popular-post-img" >
                                        <amp-img src="{{url($popularPost->getPrimary()->getUrl('middle'))}}" alt="dssdsd" title="sdsdsd" width="650" height="350" layout="responsive" ></amp-img>
                                    </a>
                                </div>

                                <div class="popular-post-title">
                                    <h4><a href="{{ route('page', ['slug' => $popularPost->slug]) }}" title="{{$popularPost->name}}">{{$popularPost->name}}</a></h4>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>


        </div>
    </div>
@endsection
