@extends('layouts.app')


@section('content')
    <div class="container container-page d-md-flex kredit-karta">
        <div class="col-xl-9 main-column contributions-page">
            <div class="content-wrap-item contributions-details-item">
                <ul class="breadcrumbs-list">
                    <li class="breadcrumbs-item"><a href="{{ route('home') }}" class="breadcrumbs-link "></a></li>
                    <li class="breadcrumbs-item"><a href="{{ route('products.cards.all')}}" class="breadcrumbs-link ">Кредитные Карты</a></li>
                    <li class="breadcrumbs-item">{{$creditCard->name}}</li>
                </ul>
                <h1 class="page-title">{{$creditCard->name}}</h1>
                <div class="row kredit-card-all">
                    <div class="col-md-4 kredit-card__img">
                        <div class="card-img">
                            <img class="img-fluid lazyload" data-src="{{$creditCard->getPrimary()->getUrl('thumb')}}" alt="{{$creditCard->getPrimaryAlt()}}" title="{{$creditCard->getPrimaryTitle()}}">
                        </div>
                        <ul class="device-list">
                            @if ($creditCard->chip)
                                <li class="chip" title="Chip"></li>
                            @endif
                            @if ($creditCard->pay_wave)
                                <li class="apple" title="PayWave"></li>
                            @endif
                            @if ($creditCard->visa)
                                <li class="visa" title="Visa"></li>
                            @endif
                            @if ($creditCard->master_card)
                                <li class="mastercard" title="MasterCard"></li>
                            @endif

                        </ul>
                    </div>
                    <div class="col-md-8 kredit-card__info">
                        <h4>
                            <a href="{{ route('banks.single', $creditCard->organization->slug) }}"><strong>{{$creditCard->organization->name}}</strong></a>
                        </h4>
                        <p>
                            <span>Стабильность банка: {{$creditCard->organization->rating}} из 100</span>
                        </p>
                        <div class="row kredit-card__infolist">
                            @if(!empty($creditCard->max_limit))
                                <div class="col-sm-12 col-md-4 kredit-card__item">
                                    <div class="sup">Кредитный лимит</div>
                                    <div class="value">@money($creditCard->max_limit)</div>
                                </div>
                            @endif

                            @if(!empty($creditCard->grace_period))
                                <div class="col-6 col-md-4 kredit-card__item">
                                    <div class="sup">Льготный период</div>
                                    <div class="value">До {{$creditCard->grace_period}} дней</div>
                                </div>
                            @endif

                            @if(!empty($creditCard->service))
                                <div class="col-6 col-md-4 kredit-card__item">
                                    <div class="sup">Обслуживание</div>
                                    <div class="value">{{$creditCard->service}}</div>
                                </div>
                            @endif

                        </div>
                        <ul class="kredit-card__advantages">
                            @if ($advantages = $creditCard->getMetas('advantage'))
                                @foreach ($advantages as $advantage)
                                    <li>{{$advantage->meta_value}}</li>
                                @endforeach
                            @endif
                        </ul>
                        <div class="row card-butt">
                            <div class="col d-sm-flex align-items-center ">
                                <button class="yellBtn add-btn" onclick="window.open('{{$creditCard->ref_link}}');" >Заказать карту</button>
                                <!-- <a class="card-question"href="">Узнать, дадут ли мне</a> -->
                            </div>
                        </div>
                    </div>

                    @if(!empty($creditCard->preview))
                        <div class="row kredit-card__descr">
                            <p>{{$creditCard->preview}}</p>
                        </div>
                    @endif

                </div>


            </div>

            <h4 class="py-2">Описание</h4>
            <div class="content-wrap-item contributions-details-list">
                <div class="row contributions-details-list-row">
                    <div class="col-md-5 contributions-details-list-item">Платежная система</div>
                    <div class="col-md-7 contributions-details-list-item">
                        @if ($creditCard->master_card )
                            Master Card
                        @elseif ($creditCard->visa)
                            VISA
                        @endif
                    </div>
                </div>
                @if ($creditCard->currency)
                    <div class="row contributions-details-list-row">
                        <div class="col-md-5 contributions-details-list-item">Валюта</div>
                        <div class="col-md-7 contributions-details-list-item">{{$creditCard->currency}}</div>
                    </div>
                @endif
                @if ($creditCard->max_limit)
                    <div class="row contributions-details-list-row">
                        <div class="col-md-5 contributions-details-list-item">Кредитный лимит</div>
                        <div class="col-md-7 contributions-details-list-item">@money($creditCard->max_limit)</div>
                    </div>
                @endif
                @if ($creditCard->rate_in)
                    <div class="row contributions-details-list-row">
                        <div class="col-md-5 contributions-details-list-item">Процентная ставка во время льготного периода</div>
                        <div class="col-md-7 contributions-details-list-item">@percent($creditCard->rate_in)</div>
                    </div>
                @endif
                @if ($creditCard->rate_after)
                    <div class="row contributions-details-list-row">
                        <div class="col-md-5 contributions-details-list-item">Процентная ставка после льготного периода</div>
                        <div class="col-md-7 contributions-details-list-item">@percent($creditCard->rate_after)</div>
                    </div>
                @endif
                @if ($creditCard->grace_period)
                    <div class="row contributions-details-list-row">
                        <div class="col-md-5 contributions-details-list-item">Льготный период</div>
                        <div class="col-md-7 contributions-details-list-item">до {{$creditCard->grace_period}} дней</div>
                    </div>
                @endif
                @if ($creditCard->service)
                    <div class="row contributions-details-list-row">
                        <div class="col-md-5 contributions-details-list-item">Плата за обслуживание</div>
                        <div class="col-md-7 contributions-details-list-item">{{$creditCard->service}}</div>
                    </div>
                @endif

            </div>

            <h4 class="py-2">Преимущества</h4>
            <div class="content-wrap-item contributions-details-list">
                @if ($advantages->isNotEmpty())
                    <div class="row contributions-details-list-row">
                        <div class="col-md-5 contributions-details-list-item">Дополнительные особенности</div>
                        <div class="col-md-7 contributions-details-list-item">{{$advantages->shift()->meta_value}}</div>
                    </div>
                    @foreach ($advantages as $advantage)
                        <div class="row contributions-details-list-row">
                            <div class="col-md-5 contributions-details-list-item"></div>
                            <div class="col-md-7 contributions-details-list-item">{{$advantage->meta_value}}</div>
                        </div>
                    @endforeach

                @endif


                @if ($creditCard->cash_back)
                    <div class="row contributions-details-list-row">
                        <div class="col-md-5 contributions-details-list-item">Кешбек</div>
                        <div class="col-md-7 contributions-details-list-item">@percent($creditCard->cash_back)</div>
                    </div>
                @endif
                @if ($creditCard->loan)
                    <div class="row contributions-details-list-row">
                        <div class="col-md-5 contributions-details-list-item">Рассрочка</div>
                        <div class="col-md-7 contributions-details-list-item">на {{$creditCard->loan}} мес.</div>
                    </div>
                @endif

            </div>

            <h4 class="py-2">Условия</h4>
            <div class="content-wrap-item contributions-details-list">

                @if ($creditCard->min_age && $creditCard->max_age)
                    <div class="row contributions-details-list">
                        <div class="col-md-5 contributions-details-list-item">Возраст</div>
                        <div class="col-md-7 contributions-details-list-item">от {{$creditCard->min_age}} до {{$creditCard->max_age}} лет</div>
                    </div>
                @endif
                @if ($creditCard->list_documents)
                    <div class="row contributions-details-list-row">
                        <div class="col-md-5 contributions-details-list-item">Перечень документов и условий</div>
                        <div class="col-md-7 contributions-details-list-item">{{$creditCard->list_documents}}</div>
                    </div>
                @endif
                @if ($creditCard->terms_repayment)
                    <div class="row contributions-details-list-row">
                        <div class="col-md-5 contributions-details-list-item">Условия погашения задолженности</div>
                        <div class="col-md-7 contributions-details-list-item">{{$creditCard->terms_repayment}}</div>
                    </div>
                @endif
                @if ($creditCard->fines_penalties)
                    <div class="row contributions-details-list-row">
                        <div class="col-md-5 contributions-details-list-item">Штрафы и пеня за просрочку</div>
                        <div class="col-md-7 contributions-details-list-item">{{$creditCard->fines_penalties}}</div>
                    </div>
                @endif
                @if ($creditCard->insurance)
                    <div class="row contributions-details-list-row">
                        <div class="col-md-5 contributions-details-list-item">Страхование</div>
                        <div class="col-md-7 contributions-details-list-item">{{$creditCard->insurance}}</div>
                    </div>
                @endif

            </div>
            <section class="users-reviews-container content-wrap-item credit-cards-comments">
                @include('front.partials.comments', [
                    'model' => $creditCard,
                    'comments' => $creditCard->comments()->public()->get(),
                    'type'  => get_class($creditCard),
                ])
            </section>
        </div>

        @include('front.partials.sidebar_credit_card')
    </div>
@endsection
