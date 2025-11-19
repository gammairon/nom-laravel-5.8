@if ($banks->isNotEmpty())

@foreach ($banks as $bank)
    @continue($bank->creditsCard->isEmpty())

    @php
        $firstCreditCard = $bank->creditsCard->shift();
    @endphp
    <div class="content-wrap-item contributions-details-item">

        <div class="row kredit-card-product">
            <div class="row kredit-card-product__top w-100">
                <h4 class="d-md-none">
                    <a href="{{ route('banks.single', ['slug' => $bank->slug]) }}"><strong>{{$bank->name}}</strong></a>
                </h4>
                <div class="col-12 kredit-card__info-name d-md-none mb-3">
                    <a href="{{ route('products.cards.single', ['slug' => $firstCreditCard->slug]) }}">
                        {{$firstCreditCard->name}}
                    </a>
                </div>
                <div class="col-12 col-md-3 kredit-card__img">
                    <div class="card-img">
                        <img class="img-fluid lazyload" data-src="{{$firstCreditCard->getPrimary()->getUrl('thumb')}}" alt="{{$firstCreditCard->getPrimaryAlt()}}" title="{{$firstCreditCard->getPrimaryTitle()}}">
                        <!-- <div class="card-tag">Word</div> -->
                    </div>
                    <ul class="device-list mb-2">
                        @if ($firstCreditCard->chip)
                            <li class="chip" title="Chip"></li>
                        @endif
                        @if ($firstCreditCard->pay_wave)
                            <li class="apple" title="PayWave"></li>
                        @endif
                        @if ($firstCreditCard->visa)
                            <li class="visa" title="Visa"></li>
                        @endif
                        @if ($firstCreditCard->master_card)
                            <li class="mastercard" title="MasterCard"></li>
                        @endif
                    </ul>
                </div>
                <div class="col-12 col-md-3 d-sm-flex flex-column justify-content-between d-md-none">
                    <div class="row card-butt">
                        <div class="col d-md-flex align-items-center justify-content-end">
                            <button class="yellBtn add-btn pb-2 pt-2" onclick="window.open('{{$firstCreditCard->ref_link}}');" >Заказать карту</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 kredit-card__info">
                    <h4 class="d-none d-md-block">
                        <a href="{{ route('banks.single', ['slug' => $bank->slug]) }}"><strong>{{$bank->name}}</strong></a>
                    </h4>
                    <div class="kredit-card__info-name d-none d-md-block">
                        <a href="{{ route('products.cards.single', ['slug' => $firstCreditCard->slug]) }}">
                            {{$firstCreditCard->name}}
                        </a>
                    </div>
                    <ul class="kredit-card__advantages">
                        @if ($advantages = $firstCreditCard->getMetas('advantage'))
                            @foreach ($advantages as $advantage)
                                <li>{{$advantage->meta_value}}</li>
                            @endforeach
                        @endif
                    </ul>
                    <a href="{{ route('products.cards.single', ['slug' => $firstCreditCard->slug]) }}" class="card-more" >Подробнее о карте</a>
                </div>
                <div class="col-md-3 d-sm-flex flex-column justify-content-between">
                    <div class="row card-butt">
                        <div class="col d-md-flex align-items-center justify-content-end d-none">
                            <button class="yellBtn add-btn" onclick="window.open('{{$firstCreditCard->ref_link}}');" >Заказать карту</button>
                        </div>
                    </div>
                    @if ($bank->creditsCard->isNotEmpty())
                        <div class="row">
                            <button class="col d-none d-md-block align-items-center justify-content-end another-card">
                                <span><i class="fa fa-angle-down"></i><span>Еще {{$bank->creditsCard->count()}} карт(а)</span></span>
                                <span class="hidden"><i class="fa fa-angle-up "></i><span>Скрыть карты</span></span>
                            </button>
                        </div>
                     @endif
                </div>

            </div>
            <div class="row kredit-card-product__bottom justify-content-between w-100">
                <div class="row w-100">
                    <div class="col-12 col-sm-3 kredit-card__item d-flex justify-content-between d-sm-block">
                        <div class="sup" data-title="Максимальная сумма кредита">Кредитный лимит</div>
                        <div class="value">@money($firstCreditCard->max_limit)</div>
                    </div>
                    <div class="col-12 col-sm-3 kredit-card__item d-flex justify-content-between d-sm-block">
                        <div class="sup" data-title="Максимальная сумма кредита без подтверждения дохода">Лимит без справки</div>
                        <div class="value">До @money($firstCreditCard->income_max_limit)</div>
                    </div>
                    <div class="col-12 col-sm-3 kredit-card__item d-flex justify-content-between d-sm-block">
                        <div class="sup" data-title="Период бесплатного использования средств (без начисления процентов)">Льготный период</div>
                        <div class="value">До {{$firstCreditCard->grace_period}} дн.</div>
                    </div>
                    <div class="col-12 col-sm-3 kredit-card__item d-flex justify-content-between d-sm-block">
                        <div class="sup" data-title="Включает стоимость выпуска и обслуживания карты за первый год, при отсутствии задолженности">Обслуживание</div>
                        <div class="value">{{$firstCreditCard->service}}</div>
                    </div>
                </div>
                <div class="row btn-mob d-md-none">
                    <a class="col-6 card-more" href="{{ route('products.cards.single', ['slug' => $firstCreditCard->slug]) }}">Подробнее <span>о карте</span></a>
                    @if ($bank->creditsCard->isNotEmpty())
                        <div class="row">
                            <button class="col d-none d-md-block align-items-center justify-content-end another-card">
                                <span><i class="fa fa-angle-down"></i><span>Еще {{$bank->creditsCard->count()}} карт(а)</span></span>
                                <span class="hidden"><i class="fa fa-angle-up "></i><span>Скрыть карты</span></span>
                            </button>
                        </div>
                     @endif
                </div>
            </div>
        </div>
        @if ($bank->creditsCard->isNotEmpty())
            <!--Скрытые карты-->
            <div class="another-credit-cards hidden">
                @foreach ($bank->creditsCard as $creditCard)
                    <div class="row kredit-card-product">
                        <div class="row kredit-card-product__top w-100">
                            <h4 class="d-md-none">
                                <a href="{{ route('banks.single', ['slug' => $bank->slug]) }}"><strong>{{$bank->name}}</strong></a>
                            </h4>
                            <div class="col-12 kredit-card__info-name d-md-none mb-3">
                                <a href="{{ route('products.cards.single', ['slug' => $creditCard->slug]) }}">
                                    {{$creditCard->name}}
                                </a>
                            </div>
                            <div class="col-12 col-md-3 kredit-card__img">
                                <div class="card-img">
                                    <img class="img-fluid lazyload" data-src="{{$creditCard->getPrimary()->getUrl('thumb')}}" alt="{{$creditCard->getPrimaryAlt()}}" title="{{$creditCard->getPrimaryTitle()}}">
                                    <!-- <div class="card-tag">Word</div> -->
                                </div>
                                <ul class="device-list mb-2">
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
                            <div class="col-12 col-md-3 d-sm-flex flex-column justify-content-between d-md-none">
                                <div class="row card-butt">
                                    <div class="col d-md-flex align-items-center justify-content-end">
                                        <button class="yellBtn add-btn pb-2 pt-2" onclick="window.open('{{$creditCard->ref_link}}');" >Заказать карту</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 kredit-card__info">
                                <h4 class="d-none d-md-block">
                                    <a href="{{ route('banks.single', ['slug' => $bank->slug]) }}"><strong>{{$bank->name}}</strong></a>
                                </h4>
                                <div class="kredit-card__info-name d-none d-md-block">
                                    <a href="{{ route('products.cards.single', ['slug' => $creditCard->slug]) }}">
                                        {{$creditCard->name}}
                                    </a>
                                </div>
                                <ul class="kredit-card__advantages">
                                    @if ($advantages = $creditCard->getMetas('advantage'))
                                        @foreach ($advantages as $advantage)
                                            <li>{{$advantage->meta_value}}</li>
                                        @endforeach
                                    @endif
                                </ul>
                                <a href="{{ route('products.cards.single', ['slug' => $creditCard->slug]) }}" class="card-more" href="">Подробнее о карте</a>
                            </div>
                            <div class="col-md-3 d-sm-flex flex-column justify-content-between">
                                <div class="row card-butt">
                                    <div class="col d-md-flex align-items-center justify-content-end d-none">
                                        <button class="yellBtn add-btn" onclick="window.open('{{$creditCard->ref_link}}');" >Заказать карту</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row kredit-card-product__bottom justify-content-between w-100">
                            <div class="row w-100">
                                <div class="col-12 col-sm-3 kredit-card__item d-flex justify-content-between d-sm-block">
                                    <div class="sup" data-title="Максимальная сумма кредита">Кредитный лимит</div>
                                    <div class="value">@money($firstCreditCard->max_limit)</div>
                                </div>
                                <div class="col-12 col-sm-3 kredit-card__item d-flex justify-content-between d-sm-block">
                                    <div class="sup" data-title="Максимальная сумма кредита без подтверждения дохода">Лимит без справки</div>
                                    <div class="value">До @money($firstCreditCard->income_max_limit)</div>
                                </div>
                                <div class="col-12 col-sm-3 kredit-card__item d-flex justify-content-between d-sm-block">
                                    <div class="sup" data-title="Период бесплатного использования средств (без начисления процентов)">Льготный период</div>
                                    <div class="value">До {{$firstCreditCard->grace_period}} дн.</div>
                                </div>
                                <div class="col-12 col-sm-3 kredit-card__item d-flex justify-content-between d-sm-block">
                                    <div class="sup" data-title="Включает стоимость выпуска и обслуживания карты за первый год, при отсутствии задолженности">Обслуживание</div>
                                    <div class="value">{{$firstCreditCard->service}}</div>
                                </div>
                            </div>
                            <div class="row btn-mob d-md-none">
                                <a class="col-6 card-more" href="{{ route('products.cards.single', ['slug' => $creditCard->slug]) }}">Подробнее <span>о карте</span></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
@endforeach
@else
    <div class="content-wrap-item contributions-details-item">

        <div class="row kredit-card-product">
            <div class="col">
                  <strong>Ничего не найденно.</strong>
            </div>
        </div>

    </div>
@endif
