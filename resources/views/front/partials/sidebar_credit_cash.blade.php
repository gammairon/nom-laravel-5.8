<div class="col-md-12 flex-fixed-width-item right-sidebar">
    <!-- <div class="adsense"><a href="#"><img src="{{asset('/storage/images/AdSense2.gif')}}"alt="..."></a></div> -->
    <section class="sidebar-product-block-nomobil content-wrap-item list-bank-product">
        @foreach ($topCreditCash as $topCredit)
            <div class=" row bank-product d-flex justify-content-between align-items-center">
                <a href="{{ route('products.cash.single', $topCredit->slug) }}" class="logo-bank-sidebar">
                    @if ($topCredit->organization && $topCredit->organization->hasPrimary())
                        <img class="img-fluid lazyload" data-src="{{$topCredit->organization->getPrimary()->getUrl('thumb')}}" alt="{{$topCredit->organization->getPrimaryAlt()}}" title="{{$topCredit->organization->getPrimaryTitle()}}">
                    @endif
                </a>
                <span claas="max-kredit">@money($topCredit->max_amount)</span>
                <button class="ui-button yellBtn" onclick="window.open('{{$topCredit->ref_link}}');" >Перейти</button>
            </div>
        @endforeach
    </section>
    <!-- <div class="adsense"><a href="#"><img src="{{asset('/storage/images/AdSense.jpg')}}" alt="..."></a></div> -->
</div>
