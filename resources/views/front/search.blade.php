@extends('layouts.app')


@section('content')
    <div class="container container-page d-md-flex content-all-page">
        <div class="col left-part-page">
            <h1 class="mb-3">{{__('Поиск на сайте')}}</h1>

            <div class="row mb-5">
                <section class="col-lg-12 col-xl-12 all-news">
                    <form action="{{route('search')}}">
                        <div class="form-group col-xs-12 col-md-8 pl-0">
                            <label for="s" class="col-form-label text-md-right required">{{ __('Поиск новостей') }}</label>
                            <div class="input-group mb-3">
                                <input id="s" type="text" class="form-control" name="s" value="{{ request('s') }}" placeholder="Искать..." required>
                                <div class="input-group-append">
                                    <span class="input-group-append"><button type="submit" class="btn btn-outline-primary"><i class="fa fa-search" aria-hidden="true"></i></button></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
            </div>


            @if($posts->isNotEmpty())
                <div class="row mb-5">
                    <h5><strong>По Вашему запросу найдено {{$posts->total()}} новостей (Результаты запроса {{$posts->firstItem()}} - {{$posts->lastItem()}}):</strong></h5>
                </div>
            @endif

            <div class="row news-content">
                <section class="col-lg-12 col-xl-12 all-news">
                    <div class="load-container">

                        @include('front.partials.category_post', ['posts' => $posts])

                        @if ($posts->isEmpty() && request('s'))
                            <h5>{{ 'По вашему запросу: '.request('s').'. Ничего не найдено' }}</h5>
                        @endif
                    </div>

                    @if($posts->isNotEmpty())
                        <div class="paginate">
                            {{ $posts->appends(['s' => request('s')])->links() }}
                        </div>
                    @endif
                </section>
            </div>
        </div>
        @include('front.partials.sidebar_news')
    </div>
@endsection