@foreach ($posts as $post)
    <article class="short-story">
        <a href="{{ route('page_news', ['slug' => $post->slug]) }}" class="post-img short-post lazyload" data-bg="{{$post->getPrimary()->getUrl('thumb')}}">
            <div class="gradient-info">
                <div class="news-date">{{$post->public_date->format('d/m/Y') }}</div>
                <div class="news-counts">
                    <span class="news-views"><i class="fa fa-eye" aria-hidden="true"></i>{{$post->views}}</span>
                </div>
            </div>
        </a>
        <div class="short-post-content">
            <h2 class="title-shot-post"><a href="{{ route('page_news', ['slug' => $post->slug]) }}">{{$post->name}}</a></h2>
            <p class="short-story-post">{{$post->excerpt}}</p>
        </div>
    </article>
@endforeach
