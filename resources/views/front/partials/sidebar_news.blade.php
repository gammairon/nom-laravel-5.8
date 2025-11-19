<section class="col-md-12 flex-fixed-width-item right-sidebar">

    <section class="sidebar-block-nomobil">
        @foreach ($sidebarPosts as $sidebarPost)
            <div class="news-stories-top-content">
                <div class="news-stories-img lazyload" data-bg="{{$sidebarPost->getPrimary()->getUrl('sidebar')}}" >
                    <a href="{{ route('page_news', ['slug' => $sidebarPost->slug]) }}" class=post-img>
                        <div class="stories-counts">
                            <div class="stories-views"><i class="fa fa-eye" aria-hidden="true"></i>{{$sidebarPost->views}}</div>
                        </div>
                    </a>
                </div>
                <div class="title-top-content">
                    <a href="{{ route('page_news', ['slug' => $sidebarPost->slug]) }}">{{$sidebarPost->name}}</a>
                </div>
            </div>
        @endforeach
    </section>

</section>
