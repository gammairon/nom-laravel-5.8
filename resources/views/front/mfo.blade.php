@extends('layouts.app')



@section('content')

<div class="container container-page d-md-flex page-product">
    <div class="col-xl-9 main-column contributions-page">
        <div class="content-wrap-item contributions-details-item">
            <div class="row mfo__show-head ">
                <div class="col-lg-8 col-md-8 col-sm-10 col-xs-10">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-item"><a href="{{route('home')}}" class="breadcrumbs-link "></a></li>
                        <li class="breadcrumbs-item"><a href="{{ route('mfo.all')}}" class="breadcrumbs-link ">Все МФО</a></li>
                        <li class="breadcrumbs-item">{{$mfo->name}}</li>
                    </ul>
                    <h1 class="page-title">{{$mfo->name}}</h1>
                </div>
                <div class="col-lg-4 col-md-4 col-2">
                    <a href="#" data-href="{{$mfo->ref_link}}" class="btn btn-block btn-outline-warning hidden-xs redirect">Перейти на сайт</a>
                </div>
            </div>
            <div class="row">
                <div class="col  logo-container">
                    <div class="row d-flex justify-content-center">
                        <div class="mfo-logo-div">
                            <img class="lazyload mfo_logo" data-src="{{$mfo->getPrimary()->getUrl('thumb')}}" alt="{{$mfo->getPrimaryAlt()}}" title="{{$mfo->getPrimaryTitle()}}" width="300" height="121">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mx-auto">
                        <div class="dv-star-rating">

                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mx-auto mt-3">
                        <span class="mfo-paytype" data-content="Онлайн выдача"></span>
                    </div>
                </div>
                <div class="col-lg-10 col-md-9 col-12">
                    <div class="mfo-descr">{{$mfo->preview}}</div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="separate hidden-xs"></div>
                        <h2>Расчет по кредиту</h2>
                        <div class="credit-calculator">
                            <div class="row credit-calculator-init">
                                <div class="col-lg-5 col-12">
                                    <div class="form-group material__inputs">
                                        <input type="text" class="material__input amount" placeholder="Введите сумму" value="{{intVal($mfo->min_amount)}} грн.">
                                        <span class="bar"></span>
                                        <label>Сумма</label>
                                        <div class="ui-slider">
                                            <input type="text" class="slider amount" data-slider-min="{{$mfo->min_amount}}" data-slider-max="{{$mfo->max_amount}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-12">
                                    <div class="form-group material__inputs">
                                        <input type="text" class="material__input days" placeholder="Введите срок" value="{{$mfo->min_term}} дней">
                                        <span class="bar"></span>
                                        <label>Срок</label>
                                        <div class="ui-slider">
                                            <input type="text" class="slider days" data-slider-min="{{$mfo->min_term}}" data-slider-max="{{$mfo->max_term}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12 col-xs-12 calc_btn">
                                    <a href="#" data-href="{{$mfo->ref_link}}" class="ui-button yellBtn redirect">Оформить</a>
                                </div>
                            </div>
                            <div class="row credit-calculator-result">
                                <div class="col-12">
                                    <div class="row calc-result first_credit">
                                        <div class="col-lg-3 col-md-3 col-12 calc-item ">
                                            <p class="visible-xs">Первый займ</p>
                                            <div class="sup hidden-xs">Займ</div>
                                            <div class="sub hidden-xs">Первый</div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-4 calc-item">
                                            <div class="sup">Ставка</div>
                                            <div class="sub"><span>{{$mfo->free_credit_bid}}</span> %</div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-4 calc-item">
                                            <div class="sup">Переплата</div>
                                            <div class="sub"><strong><span class="overpayment">{{($mfo->min_amount * $mfo->free_credit_bid * $mfo->min_term)/100}}</span> грн.</strong></div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-4 calc-item">
                                            <div class="sup">К возврату</div>
                                            <div class="sub"><span class="to_return">{{($mfo->min_amount * $mfo->free_credit_bid * $mfo->min_term)/100 + $mfo->min_amount}}</span> грн.</div>
                                        </div>
                                    </div>
                                    <div class="separate hidden-xs"></div>
                                    <div class="row calc-result repeat_credit">
                                        <div class="col-lg-3 col-md-3 col-12 calc-item ">
                                            <p class="visible-xs">Повторный займ</p>
                                            <div class="sup hidden-xs">Займ</div>
                                            <div class="sub hidden-xs">Повторный</div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-4 calc-item">
                                            <div class="sup">Ставка</div>
                                            <div class="sub"><span>{{$mfo->repeat_credit_bid}}</span> %</div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-4 calc-item">
                                            <div class="sup">Переплата</div>
                                            <div class="sub"><strong><span class="overpayment">{{($mfo->min_amount * $mfo->repeat_credit_bid * $mfo->min_term)/100}}</span> грн.</strong></div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-4 calc-item">
                                            <div class="sup">К возврату</div>
                                            <div class="sub"><span class="to_return">{{($mfo->min_amount * $mfo->repeat_credit_bid * $mfo->min_term)/100  + $mfo->min_amount}}</span> грн.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            var free_credit_bid = {{$mfo->free_credit_bid}};
                            var repeat_credit_bid = {{$mfo->repeat_credit_bid}};
                            var first_credit_amount = {{$mfo->first_credit}};
                        </script>
                        <!-- <a role="button" data-toggle="collapse" href="#collapseCalc" aria-expanded="false" class="ui-button-link" aria-controls="collapseExample">
                            <span>Как проводится расчет</span>
                            <i class="hico hico_info2x" data-html="true" data-toggle="popover" data-trigger="hover" data-content="Пример расчёта переплаты без учёта скидок и акций" data-container="body" style="line-height: 1.6; margin-left: 5px;" data-original-title="" title="">
                            </i>
                        </a>
                        <div class="collapseBox collapse" id="collapseCalc">
                            <div style="opacity: 1;"><p><strong>Первый кредит</strong></p>Сумма кредита <span>300</span> грн. срок <span>7</span> дней, погашение по истечению срока кредита. Процентная ставка <span>0.01</span> % в сутки. Сумма начисленных процентов (переплата) составит <span>0.21</span> грн. Общая сумма, которую необходимо погасить, составит <span>300</span> грн, что равняется <span>3.65</span>% годовых.
                            </div>
                            <br>
                            <div><p><strong>Повторный кредит</strong></p>Сумма кредита <span>300</span> грн. срок <span>7</span> дней, погашение по истечению срока кредита. Процентная ставка <span>0.49</span> % в сутки. Сумма начисленных процентов (переплата) составит <span>10.29</span> грн. Общая сумма, которую необходимо погасить, составит <span>310</span> грн, что равняется <span>178.85</span>% годовых.
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="content-wrap-item contributions-details-item">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Условия и описание</h2>

                    @if(!empty($mfo->time_review))
                        <div class="row paragraph">
                            <div class="col-12 col-lg-4">
                                <span class="strong-lg">Рассмотрение заявки</span>
                                <i class="hico" ></i>
                            </div>
                            <div class="col-lg-8 col-12">{{$mfo->time_review}} мин</div>
                        </div>
                    @endif

                    @if(!empty($mfo->first_credit))
                        <div class="row paragraph">
                            <div class="col-12 col-lg-4">
                                <span class="strong-lg">Первый кредит</span>
                                <i class="hico" data-content=""></i>
                            </div>
                            <div class="col-lg-8 col-12">@money($mfo->first_credit)</div>
                        </div>
                    @endif

                    @if(!empty($mfo->min_amount) && !empty($mfo->max_amount))
                        <div class="row paragraph">
                            <div class="col-12 col-lg-4">
                                <span class="strong-lg">Сумма займа</span>
                                <i class="hico" ></i>
                            </div>
                            <div class="col-lg-8 col-12">от @intNumber($mfo->min_amount) до @money($mfo->max_amount)</div>
                        </div>
                    @endif


                    @if(!empty($mfo->free_credit_bid))
                        <div class="row paragraph">
                            <div class="col-12 col-lg-4">
                                <span class="strong-lg">Беспроцентный кредит</span>
                                <i class="hico" ></i>
                            </div>
                            <div class="col-lg-8 col-12">@percent($mfo->free_credit_bid) в день</div>
                        </div>
                    @endif


                    @if(!empty($mfo->repeat_credit_bid))
                        <div class="row paragraph">
                            <div class="col-12 col-lg-4">
                                <span class="strong-lg">Ставка для повторного займа</span>
                                <i class="hico" ></i>
                            </div>
                            <div class="col-lg-8 col-12">от @percent($mfo->repeat_credit_bid)</div>
                        </div>
                    @endif


                    @if(!empty($mfo->min_term) && !empty($mfo->max_term))
                        <div class="row paragraph">
                            <div class="col-12 col-lg-4">
                                <span class="strong-lg">Срок</span>
                                <i class="hico" ></i>
                            </div>
                            <div class="col-lg-8 col-12">от @intNumber($mfo->min_term) до @intNumber($mfo->max_term) дней</div>
                        </div>
                    @endif


                    @if(!empty($mfo->min_age) && !empty($mfo->max_age))
                        <div class="row paragraph">
                            <div class="col-12 col-lg-4">
                                <span class="strong-lg">Возраст</span>
                                <i class="hico" ></i>
                            </div>
                            <div class="col-lg-8 col-12">от @intNumber($mfo->min_age) до @intNumber($mfo->max_age) лет</div>
                        </div>
                    @endif


                    @if(!empty($mfo->receiving_method_card) || !empty($mfo->receiving_method_cash))
                        <div class="row paragraph">
                            <div class="col-12 col-lg-4">
                                <span class="strong-lg">Способ получения</span>
                                <i class="hico" ></i>
                            </div>
                            <div class="col-lg-8 col-12">
                                {{$mfo->receiving_method_card ? 'на карту':''}}
                                {{$mfo->receiving_method_cash ? ', наличными':''}}
                            </div>
                        </div>
                    @endif


                    @if(!empty($mfo->special_offer))
                        <div class="row paragraph">
                            <div class="col-12 col-lg-4">
                                <span class="strong-lg">Специальное предложение</span>
                                <i class="hico" ></i>
                            </div>
                            <div class="col-lg-8 col-12">{{$mfo->special_offer}}</div>
                        </div>
                    @endif


                    <div class="row paragraph">
                        <div class="col-12 col-lg-4">
                            <span class="strong-lg">Контакты</span>
                            <i class="hico" ></i>
                        </div>
                        <div class="col-lg-8 col-12"></div>
                    </div>


                    @if(!empty($mfo->web_site))
                        <div class="row paragraph">
                            <div class="col-12 col-lg-4">
                                <span class="strong-lg">Сайт</span>
                                <i class="hico" ></i>
                            </div>
                            <div class="col-lg-8 col-12" ><a href="#" class="btn_ref_link redirect" data-href="{{$mfo->ref_link}}">{{$mfo->web_site}}</a> </div>
                        </div>
                    @endif



                    @php
                        $phones = explode(';', $mfo->phone);
                    @endphp
                    @if(!empty($phones))
                        <div class="row paragraph">
                            <div class="col-12 col-lg-4">
                                <span class="strong-lg">Телефоны</span>
                                <i class="hico" ></i>
                            </div>
                            <div class="col-lg-8 col-12">
                                @foreach($phones as $phone)
                                    {{$phone }}
                                    <br/>
                                @endforeach
                            </div>
                        </div>
                    @endif


                    @if(!empty($mfo->email))
                        <div class="row paragraph">
                            <div class="col-12 col-lg-4">
                                <span class="strong-lg">Почта</span>
                                <i class="hico" ></i>
                            </div>
                            <div class="col-lg-8 col-12">{{$mfo->email}}</div>
                        </div>
                    @endif


                    @if(!empty($mfo->address))
                        <div class="row paragraph">
                            <div class="col-12 col-lg-4">
                                <span class="strong-lg">Адрес</span>
                                <i class="hico" ></i>
                            </div>
                            <div class="col-lg-8 col-12">{{$mfo->address}}</div>
                        </div>
                    @endif


                    @if(!empty($mfo->work_time))
                        <div class="row paragraph">
                            <div class="col-12 col-lg-4">
                                <span class="strong-lg">Время работы поддержки</span>
                                <i class="hico" ></i>
                            </div>
                            <div class="col-lg-8 col-12">{!! str_replace(';', '<br/>', $mfo->work_time) !!}</div>
                        </div>
                    @endif

                    @if(!empty($mfo->nfs_license))
                        <div class="row paragraph">
                            <div class="col-12 col-lg-4">
                                <span class="strong-lg">Лицензия Нацкомфинуслуг</span>
                                <i class="hico" ></i>
                            </div>
                            <div class="col-lg-8 col-12">{{$mfo->nfs_license}}</div>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        @if(!empty($mfo->free_credit_description))
            <div class="content-wrap-item contributions-details-item">
                {!! $mfo->free_credit_description !!}
            </div>
        @endif


        <section class="users-reviews-container content-wrap-item mfo-comments">
            @include('front.partials.comments', [
                'model' => $mfo,
                'comments' => $mfo->comments()->public()->get(),
                'type'  => get_class($mfo),
            ])
        </section>

    </div>

    @include('front.partials.sidebar_mfo')
</div>
@endsection
