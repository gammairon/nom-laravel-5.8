@extends('layouts.app')



@section('content')
    <div class="container container-page d-md-flex page-bank-detail">
        <div class="col-xl-9 main-column contributions-page">
            <div class="content-wrap-item contributions-details-item">
                <ul class="breadcrumbs-list">
                    <li class="breadcrumbs-item"><a href="{{ route('home') }}" class="breadcrumbs-link "></a></li>
                    <li class="breadcrumbs-item"><a href="{{ route('banks.all')}}" class="breadcrumbs-link ">Банки</a></li>
                    <li class="breadcrumbs-item">{{$bank->name}}</li>
                </ul>
                <div class="row bank-info">
                    <div class="col-12 col-lg-3 d-flex justify-content-center justify-content-lg-start">
                        <div class="logo-bank">
                            <img class="lazyload" data-src="{{$bank->getPrimary()->getUrl('thumb')}}" alt="{{$bank->getPrimaryAlt()}}" title="{{$bank->getPrimaryTitle()}}">
                        </div>
                    </div>
                    <div class="col-lg-9 col-12 d-flex justify-content-center justify-content-lg-start bank-title">
                        <h1>{{$bank->name}}</h1>
                    </div>
                </div>
                <div class="row bank-info-detail">
                    <div class="col-12 col-lg-3 d-flex justify-content-center justify-content-lg-start">
                        <div class="row d-flex flex-column">
                            <!-- <div class="d-flex dv-star-rating justify-content-center justify-content-lg-start">

                            </div> Rating-->
                            <div class="people-rating">Народный рейтинг <span>{{$bank->rating}}</span> из 100
                            </div>
                            <div class="bank-info__phone d-flex justify-content-center justify-content-lg-start">{{$bank->phone}}</div>
                            <div class="bank-info__website d-flex justify-content-center justify-content-lg-start"><a href="{{$bank->web_site}}" rel="nofollow" target="_blank">{{$bank->web_site}}</a></div>
                            <div class="bank-info__comments d-flex justify-content-center justify-content-lg-start"><i class="fa fa-comments" aria-hidden="true"></i><a href="#comments">Отзывы о компании</a></div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-9 d-flex flex-column justify-content-center justify-content-lg-start mt-5 mt-lg-1 bank-person mx-auto">
                        <div class="d-flex flex-row bank-person__about">
                            <div class="bank-person__item">
                                <img class="lazyload" data-src="{{$bank->getPrimary(\App\Entity\Organization\Bank::PRESIDENT_PHOTO)->getUrl('thumb')}}" alt="{{$bank->getPrimaryAlt(\App\Entity\Organization\Bank::PRESIDENT_PHOTO)}}" title="{{$bank->getPrimaryTitle(\App\Entity\Organization\Bank::PRESIDENT_PHOTO)}}">
                            </div>
                            <div class="bank-person__item d-flex flex-column">
                                <div class="bank-person__position">Председатель правления</div>
                                <div class="bank-person__name">{{$bank->president_name}}</div>
                            </div>
                        </div>
                        <div class="bank-person__desc">
                            <p>{{$bank->preview}}</p>
                        </div>

                    </div>
                </div>

                <div class="row contact-info mx-auto">
                    <div class="col-12">
                        <h2>Контактные данные</h2>

                        @if(!empty($bank->head_office))
                            <div class="row paragraph">
                                <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                    <span class="strong-lg">Главный офис:</span>
                                </div>
                                <div class="col-12 col-sm-8 col-md-12 col-lg-8">{{$bank->head_office}}</div>
                            </div>
                        @endif


                        @if(!empty($bank->phone))
                            <div class="row paragraph">
                                <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                    <span class="strong-lg">Телефон:</span>
                                </div>
                                <div class="col-12 col-sm-8 col-md-12 col-lg-8"> {{$bank->phone}}</div>
                            </div>
                        @endif


                        @if(!empty($bank->email))
                            <div class="row paragraph">
                                <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                    <span class="strong-lg">E-mail:</span>
                                </div>
                                <div class="col-12 col-sm-8 col-md-12 col-lg-8"><a href="mailto:{{$bank->email}}" rel="nofollow">{{$bank->email}}</a></div>
                            </div>
                        @endif


                        @if(!empty($bank->web_site))
                            <div class="row paragraph">
                                <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                    <span class="strong-lg">Веб-сайт</span>
                                </div>
                                <div class="col-12 col-sm-8 col-md-12 col-lg-8"><a href="{{$bank->web_site}}" rel="nofollow" target="_blank">{{$bank->web_site}}</a></div>
                            </div>
                        @endif


                        @if(!empty($bank->mfo))
                            <div class="row paragraph">
                                <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                    <span class="strong-lg">МФО:</span>
                                </div>
                                <div class="col-12 col-sm-8 col-md-12 col-lg-8">{{$bank->mfo}}</div>
                            </div>
                        @endif


                        @if(!empty($bank->egrdpou))
                            <div class="row paragraph">
                                <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                    <span class="strong-lg">ЕГРПО:</span>
                                </div>
                                <div class="col-12 col-sm-8 col-md-12 col-lg-8"> {{$bank->egrdpou}}</div>
                            </div>
                        @endif


                        @if(!empty($bank->date_reg))
                            <div class="row paragraph">
                                <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                    <span class="strong-lg">Дата регистрации банка:</span>
                                </div>
                                <div class="col-12 col-sm-8 col-md-12 col-lg-8">{{$bank->date_reg->format('d/m/Y')}}</div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
            <!-- <section class="content-wrap-item contributions-details-item news-list">
                <h2>Новости</h2>
                <a href="#"><div class="fin-news d-flex flex-column mb-2">
                        <div class="fin-news__title">ПУМБ сообщает об изменении в составе Правления</div>
                        <div class="fin-news__date-time"><span class="date">04 июня 2019 </span> - <span class="time">05:30</span></div>
                    </div></a>
                <a href="#"><div class="fin-news d-flex flex-column mb-2">
                        <div class="fin-news__title">Изменения с 01.07.2019 для карт MasterCard Platinum Альфа-Банк</div>
                        <div class="fin-news__date-time"><span class="date">04 июня 2019 </span> - <span class="time">05:30</span></div>
                    </div></a>
                <a href="#"><div class="fin-news d-flex flex-column mb-2">
                        <div class="fin-news__title">В мае СГ "ТАС" привлекла более 133 млн грн платежей</div>
                        <div class="fin-news__date-time"><span class="date">04 июня 2019 </span> - <span class="time">05:30</span></div>
                    </div></a>
            </section> -->
            @if(!empty($bank->description))
                <section class="content-wrap-item contributions-details-item content-part">
                    {!!$bank->description!!}
                </section>
            @endif


            <section class="users-reviews-container content-wrap-item bank-comments">
                @include('front.partials.comments', [
                        'model' => $bank,
                        'comments' => $bank->comments()->public()->get(),
                        'type'  => get_class($bank),
                    ])
            </section>
        </div>
        @include('front.partials.sidebar_bank')
    </div>
@endsection
