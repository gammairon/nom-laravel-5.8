<div class="container container-page d-md-flex page-mfo">
    <div class="col-12 main-column contributions-page">

        {{--@include('front.mfo.mfo_filter', compact('min_amount','max_amount','min_term','max_term'))--}}

        <div id="catalog-mfo" class="content-wrap-item contributions-details-item catalog-mfo animated fadeInLeft">
            @include('front.partials.mfo_list', ['mfos' => $mfos])
        </div>

    </div>
</div>
