<!doctype html>
<html amp lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/storage/images/favicon.png')}}">

        {!! SEOMeta::generate() !!}
        {!! OpenGraph::generate() !!}
        {!! Twitter::generate() !!}
        {!! JsonLdFactory::generate() !!}

        <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
        <style amp-custom>
            html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline}
            .toggle-hamburger {background-color: #fff; color: #ccc; display: block; position: relative; overflow: hidden; margin: 0; padding: 0; width: 65px; height: 50px; font-size: 0; text-indent: -9999px; -webkit-appearance: none; -moz-appearance: none; appearance: none; box-shadow: none; border: none; border-radius: none; cursor: pointer; -webkit-transition: background 0.3s; transition: background 0.3s; } .toggle-hamburger:focus {outline: none; } .toggle-hamburger span {display: block; position: absolute; top: 30px; left: 22px; right: 8px; height: 5px; background: #f20f0f; } .toggle-hamburger span::before, .toggle-hamburger span::after {position: absolute; display: block; left: 0; width: 100%; height: 5px; background-color: #f20f0f; content: ""; } .toggle-hamburger span::before {top: -10px; } .toggle-hamburger span::after {bottom: -10px; } .toggle-hamburger.toggle-hamburger__animx span {-webkit-transition: background 0s 0.3s; transition: background 0s 0.3s; } .toggle-hamburger.toggle-hamburger__animx span::before, .toggle-hamburger.toggle-hamburger__animx span::after {-webkit-transition-duration: 0.3s, 0.3s; transition-duration: 0.3s, 0.3s; -webkit-transition-delay: 0.3s, 0s; transition-delay: 0.3s, 0s; } .toggle-hamburger.toggle-hamburger__animx span::before {-webkit-transition-property: top, transform; transition-property: top, transform; } .toggle-hamburger.toggle-hamburger__animx span::after {-webkit-transition-property: bottom, transform; transition-property: bottom, transform; } /* when menu open: */ .toggle-hamburger.toggle-hamburger__animx.is-active span {background: none; } .toggle-hamburger.toggle-hamburger__animx.is-active span::before, .toggle-hamburger.toggle-hamburger__animx.is-active span::after {background-color: #f20f0f; -webkit-transition-delay: 0s, 0.3s; transition-delay: 0s, 0.3s; } .toggle-hamburger.toggle-hamburger__animx.is-active span::before {top: 0; -webkit-transform: rotate(45deg); transform: rotate(45deg); } .toggle-hamburger.toggle-hamburger__animx.is-active span::after {bottom: 0; -webkit-transform: rotate(-45deg); transform: rotate(-45deg); } .header{display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #0000001a; max-height: 50px;padding: 0 10px; } .menu_container{position: absolute; right: 0; background: rgb(224,225,229); min-width: 300px; display: none; z-index: 999; } .menu_container.active{display: block; } ul{list-style-type: none; } .menu_container h5{font-size: 18px; font-weight: bold; display: inline-block; padding: 5px 10px; } .menu_container li{border: 1px solid #c7c8ca; } .menu-items li a{padding-left: 25px; } .menu-item{display: block; text-decoration: none; padding: 5px 10px; background-color: rgb(224,225,229); color: #454547; } .menu-item:hover{color: #ffffff; box-shadow: 1px 5px 10px -5px black; } a{color: #3490dc; text-decoration: none; display: inline-block; } a.popular-post-img{display: block; } .popular-post-title a{font-size: 18px; font-weight: bold; } .popular-post-item{margin-bottom: 25px; display: flex;} .info{color: rgba(0, 0, 0, 0.5); } .post-header > ul, .post-header > div{margin: 15px 0; } .container{max-width: 768px; margin: 0 auto; } h1{font-size: 25px; font-weight: bold; margin: 30px 0 25px; } h3{font-size: 20px; font-weight: bold; margin-bottom: 10px; } .img-detail-post{margin-bottom: 25px;} .img-detail-news{margin-bottom: 25px; width: 30%; margin-right: 5%;} .popular-post-title{width: 65%;} .amp-mode-touch .single-post{padding: 0 15px; text-align: left; font-family: Arial, sans-serif;} .post-tags, .share{margin: 20px 0; } .share-btn{display: inline-block; display: flex; align-items: center; justify-content: center; width: 50px; height: 50px; margin-right: 15px; } .share-btn::before {content: ''; display: inline-block; background-image: url(/storage/images/social-icons.svg); background-repeat: no-repeat; width: 30px; height: 30px; background-size: cover; } .share-btn.facebook{background: #435F9F; } .share-btn.twitter{background: #0DAFF0; } .share-btn.telegram{background: #2ba1db; } .share-btn.facebook::before{width: 18px; background-position: -138px 0; } .share-btn.twitter::before{width: 43px; background-position: -46px 0; } .share-btn.telegram::before{background-position: -184px 0; } .share-buttons{display: flex; } .footer-amp{text-align: center; }.amp-mode-touch .post-content a{display: initial;}.amp-mode-touch p {margin: 0 0 20px;line-height: 24px;}

        </style>

        <script async src="https://cdn.ampproject.org/v0.js"></script>
        <script async custom-element="amp-bind" src="https://cdn.ampproject.org/v0/amp-bind-0.1.js"></script>
        <script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
        <script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>
        <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
        <script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>
        <script async custom-element="amp-sticky-ad" src="https://cdn.ampproject.org/v0/amp-sticky-ad-1.0.js"></script>
        <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>



    </head>
    <body>
{{--
    <amp-analytics type="gtag" data-credentials="include"><script type="application/json">{ "vars" : { "gtag_id": "UA-143376033-1", "config" : { "UA-143376033-1": { "groups": "default" } } } }</script></amp-analytics>
--}}

    <header class="header container">
            <div class="left">
                <a class="logo" href="{{route('home')}}">
                    <amp-img src="{{asset('/storage/images/logo.png')}}" width="150" height="40" alt="Nominal"></amp-img>
                </a>
            </div>
            <div class="right">
                <button class="toggle-hamburger toggle-hamburger__animx" [class]="isMenuOpen ? 'toggle-hamburger toggle-hamburger__animx is-active' : 'toggle-hamburger toggle-hamburger__animx'" on="tap:AMP.setState({isMenuOpen: !isMenuOpen})" aria-label="Меню">
                    <span>menu toggle</span>
                </button>
                <a href="#" class="btn-menu" [class]="isMenuOpen ? 'btn-menu--close' : 'btn-menu'" on="tap:AMP.setState({isMenuOpen: !isMenuOpen})" aria-label="Меню"></a>
            </div>
        </header>
        <nav role="menu" class="menu_container" [class]="isMenuOpen ? 'menu_container active' : 'menu_container'">
            <ul>
                <li>
                    <h5>Новости</h5>
                    <ul class="menu-items">
                        <li><a class="menu-item" href="https://news.nominal.com.ua">Все новости</a></li>
                        <li><a class="menu-item" href="https://news.nominal.com.ua/categories/finance-news">Новости Финансов</a></li>
                        <li><a class="menu-item" href="https://news.nominal.com.ua/categories/poleznaya-informatsiya">Полезное</a></li>
                    </ul>
                </li>
                <li>
                    <h5>Кредиты</h5>
                    <ul class="menu-items">
                        <li><a class="menu-item" href="https://nominal.com.ua/kredit-online-na-kartu">Кредиты онлайн</a></li>
                        <li><a class="menu-item" href="https://nominal.com.ua/kredit-nalichnymi">Банковские кредиты</a></li>
                        <li><a class="menu-item" href="https://nominal.com.ua/kredit-bez-otkaza">Без отказа</a></li>
                        <li><a class="menu-item" href="https://nominal.com.ua/kredit-s-plohoj-kreditnoj-istoriej">С плохой кредитной историей</a></li>
                        <li><a class="menu-item" href="https://nominal.com.ua/besprotsentnyj-kredit">Беспроцентный</a></li>
                        <li><a class="menu-item" href="https://nominal.com.ua/momentalnyj-zajm-onlajn-na-kartu">Моментальный</a></li>
                        <li><a class="menu-item" href="https://nominal.com.ua/kredit-onlajn-bez-foto-i-zvonkov">Без звонка</a></li>
                    </ul>
                </li>
                <li>
                    <h5>Кредитные карты</h5>
                    <ul class="menu-items">
                        <li><a class="menu-item" href="https://nominal.com.ua/kreditnye-karty" >Все Кредитные карты</a></li>
                    </ul>
                </li>
                <li>
                    <h5>Компании</h5>
                    <ul class="menu-items">
                        <li><a class="menu-item" href="https://nominal.com.ua/kredit-online">Все МФО</a></li>
                        <li><a class="menu-item" href="https://nominal.com.ua/banks">Банки</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div class="container">
            @yield('content')
        </div>
        <footer class="footer-amp container">
            <div class="counter">
                <amp-analytics id="analytics_liveinternet"><script type="application/json">{ "requests": { "pageview": "https://counter.yadro.ru/hit?u${ampdocUrl};r${documentReferrer};s${screenWidth}*${screenHeight}*32;h${title};${random}" }, "triggers": { "track pageview": { "on": "visible", "request": "pageview" } } }</script></amp-analytics>
            </div>
            <a href="{{ route('home') }}"><amp-img src="{{asset('/storage/images/logo.png')}}" width="150" height="40"  alt="Nominal"></amp-img></a>
        </footer>
    </body>
</html>
