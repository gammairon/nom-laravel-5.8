<div class="container container-page d-md-flex page-all-kredit-nal">
    <div class="col-12 main-column contributions-page">
        <div id="credit-cash-filter" class="content-wrap-item contributions-details-item credit-cash-filter filter-slider">
            <h1 class="page-title">Кредит наличными в Украине</h1>
            <div class="mfo-slogan">Сравнить и взять кредит наличными в украинских финансовых организациях</div>
            <div class="row filter-container">
                <div class="col-12 col-sm-6 col-lg-4 filter-item">
                     {{--<div class="form-items">
                            <label for="amount">Сумма кредита</label>
                            <input type="text" class="form-item numeric" name="amount" id="amount" placeholder="Введите нужную сумму">
                        </div>--}}
                    <h5>Сумма кредита</h5>
                    <div class="form-group material__inputs">
                        <input type="text" class="material__input amount numeric" name="amount" id="amount" placeholder="Введите сумму" value="{{$min_amount}} грн." autocomplete="off">
                        <span class="bar"></span>
                        <div class="ui-slider">
                            <input type="text" class="slider amount" data-slider-min="{{$min_amount}}" data-slider-max="{{$max_amount}}" value="{{$min_amount}}" data-slider-value="{{$min_amount}}">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 filter-item">
                    {{--<div class="form-items">
                        <label for="days">На какой срок</label>
                        <input type="text" class="form-item numeric" name="days" id="days" placeholder="Срок, месяцев">
                    </div>--}}
                    <h5>На какой срок</h5>
                    <div class="form-group material__inputs">
                        <input type="text" class="material__input days" name="days" id="days" placeholder="Введите срок" value="{{$min_term}} месяц" autocomplete="off">
                        <span class="bar"></span>
                        <div class="ui-slider">
                            <input type="text" class="slider days" data-slider-min="{{$min_term}}" data-slider-max="{{$max_term}}" data-slider-value="{{$min_term}}">
                        </div>
                    </div>
                </div>
                <div class="col-1 d-lg-block d-xl-block d-none filter-item">
                </div>
                <div class="col-12 col-lg-3 filter-item d-flex align-items-end justify-content-end">
                    <button class="btn-result">Показать результаты</button>
                </div>
            </div>
            <div class="row btn-group">
                <div class="col-12 btn-clear-fiter ">
                    <button class="btn-clear">Сбросить</button>
                </div>
            </div>
        </div>
        <div id="catalog-credit-cash" class="content-wrap-item contributions-details-item catalog-mfo animated fadeInLeft">
            @include('front.partials.credit_cash_list', ['creditsCash' => $creditsCash])
        </div>
    </div>
</div>