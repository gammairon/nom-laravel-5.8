<div class="col-md-12 flex-fixed-width-item right-sidebar">
    <!-- <div class="adsense"><a href="#"><img src="{{asset('/storage/images/AdSense2.gif')}}"alt="..."></a></div> -->
    <section class="sidebar-product-block-nomobil content-wrap-item list-bank-product">
        @foreach ($topCreditCards as $topCreditCard)
            <div class=" row bank-product d-flex justify-content-between align-items-center">
                <a href="{{ route('products.cards.single', $topCreditCard->slug) }}" class="logo-bank-sidebar">
                    @if ($topCreditCard->organization && $topCreditCard->organization->hasPrimary())
                        <img class="img-fluid lazyload" data-src="{{$topCreditCard->organization->getPrimary()->getUrl('thumb')}}" alt="{{$topCreditCard->organization->getPrimaryAlt()}}" title="{{$topCreditCard->organization->getPrimaryTitle()}}">
                    @endif

                </a>
                <span claas="max-kredit">@money($topCreditCard->max_limit)</span>
                <button class="ui-button yellBtn" onclick="window.open('{{$topCreditCard->ref_link}}');" >Перейти</button>
            </div>
        @endforeach
    </section>
    <!-- <div class="adsense"><a href="#"><img src="{{asset('/storage/images/AdSense.jpg')}}" alt="..."></a></div> -->
</div>
