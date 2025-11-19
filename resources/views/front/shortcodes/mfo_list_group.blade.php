<div class="container container-page d-md-flex page-mfo">
    <div class="col-12 main-column contributions-page">

        {{--@include('front.mfo.mfo_filter', compact('min_amount','max_amount','min_term','max_term', 'type', 'list_id'))--}}

        <div id="catalog-mfo" class="content-wrap-item contributions-details-item catalog-mfo animated fadeInLeft">
            <div class="row catalog-mfo__head">
                <div class="col-4 col-md-2 catalog-mfo__head-name d-sm-block d-md-block d-lg-block d-xl-block d-none">
                    <span>МФО</span>
                </div>
                <div class="col-4 col-md-2 catalog-mfo__head-name d-sm-block d-md-block d-lg-block d-xl-block d-none">
                    <span>Ставка</span>
                </div>
                <div class="col-12 col-sm-3 catalog-mfo__head-name">
                    <span>Сумма кредита</span>
                </div>
                <div class="col-3 catalog-mfo__head-name d-lg-block d-xl-block d-none ">
                    <span>Условия</span>
                </div>
                <div class="col-2 catalog-mfo__head-name">
                    <span></span>
                </div>
            </div>
            <div class="catalog-mfo__product-list ">

                @if ($mfos->isNotEmpty())
                    @foreach ($mfos as $mfo)
                        <div class="row catalog-mfo__product">
                            <div class="col-4 col-md-3 col-lg-2 catalog-mfo__item">
                                <div class="mfo-img">
                                    <a href="#" data-href="{{ $ref_link_type == 1 ? $mfo->ref_link:$mfo->ref_link_2}}" title="{{$mfo->name}}" rel="nofollow" class="redirect">
                                        @if($mfo->hasPrimary())
                                            <img class="mfo_logo lazyload" data-src="{{$mfo->getPrimary()->getUrl('thumb')}}" alt="{{$mfo->getPrimaryAlt()}}" title="{{$mfo->getPrimaryTitle()}}">
                                        @endif
                                    </a>
                                </div>
                            </div>
                            <div class="col-4 col-md-3 col-lg-2 catalog-mfo__item">
                                <div>от<span class="num">{{$mfo->free_credit_bid}}</span>%</div>
                                <div class="hint">Ставка в день</div>
                            </div>
                            <div class="col-4 col-md-3 col-lg-3 catalog-mfo__item">
                                <div>до<span class="num">@intNumber($mfo->max_amount)</span>грн</div>
                            </div>
                            <div class="col-3 d-lg-block d-xl-block d-none catalog-mfo__item">
                                <ul class="list-condition">
                                    <li>Рассмотрение до  @intNumber($mfo->time_review) мин</li>
                                    <li>Возраст от @intNumber($mfo->min_age) до @intNumber($mfo->max_age) лет</li>
                                    @if ($mfo->receiving_method_card)
                                        <li>Деньги на карту</li>
                                    @endif
                                    @if ($mfo->receiving_method_cash)
                                        <li>Деньги наличными</li>
                                    @endif
                                </ul>
                            </div>
                            <div class="col-12 mb-0 mt-0 col-md-3 col-lg-2 d-flex flex-column catalog-mfo__item justify-content-center align-items-lg-center">
                                <a href="#" data-href="{{ $ref_link_type == 1 ? $mfo->ref_link:$mfo->ref_link_2}}" class="button redirect">Оформить</a>
                                <a href="{{ route('mfo.single', ['slug' => $mfo->slug]) }}" target="_blank" class="hint">Подробнее ></a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="row catalog-mfo__product">
                        <div class="col-12  pt-3">
                            <strong>Ничего не найдено.</strong>
                        </div>
                    </div>
                @endif


            </div>
        </div>
    </div>
</div>


