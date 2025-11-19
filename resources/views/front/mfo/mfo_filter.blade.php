<div class="content-wrap-item contributions-details-item mfo-filter filter-slider">
    {{--<h1 class="page-title">Подберите лучший кредит для себя</h1>
    <h3 class="mfo-slogan">Сравнивайте и заказывайте кредиты украинских банков</h3>--}}
    <div class="row filter-container pb-3">
        <div class="col-12 col-sm-6 col-lg-4 filter-item">
            {{--<div class="form-items">
                <label for="amount">Сумма кредита</label>
                <input type="text" class="form-item numeric" name="amount" id="amount" placeholder="Сумма">
            </div>--}}
            <h5>Сумма кредита</h5>
            <div class="form-group material__inputs">
                <input type="text" class="material__input amount numeric" name="amount" id="amount" placeholder="Введите сумму" value="{{$min_amount}} грн." autocomplete="off">
                <span class="bar"></span>
                <div class="ui-slider">
                    <input type="text" class="slider amount" data-slider-min="{{$min_amount}}" data-slider-max="{{$max_amount}}">
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 filter-item">
            {{--<div class="form-items">
                <label for="days">На какой срок</label>
                <input type="text" class="form-item numeric" name="days" id="days" placeholder="Срок, дней">
            </div>--}}
            <h5>На какой срок</h5>
            <div class="form-group material__inputs">
                <input type="text" class="material__input days" name="days" id="days" placeholder="Введите срок" value="{{$min_term}} день" autocomplete="off">
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
        <div class="col-9 d-flex btn-group-filter">
            <div class="order">
                <select id="order" name="order" class="select2">
                    <option value="free_credit_bid_desc">Процент на убывание</option>
                    <option value="free_credit_bid_asc">Процент на возрастание</option>
                </select>
            </div>
            <div class="btn-chek">
                <input type="checkbox" class="checkbox" id="checkbox" name="no_procent" value="1" />
                <label for="checkbox">Безпроцентный</label>
            </div>

            <div class="btn-chek">
                <input type="checkbox" class="checkbox" id="checkbox" name="age_from" value="1"/>
                <label>от 18 лет</label>
            </div>
            <div class="btn-chek">
                <input type="checkbox" class="checkbox" id="checkbox" name="age_to" value="1"/>
                <label>до 80 лет</label>
            </div>
        </div>
        <input type="hidden" id="type" name="type" value="{{ isset($type) ? $type:'full' }}">
        <input type="hidden" id="list_id" name="list" value="{{ isset($list_id) ? $list_id:0 }}">
        <div class="col-3 btn-clear-fiter ">
            <button class="btn-clear">Сбросить</button>
        </div>
    </div>
</div>
