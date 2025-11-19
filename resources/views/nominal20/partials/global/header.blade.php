
<header class="header">
    <div class="header-top">
        <div class="container-page">
            <div class="header-top__contacts">
                <a href="tel:+380931220199" class="tel">
                    (093) 122-01-99
                </a>
                <a href="mailto:admin@nominal.com.ua" class="mail">
                    admin@nominal.com.ua
                </a>
            </div>
            <div class="header-top__right">
                <div class="today">
                    {{--<span class="day">Сегодня: </span><span class="city"> Киев </span> <span class="temp">  {{$weather->temp}} </span>--}}
                    <a href="https://nominal.com.ua/kredit-online-na-kartu" style="color: #fff; "><span >Получить кредит</span></a>
                </div>

                <div class="other-info">
                    <div class="header-search">
                        <a href="#" class="search">Поиск</a>
                        <div class="fade-block">
                            <form action="{{route('search')}}">
                                <div class="form-search">
                                    <input type="text" name="s" value="">
                                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="lang">
                        <div class="active-lang item-lang ru">
                            Ru
                        </div>
                        <div class="submenu-lang hidden">
                            <div class ="item-lang ua"> Ua</div>
                            <div class ="item-lang en"> En</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-botom">
        <div class="container-page">
            <a href="{{route('home')}}" class="logo">
                <img src="{{asset('/storage/images/nominal20/logo.png')}}" alt="Nominal">
            </a>
            <div class="row">
                <div class="header-search mobile">
                    <div class="fade-block">
                        <form action="{{route('search')}}">
                            <div class="form-search">
                                <input type="text" name="s" value="">
                                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="search-mob">
                </div>
                <ul class="menu">
                    <li class="menu-item has-submenu">
                        <a href="javascript:void(0);" class="has-submenu">Новости </a>


                        <ul class="dropdown-menu" >
                            <li class="dropdown-item"><a class="dropdown-item-link" href="https://news.nominal.com.ua">Все новости</a></li>
                            <li class="dropdown-item"><a class="dropdown-item-link" href="https://news.nominal.com.ua/categories/finance-news">Новости Финансов</a></li>
                            <li class="dropdown-item"><a class="dropdown-item-link" href="https://news.nominal.com.ua/categories/poleznaya-informatsiya">Полезное</a></li>
                        </ul>

                    </li>
                    <li class="menu-item has-submenu">
                        <a href="javascript:void(0);">Кредиты </a>

                        <ul class="dropdown-menu" >
                            <li class="dropdown-item"><a class="dropdown-item-link" href="https://nominal.com.ua/kredit-online-na-kartu">Кредиты онлайн</a></li>
                            <li class="dropdown-item"><a class="dropdown-item-link" href="https://nominal.com.ua/kredit-nalichnymi">Банковские кредиты</a></li>
                            <li class="dropdown-item"><a class="dropdown-item-link" href="https://nominal.com.ua/kredit-bez-otkaza">Без отказа</a></li>
                            <li class="dropdown-item"><a class="dropdown-item-link" href="https://nominal.com.ua/kredit-s-plohoj-kreditnoj-istoriej">С плохой кредитной историей</a></li>
                            <li class="dropdown-item"><a class="dropdown-item-link" href="https://nominal.com.ua/besprotsentnyj-kredit">Беспроцентный</a></li>
                            <li class="dropdown-item"><a class="dropdown-item-link" href="https://nominal.com.ua/momentalnyj-zajm-onlajn-na-kartu">Моментальный</a></li>
                            <li class="dropdown-item"><a class="dropdown-item-link" href="https://nominal.com.ua/kredit-onlajn-bez-foto-i-zvonkov">Без звонка</a></li>
                        </ul>

                    </li>
                    <li class="menu-item">
                        <a href="https://nominal.com.ua/kreditnye-karty">Кредитные карты </a>
                    </li>
                    <li class="menu-item has-submenu">
                        <a href="javascript:void(0);">Компании </a>
                        <ul class="dropdown-menu" >
                            <li class="dropdown-item"><a class="dropdown-item-link" href="https://nominal.com.ua/kredit-online">Все МФО</a></li>
                            <li class="dropdown-item"><a class="dropdown-item-link" href="https://nominal.com.ua/banks">Банки</a></li>
                        </ul>
                    </li>

                </ul>
                <div class="menu-mob">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
            </div>
        </div>
    </div>
</header>
