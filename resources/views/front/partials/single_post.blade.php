 <div id="single-post-{{$post->id}}" class="single-post page-content" data-id="{{$post->id}}">
    <div class="post-header">
        <ul class="post-categories">
            @if ($post->categories)
                @foreach ($post->categories as $category)
                    <li><a href="{{ route('categories.single', ['slug' => $category->slug]) }}" title="{{$category->name}}">{{$category->name}}</a></li>
                @endforeach
            @endif
        </ul>
        <time class="post-date" title="{{$post->public_date->format('d/m/Y')}}">
            {{$post->public_date->diffForHumans()}}, {{$post->public_date->format('H:i')}}
        </time>
        <div class="post-author">
            <a href="{{ route('author.single', ['slug' => $post->user->slug]) }}" title="автор">{{$post->user->name}}</a>
        </div>
        <div class="post-views">
            <span><i class="fa fa-eye" aria-hidden="true"></i>{{$post->views}}</span>
        </div>
    </div>
    <div class="post-content">
        <div class="title-news-detail">
            <h1>{{$post->name}}</h1>
        </div>
        <div class="img-detail-news"><img class="lazyload" data-src="{{$post->getPrimary()->getUrl('middle')}}" alt="{{$post->getPrimaryAlt()}}" title="{{$post->getPrimaryTitle()}}"></div>
        {!!$post->content!!}
    </div>
    <div class="post-footer">
        <div class="post-tags">
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

        <div class="popular-posts">
            <ul class="list-popular-post">
                @if ($popularPosts = $post->popularPostsByTag())
                    @foreach ($popularPosts as $popularPost)
                        <li class="popular-post-item">
                            <figure>
                                <a href="{{ route('page_news', ['slug' => $popularPost->slug]) }}" class="popular-post-img lazyload" data-bg="{{$popularPost->getPrimaryUrl()}}" title="{{$popularPost->getPrimaryTitle()}}"></a>
                                <figcaption class="popular-post-title mt-2">
                                    <h4><a href="{{ route('page_news', ['slug' => $popularPost->slug]) }}" title="{{$popularPost->name}}">{{$popularPost->name}}</a></h4>
                                </figcaption>
                            </figure>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>

        {{--<div class="partner-news">
            <iframe width="100%" height="300" scrolling="none" frameborder="0" src="/37905.html"></iframe>
        </div>--}}

        <div class="share">

            <div class="share-buttons" >
                <div class="share-btn facebook"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook<span class="count"></span></div>
                <div class="share-btn twitter"><i class="fa fa-twitter" aria-hidden="true"></i>Twitter<span class="count"></span></div>
                <div class="share-btn telegram"><i class="fa fa-telegram" aria-hidden="true"></i>Telegram<span class="count"></span></div>
            </div>
        </div>

    </div>
</div>
