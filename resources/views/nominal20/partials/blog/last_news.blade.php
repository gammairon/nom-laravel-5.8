@foreach ($sidebarPosts as $sidebarPost)
    <li class="list-news__container-item list-withImg">
        <div class="news-img">
            <a href="{{ route('page_news', ['slug' => $sidebarPost->slug]) }}" class="absolute-link"></a>
            <picture>
                <source media="(min-width: 767px)">
                <img src="{{$sidebarPost->getPrimary()->getUrl('sidebar')}}" class="lazyload" data-src="{{$sidebarPost->getPrimary()->getUrl('sidebar')}}" alt="{{$sidebarPost->getPrimaryAlt()}}" title="{{$sidebarPost->getPrimaryTitle()}}">
            </picture>
        </div>
        <h6 class="list-title">
            <a href="{{ route('page_news', ['slug' => $sidebarPost->slug]) }}">{{$sidebarPost->name}}</a>
        </h6>
    </li>
@endforeach
