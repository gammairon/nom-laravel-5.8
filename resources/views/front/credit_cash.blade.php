@extends('layouts.app')


@section('content')
    <div class="container container-page d-md-flex kredit-nal">
        <div class="col-xl-9 main-column contributions-page">
            <div class="content-wrap-item contributions-details-item">
                <ul class="breadcrumbs-list">
                    <li class="breadcrumbs-item"><a href="{{ route('home') }}" class="breadcrumbs-link "></a></li>
                    <li class="breadcrumbs-item"><a href="{{ route('products.cash.all')}}" class="breadcrumbs-link ">Кредиты Наличными</a></li>
                    <li class="breadcrumbs-item">{{$creditCash->name}}</li>
                </ul>
                <h1 class="page-title">{{$creditCash->name}}</h1>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h4 class="bank-name">
                            <a href="{{ route('banks.single', $creditCash->organization->slug) }}">{{$creditCash->organization->name}}</a>
                        </h4>
                    </div>
                    <div class="col-6 col-md-4 d-md-flex justify-content-end contributions-details-text-wrap">
                        <!-- <a href="#reviews" class="contributions-details-text reviews-link">Отзывы</a>
                        <span class="contributions-details-text col-reviews">6</span> -->
                    </div>
                    <div class="col-6 col-md-2 d-md-flex justify-content-end">
                        <div class="bank-logo">
                            <div class="img-wrap">
                                <a href="{{ route('banks.single', $creditCash->organization->slug) }}">
                                    <img class="lazyload" data-src="{{$creditCash->organization->getPrimary()->getUrl('thumb')}}" alt="{{$creditCash->organization->getPrimaryAlt()}}" title="{{$creditCash->organization->getPrimaryTitle()}}">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-wrap-item contributions-details-list">
                @if(!empty($creditCash->min_term) && !empty($creditCash->max_term))
                    <div class="row contributions-details-list">
                        <div class="col-md-5 contributions-details-list-item">Срок</div>
                        <div class="col-md-7 contributions-details-list-item">От {{$creditCash->min_term}} мес. до {{$creditCash->max_term}} мес.</div>
                    </div>
                @endif

                @if(!empty($creditCash->min_amount) && !empty($creditCash->max_amount))
                    <div class="row contributions-details-list-row">
                        <div class="col-md-5 contributions-details-list-item">Сумма</div>
                        <div class="col-md-7 contributions-details-list-item">Oт @intNumber($creditCash->min_amount) до @money($creditCash->max_amount)</div>
                    </div>
                @endif

                @if(!empty($creditCash->income_max_amount))
                    <div class="row contributions-details-list-row">
                        <div class="col-md-5 contributions-details-list-item">Максимальная сумма без справки о доходах</div>
                        <div class="col-md-7 contributions-details-list-item">@money($creditCash->income_max_amount)</div>
                    </div>
                @endif


                <div class="row contributions-details-list-row">
                    <div class="col-md-5 contributions-details-list-item">Процентная ставка*</div>
                    <div class="col-md-7 contributions-details-list-item"></div>
                </div>
                @if(!empty($creditCash->percent_new_individual))
                    <div class="row contributions-details-list-row">
                        <div class="col-md-5 contributions-details-list-item">-Новым клиентам: физ. лицу</div>
                        <div class="col-md-7 contributions-details-list-item">@percent($creditCash->percent_new_individual)</div>
                    </div>
                @endif

                @if(!empty($creditCash->percent_new_legal))
                    <div class="row contributions-details-list-row">
                        <div class="col-md-5 contributions-details-list-item">-Новым клиентам: ФОП</div>
                        <div class="col-md-7 contributions-details-list-item">@percent($creditCash->percent_new_legal)</div>
                    </div>
                @endif

                @if(!empty($creditCash->percent_client))
                    <div class="row contributions-details-list-row">
                        <div class="col-md-5 contributions-details-list-item">-Клиенты банка</div>
                        <div class="col-md-7 contributions-details-list-item">@percent($creditCash->percent_client)</div>
                    </div>
                @endif


                <div class="row contributions-details-list-row">
                    <div class="col-md-5 contributions-details-list-item">Документы*</div>
                    <div class="col-md-7 contributions-details-list-item"></div>
                </div>
                @if(!empty($creditCash->docs_legal))
                    <div class="row contributions-details-list-row">
                        <div class="col-md-5 contributions-details-list-item">-для ФОП</div>
                        <div class="col-md-7 contributions-details-list-item">{{$creditCash->docs_legal}}</div>
                    </div>
                @endif

                @if(!empty($creditCash->docs_individual))
                    <div class="row contributions-details-list-row">
                        <div class="col-md-5 contributions-details-list-item">-для физ.лица</div>
                        <div class="col-md-7 contributions-details-list-item">{{$creditCash->docs_individual}}</div>
                    </div>
                @endif

                @if(!empty($creditCash->experience))
                    <div class="row contributions-details-list-row">
                        <div class="col-md-5 contributions-details-list-item">Стаж</div>
                        <div class="col-md-7 contributions-details-list-item">{{$creditCash->experience}}</div>
                    </div>
                @endif

                <div class="row contributions-details-list-row">
                    <div class="col-12 d-flex align-items-center justify-content-center contributions-details-list-item">
                        <button onclick="window.open('{{$creditCash->ref_link}}');" class="yellBtn add-btn">Онлайн заявка</button>
                    </div>
                </div>
            </div>

            <section class="users-reviews-container content-wrap-item credit-cash-comments">
                @include('front.partials.comments', [
                    'model' => $creditCash,
                    'comments' => $creditCash->comments()->public()->get(),
                    'type'  => get_class($creditCash),
                ])
            </section>
        </div>


        @include('front.partials.sidebar_credit_cash')

    </div>


@endsection
