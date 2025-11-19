<article class="news-second__item">
    <div class="news-img">
        <a href="{{ route('page_news', ['slug' => $post->slug]) }}" class="absolute-link">
        </a>
        <picture>
            <source srcset="{{$post->getPrimary()->getUrl('middle')}}" media="(min-width: 767px)" />
            <img src="{{$post->getPrimary()->getUrl('thumb')}}" class="lazyload" data-src="{{$post->getPrimary()->getUrl()}}" alt="{{$post->getPrimaryAlt()}}" title="{{$post->getPrimaryTitle()}}">
        </picture>
    </div>
    <div class="news-text">
        <div class="news-text__category">
            @if($post->categories->isNotEmpty())
                {{$post->categories->first()->name}}
            @endif

        </div>
        <h6 class="title-article">
            <a href="{{ route('page_news', ['slug' => $post->slug]) }}">
                {{$post->name}}
            </a>
        </h6>
    </div>
</article>
