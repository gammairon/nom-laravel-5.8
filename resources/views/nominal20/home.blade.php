@extends('nominal20.layouts.app')


@section('content')
    <div class="mainPage">
        <div class="container-page">
            <div class="title">
                <h1> Финансовый супермаркет </h1>
                <h4>Сравнивайте и заказывайте продукты банков и финансовых компаний</h4>
            </div>
        </div>
        <div class="page">
            <div class="container-page">

                <div class="content">
                    <div class="left-part">
                        <div class="menu-mainPage">
                            <div class="menu-mainPage__item">
                                <a href="https://zaimodobren.in.ua/" class="item-link">
                                    <div class="img">
                                        <img class="img-svg" src="{{asset('/storage/images/nominal20/1.svg')}}">
                                    </div>
                                    <div class="text">Кредиты онлайн</div>
                                </a>
                            </div>
                            <div class="menu-mainPage__item">
                                <a href="https://nominal.com.ua/kredit-nalichnymi" class="item-link">
                                    <div class="img">
                                        <img class="img-svg" src="{{asset('/storage/images/nominal20/punk_bank_krediti.svg')}}">
                                    </div>
                                    <div class="text">Банковские кредиты</div>
                                </a>
                            </div>
                            <div class="menu-mainPage__item">
                                <a href="https://nominal.com.ua/kreditnye-karty" class="item-link">
                                    <div class="img">
                                        <img class="img-svg" src="{{asset('/storage/images/nominal20/punkt_kredit_karti.svg')}}">
                                    </div>
                                    <div class="text">Кредитные карты</div>
                                </a>
                            </div>
                        </div>
                        <section class="news">
                            @php
                                $firstTopPost = $topPosts->shift();
                                $topPosts = $topPosts->chunk(4);
                            @endphp
                            <article class="news-main">
                                <a href="{{ route('page_news', ['slug' => $firstTopPost->slug]) }}" class="absolute-link">
                                </a>
                                <div class="news-img">
                                    <img src="{{$firstTopPost->getPrimary()->getUrl()}}" class="lazyload" data-src="{{$firstTopPost->getPrimary()->getUrl()}}" alt="{{$firstTopPost->getPrimaryAlt()}}" title="{{$firstTopPost->getPrimaryTitle()}}">
                                </div>
                                <div class="title-article__main">
                                    <h3>{{$firstTopPost->name}}</h3>
                                </div>
                            </article>
                            <div class="news-second">
                                <?php foreach ($topPosts->get(0) as $topPost): ?>
                                    @include('nominal20.partials.home.post-article', ['post' => $topPost])
                                <?php endforeach; ?>
                            </div>
                        </section>
                        <section class="slider">
                            <div class="slider-top">
                                <h4> Предложения для вас </h4>
                                <div class="slider-control">
                                    <div class="slider-control__dots">
                                        <div class="dot active nav-sl nav-sl-0" data-sl="0">
                                        </div>
                                        <div class="dot nav-sl nav-sl-1" data-sl="1">
                                        </div>
                                        <div class="dot nav-sl nav-sl-2" data-sl="2">
                                        </div>
                                    </div>
                                    <div class="slider-control__arrows">
                                        <div class="arrow-left arr prev-sl">
                                        </div>
                                        <div class="arrow-right arr active next-sl">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="mfo-slider" class="slider-mfo">
                                @if($mfos->isNotEmpty())
                                    @php
                                        $count = 1;
                                    @endphp
                                    @foreach($mfos as $chunkMfos)
                                        <div class="slider-main">
                                            @foreach ($chunkMfos as $mfo)
                                                @if($loop->iteration == 2)
                                                    <div class="slider-main__item red-item">
                                                        <div class="num">
                                                            0{{$count}}
                                                        </div>
                                                        <div class="slider-main__item__info">
                                                            <div class="logo-company" style="background-image: url({{$mfo->getPrimaryUrl()}})">
                                                                <a href="{{ route('mfo.single', ['slug' => $mfo->slug]) }}" title="{{$mfo->name}}" target="_blank" class="link-logo-company"></a>
                                                            </div>
                                                            <div class="line"></div>
                                                            <div class="news-text__category">
                                                                <a href="{{ route('mfo.single', ['slug' => $mfo->slug]) }}" title="{{$mfo->name}}" target="_blank" class="more">Финансы</a>
                                                            </div>
                                                            <h6 class="title-article">
                                                                <a href="{{ route('mfo.single', ['slug' => $mfo->slug]) }}" title="{{$mfo->name}}" target="_blank" >{{$mfo->name}}</a>
                                                            </h6>
                                                            <a href="{{ route('mfo.single', ['slug' => $mfo->slug]) }}" target="_blank" class="more">Подробнее <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="slider-main__item">
                                                        <div class="num">
                                                            0{{$count}}
                                                        </div>
                                                        <div class="slider-main__item__info">
                                                            <div class="logo-company" style="background-image: url({{$mfo->getPrimaryUrl()}})">
                                                                <a href="{{ route('mfo.single', ['slug' => $mfo->slug]) }}" title="{{$mfo->name}}" target="_blank" class="link-logo-company"></a>
                                                            </div>
                                                            <div class="line"></div>
                                                            <div class="news-text__category">
                                                                <a href="{{ route('mfo.single', ['slug' => $mfo->slug]) }}" title="{{$mfo->name}}" target="_blank" class="more">Финансы</a>
                                                            </div>
                                                            <h6 class="title-article">
                                                                <a href="{{ route('mfo.single', ['slug' => $mfo->slug]) }}" title="{{$mfo->name}}" target="_blank" >{{$mfo->name}}</a>
                                                            </h6>
                                                            <a href="{{ route('mfo.single', ['slug' => $mfo->slug]) }}" target="_blank" class="more">Подробнее <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>
                                                @endif
                                                    @php
                                                        $count++;
                                                    @endphp
                                            @endforeach



                                            {{--<div class="slider-main__item">
                                                <div class="num">
                                                    03
                                                </div>
                                                <div class="slider-main__item__info">
                                                    <div class="logo-company">
                                                    </div>
                                                    <div class="line"></div>
                                                    <div class="news-text__category">
                                                        Финансы
                                                    </div>
                                                    <h6 class="title-article">
                                                        <a href="">
                                                            До 10 000 гривен под 0.01%, деньги на карту!
                                                        </a>
                                                    </h6>
                                                    <a class="more">
                                                        Подробнее
                                                    </a>
                                                </div>
                                            </div>--}}
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </section>
                        <section class="news">
                            <div class="news-second">
                                <?php foreach ($topPosts->get(1) as $topPost): ?>
                                    @include('nominal20.partials.home.post-article', ['post' => $topPost])
                                <?php endforeach; ?>
                            </div>
                        </section>
                        <section class="subscriptions">
                            <div class="subscriptions-block telegram-news ">
                                <div>
                                    <h5> Читайте нас в Telegram </h5>
                                    <p>Канал о том, как экономить, получать скидки и не переплачивать банкам
                                    </p>
                                    <div class="link-telegram"> @nominal_ukr </div>
                                </div>
                                <div class="subscription-chanel">
                                    <a href="https://t.me/joinchat/AAAAAFfcz7etmxBbSxgk5A" class="link-chanel" target="_blank"> Подписаться на канал </a>
                                    <div class="img"></div>
                                </div>
                            </div>
                            <div class="subscriptions-block email-news">
                                <div>
                                    <h5> Подпишитесь на рассылку Nominal </h5>
                                    <p>Получайте сводку главных новостей дня каждый вечер
                                    </p>
                                </div>

                                <div class="subscription-email ">
                                    <div class="subscription-email-msg "></div>
                                    <input type="email" class="inp-email " placeholder="Ваш e-mail" required>
                                    <input type="image" src="{{asset('/storage/images/nominal20/7.svg')}}" name="submit" class="btn-email subscription-email-btn"  value="">
                                </div>
                            </div>
                        </section>
                        <section class="news">
                            <div class="news-second">
                                <?php foreach ($topPosts->get(2) as $topPost): ?>
                                    @include('nominal20.partials.home.post-article', ['post' => $topPost])
                                <?php endforeach; ?>
                            </div>
                        </section>
                        <section class="most-articles white-box tab-wrap tab-container">
                            <div class="most-articles__tabs">
                                <div class="most-articles__tabs-item tab-parent active">
                                    <label class="tab" data-target="#reading">
                                        <span>Самое читаемое</span>
                                    </label>
                                </div>
                                {{--<div class="most-articles__tabs-item tab-parent">
                                         <label class="tab" data-target="#discussed">
                                             <span><span class="hidden-mob">Самое</span>  обсуждаемое</span>
                                         </label>
                                     </div>--}}

                            </div>
                            <div id="reading" class="most-articles__choice tab-content active">
                                <div class="articles-container">
                                    @if($mostReadingPosts->isNotEmpty())
                                        @foreach($mostReadingPosts as $mostReadingPost)
                                            <div class="articles-container__item">
                                                <h6 class="title-article">
                                                    <a href="{{ route('page_news', ['slug' => $mostReadingPost->slug]) }}">
                                                        {{$mostReadingPost->name}}
                                                    </a>
                                                </h6>
                                                <div class="info-article">
                                                    <div class="view">
                                                        {{$mostReadingPost->views}}
                                                    </div>
                                                    {{--<div class="comment">
                                                        21
                                                    </div>--}}
                                                    <div class="date">
                                                        {{$mostReadingPost->public_date->diffForHumans()}} <span> {{$mostReadingPost->public_date->format('H:i')}} </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            {{--<div id="discussed" class="most-articles__choice tab-content">
                            </div>--}}
                        </section>
                    </div>
                    <div class="sidebar">
                        <section class="kurs white-box tab-container">
                            <div class="kurs-val__tabs">
                                <div class="kurs-val__tabs-item tab-parent active">
                                    <label class="tab" data-target="#nbu">
                                        <span>НБУ</span>
                                    </label>
                                </div>
                                <div class="kurs-val__tabs-item tab-parent">
                                    <label class="tab" data-target="#privat_bank">
                                        <span>Приват Банк</span>
                                    </label>
                                </div>
                            </div>
                            <div id="nbu" class="kurs-val__table tab-content active">
                                <div class="table-top">
                                    <div class="table-top__item col1">
                                        Валюта
                                    </div>
                                    <div class="table-top__item col2">
                                        Покупка
                                    </div>
                                    <div class="table-top__item col3">
                                        Продажа
                                    </div>
                                </div>
                                <div class="table-kurs">
                                    <div class="table-kurs__row usd">
                                        <div class="col1">
                                            <div class="val"> </div> <span class="currensy"> USD </span>
                                        </div>
                                        <div class="col2">
                                            <div class="rate"> {{$currencyRateService->getBuyRate('nbu', 'USD')}} </div>
                                            <div class="diff {{  $currencyRateService->isUpBuyRate('nbu', 'USD') ? 'up':'down'}}">{{$currencyRateService->getBuyDifferenceRate('nbu', 'USD')}}</div>
                                        </div>
                                        <div class="col3">
                                            <div class="rate"> {{$currencyRateService->getSaleRate('nbu', 'USD')}} </div>
                                            <div class="diff {{  $currencyRateService->isUpSaleRate('nbu', 'USD') ? 'up':'down'}}">{{$currencyRateService->getSaleDifferenceRate('nbu', 'USD')}}</div>
                                        </div>
                                    </div>
                                    <div class="all-kurs">
                                        <div class="table-kurs__row eur">
                                            <div class="col1">
                                                <div class="val"> </div> <span class="currensy"> EUR </span>
                                            </div>
                                            <div class="col2">
                                                <div class="rate">{{$currencyRateService->getBuyRate('nbu', 'EUR')}} </div>
                                                <div class="diff {{  $currencyRateService->isUpBuyRate('nbu', 'EUR') ? 'up':'down'}}">{{$currencyRateService->getBuyDifferenceRate('nbu', 'EUR')}}</div>
                                            </div>
                                            <div class="col3">
                                                <div class="rate">{{$currencyRateService->getSaleRate('nbu', 'EUR')}} </div>
                                                <div class="diff {{  $currencyRateService->isUpSaleRate('nbu', 'EUR') ? 'up':'down'}}">{{$currencyRateService->getSaleDifferenceRate('nbu', 'EUR')}}</div>
                                            </div>
                                        </div>
                                        <div class="table-kurs__row rub">
                                            <div class="col1">
                                                <div class="val"></div> <span class="currensy"> RUB </span>
                                            </div>
                                            <div class="col2">
                                                <div class="rate">{{$currencyRateService->getBuyRate('nbu', 'RUB')}} </div>
                                                <div class="diff {{  $currencyRateService->isUpBuyRate('nbu', 'RUB') ? 'up':'down'}}">{{$currencyRateService->getBuyDifferenceRate('nbu', 'RUB')}}</div>
                                            </div>
                                            <div class="col3">
                                                <div class="rate">{{$currencyRateService->getSaleRate('nbu', 'RUB')}} </div>
                                                <div class="diff {{  $currencyRateService->isUpSaleRate('nbu', 'RUB') ? 'up':'down'}}">{{$currencyRateService->getSaleDifferenceRate('nbu', 'RUB')}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mob-kurs" >
                                        {{--<a href="" class="all-valutes">
                                            Все валюты
                                        </a>--}}
                                        <div class="time" >
                                            22 минуты назад
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="privat_bank" class="kurs-val__table tab-content">
                                <div class="table-top">
                                    <div class="table-top__item col1">
                                        Валюта
                                    </div>
                                    <div class="table-top__item col2">
                                        Покупка
                                    </div>
                                    <div class="table-top__item col3">
                                        Продажа
                                    </div>
                                </div>
                                <div class="table-kurs">
                                    <div class="table-kurs__row usd">
                                        <div class="col1">
                                            <div class="val"> </div> <span class="currensy"> USD </span>
                                        </div>
                                        <div class="col2">
                                            <div class="rate">{{$currencyRateService->getBuyRate('privat_bank', 'USD')}} </div>
                                            <div class="diff {{  $currencyRateService->isUpBuyRate('privat_bank', 'USD') ? 'up':'down'}}">{{$currencyRateService->getBuyDifferenceRate('privat_bank', 'USD')}}</div>
                                        </div>
                                        <div class="col3">
                                            <div class="rate">{{$currencyRateService->getSaleRate('privat_bank', 'USD')}} </div>
                                            <div class="diff {{  $currencyRateService->isUpSaleRate('privat_bank', 'USD') ? 'up':'down'}}">{{$currencyRateService->getSaleDifferenceRate('privat_bank', 'USD')}}</div>
                                        </div>
                                    </div>
                                    <div class="all-kurs">
                                        <div class="table-kurs__row eur">
                                            <div class="col1">
                                                <div class="val"> </div> <span class="currensy"> EUR </span>
                                            </div>
                                            <div class="col2">
                                                <div class="rate">{{$currencyRateService->getBuyRate('privat_bank', 'EUR')}} </div>
                                                <div class="diff {{  $currencyRateService->isUpBuyRate('privat_bank', 'EUR') ? 'up':'down'}}">{{$currencyRateService->getBuyDifferenceRate('privat_bank', 'EUR')}}</div>
                                            </div>
                                            <div class="col3">
                                                <div class="rate">{{$currencyRateService->getSaleRate('privat_bank', 'EUR')}} </div>
                                                <div class="diff {{  $currencyRateService->isUpSaleRate('privat_bank', 'EUR') ? 'up':'down'}}">{{$currencyRateService->getSaleDifferenceRate('privat_bank', 'EUR')}}</div>
                                            </div>
                                        </div>
                                        <div class="table-kurs__row rub">
                                            <div class="col1">
                                                <div class="val"></div> <span class="currensy"> RUB </span>
                                            </div>
                                            <div class="col2">
                                                <div class="rate">{{$currencyRateService->getBuyRate('privat_bank', 'RUR')}} </div>
                                                <div class="diff {{  $currencyRateService->isUpBuyRate('privat_bank', 'RUR') ? 'up':'down'}}">{{$currencyRateService->getBuyDifferenceRate('privat_bank', 'RUR')}}</div>
                                            </div>
                                            <div class="col3">
                                                <div class="rate">{{$currencyRateService->getSaleRate('privat_bank', 'RUR')}} </div>
                                                <div class="diff {{  $currencyRateService->isUpSaleRate('privat_bank', 'RUR') ? 'up':'down'}}">{{$currencyRateService->getSaleDifferenceRate('privat_bank', 'RUR')}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mob-kurs">
                                        {{--<a href="" class="all-valutes">
                                            Все валюты
                                        </a>--}}
                                        <div class="time">
                                            22 минуты назад
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="sidebar-news">
                            <h6 class="sidebar-news__title">
                                Лента новостей
                            </h6>
                            <div class="sidebar-news__list white-box">
                                <h6 class="sidebar-news__title">
                                    Лента новостей
                                </h6>
                                <ul class="list-news__container">
                                    @if($finPosts->isNotEmpty())
                                        @foreach($finPosts as $finPost)
                                            <li class="list-news__container-item {{ $finPost->top ? 'font-weight-bold':''}} ">
                                                <span class="time">{{$finPost->public_date->format('H:i')}}</span>
                                                <a href="{{ route('page_news', ['slug' => $finPost->slug]) }}" class="list-title">{{$finPost->name}}</a>
                                            </li>
                                        @endforeach
                                    @endif

                                    <li class="list-news__container-item">
                                        <span class="time">16:20</span>
                                        <a href="" class="list-title">За несколько месяцев через е-кабинет застройщика ввели 1400 объектов - Федоров </a>
                                    </li>
                                </ul>
                                <a href="{{route('news')}}" class="load-more">
                                    Все новости
                                </a>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
