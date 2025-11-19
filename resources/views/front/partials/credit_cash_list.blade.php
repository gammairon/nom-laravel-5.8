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

@if ($creditsCash->isNotEmpty())
    <div class="catalog-mfo__product-list">
        @foreach ($creditsCash as $creditCash)
            <div class="row catalog-mfo__product">
                <div class="col-4 col-md-3 col-lg-2 catalog-mfo__item">
                    <div class="mfo-img">
                        @if ($creditCash->organization && $creditCash->organization->hasPrimary())
                            <img class="img-fluid lazyload" data-src="{{$creditCash->organization->getPrimary()->getUrl('thumb')}}" alt="{{$creditCash->organization->getPrimaryAlt()}}" title="{{$creditCash->organization->getPrimaryTitle()}}">
                        @endif
                    </div>
                </div>
                <div class="col-4 col-md-3 col-lg-2 catalog-mfo__item">
                    <div>от<span class="num">{{$creditCash->percent_new_individual}}</span>%</div>
                    <div class="hint">Годовая ставка</div>
                </div>
                <div class="col-4 col-md-3 col-lg-3 catalog-mfo__item">
                    <div>до<span class="num">@intNumber($creditCash->max_amount)</span>грн</div>
                </div>
                <div class="col-3 d-lg-block d-xl-block d-none catalog-mfo__item">
                    <ul class="list-condition">
                        @if ($advantages = $creditCash->getMetas('advantage'))
                            @foreach ($advantages as $advantage)
                                <li>{{$advantage->meta_value}}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-12 mb-0 mt-0 col-md-3 col-lg-2 d-flex flex-column catalog-mfo__item justify-content-center align-items-lg-center">
                    <button onclick="window.open('{{$creditCash->ref_link}}');" class="button">Оформить</button>
                    <a href="{{ route('products.cash.single', ['slug' => $creditCash->slug]) }}" class="hint">Подробнее ></a>
                </div>
                <div class="col-12 col-md-9 d-flex mt-0 pr-3 pl-3 d-lg-none d-xl-none mb-0 catalog-mfo__item">
                    <ul class="d-flex flex-column flex-sm-row align-items-start justify-content-sm-between w-100 list-condition">
                         @if ($advantages)
                            @foreach ($advantages as $advantage)
                                <li>{{$advantage->meta_value}}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-12 d-block d-md-none d-lg-none d-xl-none mb-4">
                    <a href="{{ route('products.cash.single', ['slug' => $creditCash->slug]) }}" class="hint">Подробнее ></a>
                </div>
            </div>
        @endforeach
    </div>
@else
     <div class="catalog-mfo__product-list">
        <div class="row catalog-mfo__product">
            <div class="col-12 py-3">
                <strong>Ничего не найдено!</strong>
            </div>
        </div>
    </div>
@endif
