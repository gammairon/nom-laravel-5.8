<div class="article">
    <div class="img-article lazyload" data-bg="{{$finPost->getPrimary()->getUrl('thumb')}}" >
        <a href="{{ route('page_news', ['slug' => $finPost->slug]) }}" class="post-img">
            <div class="stories-counts">
                <div class="stories-views"><i class="fa fa-eye" aria-hidden="true"></i>{{$finPost->views}}</div>
            </div>
        </a>
    </div>
    <div class="title-aticle"><a href="{{ route('page_news', ['slug' => $finPost->slug]) }}">{{$finPost->name}}</a></div>
    <div class="date-create-article">{{$finPost->public_date->format('d/m/Y') }}</div>
    <p class="story-article">{{$finPost->excerpt}}</p>
</div>
