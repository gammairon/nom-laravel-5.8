<header class="header">
    <div class="container">
        <div class="row">
            <div class="col">
                <nav class="navbar navbar-expand-xl navbar-light bg-light">
                    <a class="navbar-brand" href="{{route('home')}}" style="max-width: 205px">
                        <img src="{{asset('/storage/images/logo.png')}}" width="409" height="100" alt="Nominal" style="max-width: 100%; height: auto">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1" aria-controls="navbar1" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar1">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                @if(false)
                                    <a class="nav-link" href="{{route('categories.single', ['slug' => 'finance-news'])}}" >Все новости</a>
                                @endif
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Новости</a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                        <a class="dropdown-item" href="https://news.nominal.com.ua">Все новости</a>
                                        <a class="dropdown-item" href="https://news.nominal.com.ua/categories/finance-news">Новости Финансов</a>
                                        <a class="dropdown-item" href="https://news.nominal.com.ua/categories/poleznaya-informatsiya">Полезное</a>

                                    </div>
                            </li>
                            <li class="nav-item dropdown">
                                @if(false)
                                    <a class="nav-link" href="{{ route('banks.all') }}" >Все Банки</a>
                                @endif
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Кредиты</a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                        <a class="dropdown-item" href="https://nominal.com.ua/kredit-online-na-kartu">Кредиты онлайн</a>
                                        <a class="dropdown-item" href="https://nominal.com.ua/kredit-nalichnymi">Банковские кредиты</a>
                                        <a class="dropdown-item" href="https://nominal.com.ua/kredit-bez-otkaza">Без отказа</a>
                                        <a class="dropdown-item" href="https://nominal.com.ua/kredit-s-plohoj-kreditnoj-istoriej">С плохой кредитной историей</a>
                                        <a class="dropdown-item" href="https://nominal.com.ua/besprotsentnyj-kredit">Беспроцентный</a>
                                        <a class="dropdown-item" href="https://nominal.com.ua/momentalnyj-zajm-onlajn-na-kartu">Моментальный</a>
                                        <a class="dropdown-item" href="https://nominal.com.ua/kredit-onlajn-bez-foto-i-zvonkov">Без звонка</a>
                                    </div>

                            </li>
                            <li class="nav-item dropdown">
                                @if(false)
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">МФО</a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                        <a class="dropdown-item" href="{{ route('mfo.all')}}">Все МФО</a>
                                        @foreach ($mfos as $mfo)
                                            <a class="dropdown-item" href="{{ route('mfo.single', ['slug' => $mfo->slug]) }}">{{$mfo->name}}</a>
                                        @endforeach
                                    </div>
                                @endif
                                <a class="nav-link" href="https://nominal.com.ua/kreditnye-karty" >Кредитные карты</a>
                            </li>
                            <li class="nav-item dropdown">
                                @if(false)
                                    <a class="nav-link" href="{{ route('page', ['slug' => 'kreditnye-karty-v-ukraine'])}}" >Карты</a>
                                @endif
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Компании</a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                        <a class="dropdown-item" href="https://nominal.com.ua/kredit-online">Все МФО</a>
                                        <a class="dropdown-item" href="https://nominal.com.ua/banks">Банки</a>
                                    </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="{{route('search')}}" ><i class="fa fa-search" aria-hidden="true"></i></a>
                            </li>

                            <!-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ипотека</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                    <a class="dropdown-item" href="#">...</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Депозиты</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                    <a class="dropdown-item" href="#">...</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Страхование</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                    <a class="dropdown-item" href="#">Каско</a>
                                    <a class="dropdown-item" href="#">Осаго</a>
                                </div>
                            </li> -->
                        </ul>
                    </div>
                </nav>
            </div>

        </div>

    </div>
</header>
