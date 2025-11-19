@foreach($lastPosts as $lastPost)
    <li class="list-news__container-item">
        <span class="time">{{$lastPost->public_date->format('H:i')}}</span>
        <a href="{{ route('page_news', ['slug' => $lastPost->slug]) }}" class="{{ $lastPost->top ? 'font-weight-bold':''}} list-title" >{{$lastPost->name}}</a>
    </li>
@endforeach
