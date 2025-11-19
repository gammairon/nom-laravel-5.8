@extends('layouts.app')


@section('content')
    <div class="container fin-market">
        <div class="content">
            <div class="row">
                <div class="col">
                    <h1>Финансовый супермаркет</h1>
                </div>

            </div>
            <div class="row">
                <div class="col">
                    <h2 class="h4">Сравнивайте и заказывайте продукты банков и финансовых компаний</h2>
                </div>
            </div>
            <div class="row items-finance">
                <div class="col-xl">
                    <div class="img-finance"><a href="https://nominal.com.ua/kredit-online-na-kartu"><img data-src="{{asset('/storage/images/img1.png')}}" alt="Деньги до зарплаты" class="lazyload"></a></div>
                    <div class="title-finance"><a href="https://nominal.com.ua/kredit-online-na-kartu">Деньги до зарплаты</a></div>
                    <div class="desc-finance">Наличными или на карту</div>
                </div>
                <div class="col-xl">
                    <div class="img-finance"><a href="https://nominal.com.ua/kredit-nalichnymi-v-ukraine"><img data-src="{{asset('/storage/images/img2.png')}}" alt="Кредиты в банках" class="lazyload"></a></div>
                    <div class="title-finance"><a href="https://nominal.com.ua/kredit-nalichnymi-v-ukraine">Кредиты в банках</a></div>
                    <div class="desc-finance">Рассчитывайте кредиты наличными от 20 банков</div>
                </div>
                <div class="col-xl">
                    <div class="img-finance"><a href="{{ route('products.cards.all')}}"><img data-src="{{asset('/storage/images/img3.png')}}" alt="Кредитные карты" class="lazyload"></a></div>
                    <div class="title-finance"><a href="{{ route('products.cards.all')}}">Кредитные карты</a></div>
                    <div class="desc-finance">Сравнивайте кредитные карты 24 банков</div>
                </div>
                {{--<div class="col-xl">
                    <div class="img-finance"><a href="#"><img src="{{asset('/storage/images/img4.png')}}" alt="..."></a></div>
                    <div class="title-finance"><a href="#">Депозиты с бонусами</a></div>
                    <div class="desc-finance">Получайте бонус до 2% годовых к ставке банка</div>
                </div>
                <div class="col-xl how-it-work">
                    <div class="img-finance"><a href="#"><img src="{{asset('/storage/images/creditslaptop.png')}}" alt="..."></a></div>
                    <div class="title-finance"><a href="#">Как это работает</a></div>
                    <div class="desc-finance">Узнайте о возможностях Финансового супермаркета</div>
                </div>--}}
            </div>
        </div>
    </div>

    <div class="container d-md-flex news-content">
        <div class="col left">

            @if ($topPosts->isNotEmpty())
                <section class="news-main-img">
                    <article class="main-new lazyload" data-bg="{{$topPosts->first()->getPrimary()->getUrl('middle')}}" >
                        <a href="{{route('page_news', ['slug' => $topPosts->first()->slug])}}" class="post-img">
                            <div class="gradient-info">
                                <h3 class="main-news-title">
                                    {{$topPosts->first()->name}}
                                </h3>
                            </div>
                        </a>
                    </article>
                    <div class="secondary-news">
                        @foreach ($topPosts as $topPost)
                            @continue($loop->first)

                            <article class="secondary-new lazyload" data-bg="{{$topPost->getPrimary()->getUrl('thumb')}}" >
                                <a href="{{route('page_news', ['slug' => $topPost->slug])}}" class="post-img">
                                    <div class="gradient-info">
                                        <h3 class="news-title">
                                            {{$topPost->name}}
                                        </h3>
                                    </div>
                                </a>
                            </article>
                        @endforeach

                    </div>
                </section>
            @endif

            <section class="news-and-articles">
                <div class="row d-flex  block-news-and-articles">
                    <div class="col-lg-6  fin-articles">
                        <h4> Финансовые статьи</h4>

                        <div class="row">
                            @php
                                $firsColumn = '<div class="col-lg-6 first-column">';
                                $secondColumn = '<div class="col-lg-6">';
                            @endphp

                            @foreach ($finPosts as $key => $finPost)
                                @if ($loop->odd)
                                    @php
                                       $firsColumn .= view('front.partials.fin_post_tpl',['finPost' => $finPost]);
                                    @endphp
                                @else
                                    @php
                                       $secondColumn .= view('front.partials.fin_post_tpl',['finPost' => $finPost]);
                                    @endphp

                                @endif

                                @if ($loop->last)
                                    @php
                                        $firsColumn .= '</div>';
                                        $secondColumn .= '</div>';
                                    @endphp
                                @endif
                            @endforeach

                            {!! $firsColumn !!}
                            {!! $secondColumn !!}
                        </div>
                    </div>
                    <div class="col-lg-6 last-news">
                        @include('front.partials.last_news')
                    </div>
                </div>
            </section>
        </div>

        @include('front.partials.sidebar_news')
        <!--row-->
    </div>
@endsection
