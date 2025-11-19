<div class="container container-page d-md-flex page-all-kredit-cards">
    <div class="col-xl-12 main-column contributions-page">
        <div class="content-wrap-item contributions-details-item">
            <h1 class="page-title">Оформить кредитную карту</h1>
            <div class="cards-slogan">Сравните условия и подберите лучшую карту именно для вас за считанные секунды</div>
            <!-- <a class="yellBtn cards-btn" href="" data-bank-title="cards-catalog" data-offer-title="Каталог карт">Узнать, какие банки дадут вам кредитную карту</a> -->
            <div class="hr"></div>
            <button type="button" class="secondary-filter-toggle" data-toggle="collapse" data-target="#credit-cards-filter" aria-expanded="false" aria-controls="credit-cards-filter">
                <i class="fa fa-cog"></i><span>Расширенный фильтр</span>
            </button>

            <div class=" row collapse secondary-filter-show" id="credit-cards-filter">
                <div class="col-12 col-md-4 mb-3 mb-md-0">
                    <label for="bank">Название банка</label>
                    <select id="bank" name="bank">
                        <option value="all">Все банки</option>
                        @if ($banks->isNOtEmpty())
                            @foreach ($banks as $bank)
                                <option value="{{$bank->id}}">{{$bank->name}}</option>
                            @endforeach
                        @endif

                    </select>
                </div>
                <div class="col-12 col-md-4 mb-3 mb-md-0">
                    <label>Преимущества</label>
                    <div class="checkbox-item">
                        <input type="checkbox" id="free-service" name="free_service" value="1" />
                        <label for="free-service">Бесплатное обслуживание</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="cashback" name="cashback" value="1" />
                        <label for="cashback">Кешбек</label>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <label>Тип и технология</label>
                    <div class="checkbox-item">
                        <input type="checkbox" id="paypass" name="paypass" value="1" />
                        <label for="paypass">Бесконтактная оплата</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="chip" name="chip" />
                        <label for="chip">Чип</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="mastercard" name="mastercard" value="1" />
                        <label for="mastercard">MasterCard</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="visa" name="visa" value="1" />
                        <label for="visa">Visa</label>
                    </div>
                </div>
                <div>
                    <div class="col-12 my-3">
                        <button type="submit" class="yellBtn cards-btn btn-result" >Применить фильтр</button>
                    </div>
                </div>
            </div>

        </div>



        <div id="list-credit-cards" class="animated fadeInLeft">
            @include('front.partials.credit_cards_list', ['banks' => $banks])
        </div>

    </div>
</div>