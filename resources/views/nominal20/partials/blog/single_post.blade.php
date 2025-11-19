<article id="single-post-{{$post->id}}" class="single-post " data-id="{{$post->id}}">
    <h1 class="single-post-title mb-20 font-weight-bold">
        {{$post->name}}
    </h1>
    {{--@if($post->excerpt)
        <h5 class="news-subtitle  mb-20">
            {{$post->excerpt}}
        </h5>
    @endif--}}

    <div class="post-header">
        <div class="post-date">
            <span>{{$post->public_date->format('H:i')}}</span> / <span>{{$post->public_date->diffForHumans()}}</span>
        </div>
        <div class="post-author">
            <a href="{{ route('author.single', ['slug' => $post->user->slug]) }}" title="автор">{{$post->user->name}}</a>
        </div>
    </div>
    <div class="block-image">
        <div class="news-img">
            <picture>
                <source media="(min-width: 767px)">
                <img src="{{$post->getPrimary()->getUrl('middle')}}" class="lazyload" data-src="{{$post->getPrimaryUrl()}}" alt="{{$post->getPrimaryAlt()}}" title="{{$post->getPrimaryTitle()}}">
            </picture>
        </div>
        <div class="icons">
            <div class="post-views icon-item">
                <div class="post-views__block">
                    <div class="img-icon">
                    </div>
                    <span>{{$post->views}}</span>
                </div>
            </div>
            <div class="share">
                <div class="icon-item share-btn tlg">
                    <div class="telegram">
                    </div>
                </div>
                <div class="icon-item share-btn facebook">
                    <div class="fb">
                    </div>
                </div>
                <div class="icon-item share-btn tw">
                    <div class="twitter">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="post-content">
        {!!$post->content!!}

        @includeWhen($post->enable_faq, 'front.partials.global.faqs', ['faqs' => $post->faqs])
    </div>
    <div class="post-footer">
        <div class="post-categories mb-20">
            @if ($post->categories)
                <span>Категория: </span>
                @foreach ($post->categories as $category)
                    @if ($loop->last)
                        <a href="{{ route('categories.single', ['slug' => $category->slug]) }}" title="{{$category->name}}">{{$category->name}}</a>
                    @else
                        <a href="{{ route('categories.single', ['slug' => $category->slug]) }}" title="{{$category->name}}">{{$category->name}}</a>,
                    @endif
                @endforeach
            @endif
        </div>
        <div class="post-tags mb-20">
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
                            <div class="news-img no-shadow">
                                <a href="{{ route('page_news', ['slug' => $popularPost->slug]) }}" class="absolute-link" title="{{$popularPost->name}}"></a>
                                <picture>
                                    <source media="(min-width: 767px)">
                                    <img src="{{$popularPost->getPrimary()->getUrl('thumb')}}" class="lazyload" data-src="{{$popularPost->getPrimary()->getUrl('thumb')}}" alt="{{$popularPost->getPrimaryAlt()}}" title="{{$popularPost->getPrimaryTitle()}}">
                                </picture>
                            </div>
                            <h6 class="list-title">
                                <a href="{{ route('page_news', ['slug' => $popularPost->slug]) }}" title="{{$popularPost->name}}">{{$popularPost->name}}</a>
                            </h6>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</article>
