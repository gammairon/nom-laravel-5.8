<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/storage/images/favicon.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/storage/images/favicon.png')}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="145c89a523a947ad7c784f07937df480" content="">

    <!-- SEO -->
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLdFactory::generate() !!}

    <!-- Styles -->
    <link href="{{ mix('css/app.css', 'assets') }}" rel="stylesheet">
    <link href="{{ mix('css/nominal20/style.css', 'assets') }}" rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-143376033-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-143376033-2');
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->

</head>
<body class="front">

<div id="app">
    @include('front.partials.global.news_default_header')


    <main>
        @yield('content')
    </main>

    @section('footer')
        <div class="nominal20 footer-new">
            @include('nominal20.partials.global.footer')
        </div>
    @show
</div>

<!-- Scripts -->
@stack('before_scripts')
<script src="{{ mix('js/app.js', 'assets') }}" defer></script>
@stack('after_scripts')

</body>
</html>
