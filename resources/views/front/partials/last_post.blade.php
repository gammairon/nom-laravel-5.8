<a href="{{ route('page_news', ['slug' => $lastPost->slug]) }}" class="{{ $lastPost->top ? 'font-weight-bold':''}}">
    <span class="new d-flex align-items-center">
        <span class="time-last-new">{{$lastPost->public_date->format('H:i')}}</span>
        <span class="title-last-new">{{$lastPost->name}}</span>
    </span>
</a>
