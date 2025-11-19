{!! '<'.'?'.'xml version="1.0" encoding="UTF-8" ?>' !!}

<rss version="2.0">

    <channel>

        <title>Финансы в Украине, финансовые новости | Nominal</title>

        <link>https://news.nominal.com.ua</link>

        <description>Всё о финансах в Украине. Актуальные новости о банках. Курсы валют, кредиты, депозиты. Финансовая аналитика.</description>

        @foreach($posts as $post)

            @continue($post->categories->isEmpty() || !isset($matchCategories[$post->categories->first()->slug]))

            <item>

                <title><![CDATA[{!! $post->name !!}]]></title>

                <link>{{ route('page_news', $post->slug) }}</link>

                <description><![CDATA[{!! !empty($post->excerpt) ? $post->excerpt:\Illuminate\Support\Str::limit(strip_tags($post->content)) !!}]]></description>

                <category>{{ $matchCategories[$post->categories->first()->slug] }}</category>

                @if($post->hasPrimary())
                    <enclosure url="{{asset($post->getPrimaryUrl())}}" type="{{$post->getPrimary()->mime_type}}"></enclosure>
                @endif

                <pubDate>{{ $post->public_date->format(DateTime::RSS) }}</pubDate>

                <full-text><![CDATA[{!! strip_tags($post->content) !!}]]></full-text>

            </item>

        @endforeach

    </channel>
</rss>
